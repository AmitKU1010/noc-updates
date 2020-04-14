    <!-- Top Menu -->
    <div class="app-header1 header py-1 d-flex">
        <div class="container-fluid">
            <div class="d-flex">
                <a class="header-brand" href="https://www.mixblack.co.in/" target="_blank">
                    <img src="assets/images/brand/mixblack-logo.svg" class="header-brand-img" alt="MIXblack">
                </a>

                <!-- <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a> -->

                <p class="mt-2 ml-4">DATE: <span class="btn btn-primary"><?php echo date("d-m-Y"); ?></span></p>

                <p class="mt-2 ml-4">TIME: <span id="txt" class="btn btn-primary"></span></p>

                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown d-none d-md-flex" >
                        <a  class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize-2" id="fullscreen-button"></i>
                        </a>
                    </div>

                    <div class="dropdown ">
                        <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                            <img src="assets/images/brand/mix-logo.svg" alt="profile-img" class=" bg-light avatar avatar-md brround">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                            <a class="dropdown-item" href="<?php echo $url; ?>profile.php">
                                <i class="dropdown-icon icon icon-user"></i> My Profile
                            </a>

                            <a class="dropdown-item" href="<?php echo $url; ?>members.php">
                                <i class="dropdown-icon icon icon-people"></i> All Members
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