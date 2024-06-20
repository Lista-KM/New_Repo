<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <!-- Include necessary CSS files -->
    <link href="vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    // Sample data initialization
    $row = array(
        'AdminName' => 'admin' // Assuming 'AdminName' is the key for the administrator's name
    );
    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
        <!-- Toggle button -->
        <!-- Navbar brand -->
        <a class="navbar-brand" href="dashboard.php">DFSMS</a>
        <!-- Navbar content -->
        <ul class="navbar-nav hk-navbar-content">
            <!-- Dropdown -->
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="dist/img/user.png" alt="user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <!-- Admin name -->
                            <span><?php echo $row['AdminName']; ?><i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <!-- Dropdown menu -->
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <!-- Profile link -->
                    <a class="dropdown-item" href="profile.php"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                    <!-- Settings link -->
                    <a class="dropdown-item" href="change-password.php"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <div class="sub-dropdown-menu show-on-hover">
                        <!-- Online status -->
                        <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <!-- Logout link -->
                    <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Script to handle sidebar toggle -->
    <script>
        // Get the toggle button
        var toggleBtn = document.getElementById('navbar_toggle_btn');

        // Add click event listener to toggle button
        toggleBtn.addEventListener('click', function() {
            // Toggle 'sidebar-open' class on the body
            document.body.classList.toggle('sidebar-open');
        });
    </script>

</body>
</html>
