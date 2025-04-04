<?php
include 'db_connection.php';

header('Content-Type: application/json');

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("
        UPDATE Agreement_Duration
        SET remaining_days = GREATEST(62 - DATEDIFF(CURDATE(), move_in_date), 0),
            last_updated = CURDATE()
        WHERE move_in_date <= CURDATE()
    ");
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("
        INSERT INTO Pending_Payments (rentee_id, due_date, amount, status)
        SELECT 
            ad.rentee_id,
            DATE_ADD(
                ad.move_in_date,
                INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH
            ) AS due_date,
            12000.00,
            'Pending'
        FROM Agreement_Duration ad
        WHERE ad.move_in_date <= CURDATE()
        AND NOT EXISTS (
            SELECT 1
            FROM Pending_Payments pp
            WHERE pp.rentee_id = ad.rentee_id
            AND pp.due_date = DATE_ADD(
                ad.move_in_date,
                INTERVAL TIMESTAMPDIFF(MONTH, ad.move_in_date, CURDATE()) + 1 MONTH
            )
        )
    ");
    $stmt->execute();
    $stmt->close();

    $conn->commit();
} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
} finally {
    $conn->close();
}
?>