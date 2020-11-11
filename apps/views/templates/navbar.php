<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= BASE_URL; ?>dist/index.html">Village Assistance</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="<?= BASE_URL; ?>dist/#"><i class="fas fa-bars"></i></button>
           
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="<?= BASE_URL; ?>dist/#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= BASE_URL; ?>dist/#">Settings</a>
                        <a class="dropdown-item" href="<?= BASE_URL; ?>dist/#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <?php if(empty($_SESSION['userdata'])) : ?>
                            <a class="dropdown-item" href="<?= BASE_URL; ?>login">Login</a>
                        <?php else : ?>
                            <a class="dropdown-item" href="<?= BASE_URL; ?>/login/logout">Logout</a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </nav>