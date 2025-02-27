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
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#accounts" aria-expanded="false" aria-controls="accounts">
                <i class="lni lni-users"></i>
                <span>Accounts</span>
            </a>
            <ul id="accounts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="admin_students_account.php" class="sidebar-link">Students</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_facilitators_account.php" class="sidebar-link">Facilitators</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_coordinators_account.php" class="sidebar-link">Coordinators</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#approval" aria-expanded="false" aria-controls="approval">
                <i class="bi bi-person-check"></i>
                <span>Approvals</span>
            </a>
            <ul id="approval" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="admin_pending_requests.php" class="sidebar-link">Pending Requests</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_add_facilitator.php" class="sidebar-link">Add Facilitator</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_add_coordinator.php" class="sidebar-link">Add Coordinator</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#archive" aria-expanded="false" aria-controls="archive">
                <i class="bi bi-archive"></i>
                <span>Archive</span>
            </a>
            <ul id="archive" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="admin_archive_students.php" class="sidebar-link">Archive Students</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_archive_facilitators.php" class="sidebar-link">Archive Facilitators</a>
                </li>
                <li class="sidebar-item">
                    <a href="admin_archive_coordinators.php" class="sidebar-link">Archive Coordinators</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="../logout.php" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
