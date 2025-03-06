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
            <a href="rentor_apartment_management.php" class="sidebar-link">
                <i class="bi bi-building-gear"></i>
                <span>Apartment Management</span>
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
            <a href="rentor_rentee_profile.php" class="sidebar-link">
                <i class="bi bi-person"></i>
                <span>Rentee Profile</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="rentor_archive.php" class="sidebar-link">
                <i class="bi bi-archive"></i>
                <span>Archive</span>
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
