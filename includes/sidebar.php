<!-- Ensure jQuery is included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your Sidebar HTML -->
<nav class="hk-nav hk-nav-light">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="ion ion-ios-keypad"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#user_drp">
                        <i class="ion ion-ios-person"></i> <span class="nav-link-text">User Management</span>
                    </a>
                    <ul id="user_drp" class="nav flex-column collapse collapse-level-1">
                        <!-- Populate this dropdown if needed -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#farm_drp">
                        <i class="ion ion-ios-home"></i>
                        <span class="nav-link-text">Farms</span>
                    </a>
                    <ul id="farm_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="cows.php">Cows</a></li>
                                <li class="nav-item"><a class="nav-link" href="milk.php">Milk Collection</a></li>
                                <li class="nav-item"><a class="nav-link" href="feedmanagement.php">Feed Management</a></li>
                                <li class="nav-item"><a class="nav-link" href="animalhealth.php">Animal Health</a></li>
                                <li class="nav-item"><a class="nav-link" href="reproduction.php">Reproduction</a></li>
                                <li class="nav-item"><a class="nav-link" href="farmexpenses.php">Farm Expenses</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <hr class="nav-separator"> 
        </div>
    </div>
</nav>

<!-- Custom JavaScript for Dropdown Toggle -->
<script>
    // Function to handle dropdown toggle
    $(document).ready(function() {
        $('[data-toggle="collapse"]').on('click', function() {
            var target = $(this).data('target');
            $(target).toggleClass('show');
        });
    });
</script>
