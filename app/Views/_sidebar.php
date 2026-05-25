<?php
// Get current page name to set active class
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="adminDashboard.php" class="nav-link text-white <?php echo ($current_page == 'adminDashboard.php') ? 'active' : ''; ?>">
                Dashboard
            </a>
        </li>

        <li>
            <a href="teachersPage.php" class="nav-link text-white <?php echo ($current_page == 'teachersPage.php') ? 'active' : ''; ?>">
                Teachers
            </a>
        </li>


        <li>
            <a href="studentsPage.php" class="nav-link text-white <?php echo ($current_page == 'studentsPage.php') ? 'active' : ''; ?>">
                Students
            </a>
        </li>
    </ul>
</div>