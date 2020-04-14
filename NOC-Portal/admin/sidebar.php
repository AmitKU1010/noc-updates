    <!-- Header Menu -->
    <div class="app-header1 header py-1 d-flex">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="header-brand" href="index.php">
                    <img src="<?php echo $url; ?>assets/images/brand/aai.png" class="header-brand-img" alt="AAI">
                </a>

                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown d-none d-md-flex" >
                        <a  class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize-2"  id="fullscreen-button"></i>
                        </a>
                    </div>

                    <div class="dropdown ">
                        <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                            <img src="<?php echo $url; ?>assets/images/faces/default-user.png" alt="profile-img" class="avatar avatar-md brround">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                            <a class="dropdown-item" href="<?php echo $url; ?>admin/change-password.php">
                                <i class="dropdown-icon  icon icon-pencil"></i> Change Password
                            </a>

                            <a class="dropdown-item" href="<?php echo $url; ?>logout.php">
                                <i class="dropdown-icon icon icon-power"></i> Log out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar doc-sidebar">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div>
                    <img src="<?php echo $url; ?>assets/images/faces/default-user.png" alt="user-img" class="avatar avatar-lg brround">
                </div>

                <div class="user-info">
                    <h2> <?php echo $_SESSION['name']; ?></h2>
                    <span> <?php echo $_SESSION['email']; ?></span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>admin/index.php">
                    <i class="side-menu__icon fa fa-tachometer"></i>
                    <span class="side-menu__label">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>admin/hod.php">
                    <i class="side-menu__icon fa fa-user"></i>
                    <span class="side-menu__label">
                        HOD
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>admin/employee.php">
                    <i class="side-menu__icon fa fa-users"></i>
                    <span class="side-menu__label">
                        Employee
                    </span>
                </a>
            </li>
        </ul>
    </aside>