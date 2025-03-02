<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list" alt="Toggle Sidebar" ></i>
        </button>
        <div class="sidebar-logo">
            <a href="rentor_dashboard.php">Rentor</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="rentor_dashboard.php" class="sidebar-link">
                <i class="lni lni-layout"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="rentor_payment_history.php" class="sidebar-link">
                <i class="bi bi-cash-coin"></i>
                <span>Payment History</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="rentor_rentee_list.php" class="sidebar-link">
                <i class="bi bi-building-gear"></i>
                <span>Rentee Management</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#accounts" aria-expanded="false" aria-controls="accounts">
                <i class="bi bi-gear"></i>
                <span>Maintenance</span>
            </a>
            <ul id="accounts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="rentor_requests.php" class="sidebar-link">
                    <i class="bi bi-house-exclamation"></i>
                    <span>Maintenance Requests</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="rentor_maintenance_duration.php" class="sidebar-link">
                    <i class="bi bi-house-gear"></i>
                    <span>Maintenance Duration</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="rentor_analytics.php" class="sidebar-link">
                <i class="bi bi-clipboard-data"></i>
                <span>Rental Analytics</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="rentor_edit_payment.php" class="sidebar-link">
                <i class="bi bi-bank"></i>
                <span>Edit Payment</span>
            </a>
        </li>

    </ul>
    <div class="sidebar-footer">
        <a href="../logout.php" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
