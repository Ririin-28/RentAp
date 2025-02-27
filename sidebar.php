<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-list" alt="Toggle Sidebar" ></i>
        </button>
        <div class="sidebar-logo">
            <a href="admin_dashboard.php">Admin</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="admin_dashboard.php" class="sidebar-link">
                <i class="lni lni-layout"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="admin_dashboard.php" class="sidebar-link">
                <i class="lni lni-credit-card-multiple"></i>
                <span>Payment History</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#accounts" aria-expanded="false" aria-controls="accounts">
                <i class="lni lni-users"></i>
                <span>Rentee Management</span>
            </a>
            <ul id="accounts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="admin_students_account.php" class="sidebar-link">Rentees List</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_facilitators_account.php" class="sidebar-link">Rentee Requests</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_coordinators_account.php" class="sidebar-link">Maintenance Duration</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="admin_dashboard.php" class="sidebar-link">
                <i class="lni lni-layout"></i>
                <span>Rental Analytics</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="admin_dashboard.php" class="sidebar-link">
                <i class="lni lni-layout"></i>
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
