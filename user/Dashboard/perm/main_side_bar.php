<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
        </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="user"><img src="../../assets/images/mainbrand.png" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                        </div>

                        <div class="profile-name">
                            <div class="profile-pic">
                                <div class="count-indicator">
                                    <?php

                                    $user_id = $_SESSION['employee_id'];
                                    $conn = new class_model();
                                    $user = $conn->employee_account($user_id);
                                    ?>
                                    <?php
                                    if ($user['gender'] == 'Male') {
                                        echo  '<img class="img-xs rounded-circle " src="../../assets/images/faces/male.png" alt="">';
                                    } else {
                                        echo  '<img class="img-xs rounded-circle " src="../../assets/images/faces/female.png" alt="">';
                                    }
                                    ?>
                                    <span class="count bg-success"></span>
                                </div>
                                <div class="profile-name">
                                    <?php
                                    echo '<h5 class="mb-0 font-weight-normal">' . ucwords($user['first_name']) . '</h5>';
                                    ?>
                                </div>
                            </div>

                        </div>

                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-primary"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Navigation</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="user">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="attendance">
                    <span class="menu-icon">
                        <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">View Attendance</span>
                </a>
            </li>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="manage_profile">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">Manage Profile</span>
                </a>
            </li>
        </ul>
    </nav>
    <style>
        <?php include 'CSS/userstyle.css'; ?>
    </style>