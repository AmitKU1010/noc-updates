    <!-- Header Menu -->
    <div class="app-header1 header py-1 d-flex">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="header-brand" href="index.php">
                    <img src="<?php echo $url; ?>assets/images/brand/aai.png" class="header-brand-img" alt="AAI">
                </a>

                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

                <!-- <div class="header-navicon mt-2">
                    <a href="create-request.html" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Create Request
                    </a>
                </div> -->

                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown d-none d-md-flex" >
                        <a  class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize-2"  id="fullscreen-button"></i>
                        </a>
                    </div>

                    <!-- Request Create Button -->
                    <div class="dropdown d-none d-md-flex country-selector">
                        <a href="#" class="d-flex nav-link leading-none">
                            <div>
                                <a href="<?php echo $url; ?>hod/pending-request.php" class="btn btn-primary">
                                    <i class="fa fa-exclamation-circle"></i> Pending Requests
                                </a>
                            </div>
                        </a>
                    </div>

                    <!-- Notification -->
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class=" nav-unread badge badge-danger  badge-pill">2</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a href="#" class="dropdown-item text-center">You have 2 notification</a>

                            <div class="dropdown-divider"></div>

                            <a href="<?php echo $url; ?>hod/pending-request.php" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-refresh"></i>
                                </div>

                                <div>
                                    <strong>Re-check request</strong>
                                    <div class="small text-muted">04:50 Pm</div>
                                </div>
                            </a>

                            <a href="<?php echo $url; ?>hod/pending-request.php" class="dropdown-item d-flex pb-3">
                                <div class="notifyimg">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>

                                <div>
                                    <strong>New Request</strong>
                                    <div class="small text-muted">10:50 Am</div>
                                </div>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- <a href="#" class="dropdown-item text-center">See all Notification</a> -->
                        </div>
                    </div>

                    <!-- Profile Action -->
                    <div class="dropdown ">
                        <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                            <img src="<?php if(isset($profile_picture)) echo $profile_picture; ?>" alt="profile-img" class="avatar avatar-md brround">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                            <a class="dropdown-item" href="<?php echo $url; ?>hod/profile.php">
                                <i class="dropdown-icon  icon icon-user"></i> Profile
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
                    <img src="<?php if(isset($profile_picture)) echo $profile_picture; ?>" alt="user-img" class="avatar avatar-lg brround">
                </div>

                <div class="user-info">
                    <h2> <?php if(isset($name)) echo $name; ?></h2>
                    <span> <?php if(isset($email)) echo $email; ?></span>
                </div>
            </div>
        </div>

        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>hod/index.php">
                    <i class="side-menu__icon fa fa-tachometer"></i>
                    <span class="side-menu__label">
                        Dashboard
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>hod/pending-request.php">
                    <i class="side-menu__icon fa fa-exclamation-circle"></i>
                    <span class="side-menu__label">
                        Pending Requests
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>hod/recheck-request.php">
                    <i class="side-menu__icon fa fa-refresh"></i>
                    <span class="side-menu__label">
                        Re-check Requests
                    </span>
                </a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="<?php echo $url; ?>hod/approved-request.php">
                    <i class="side-menu__icon fa fa-check"></i>
                    <span class="side-menu__label">
                        Approved Requests
                    </span>
                </a>
            </li>

            <!-- <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-eye"></i>
                    <span class="side-menu__label">
                        View Request
                    </span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                
                <ul class="slide-menu">
                    <li>
                        <a href="pending-request.html" class="slide-item">Pending Request</a>
                    </li>

                    <li>
                        <a href="approved-request.html" class="slide-item">Approved Request</a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </aside>