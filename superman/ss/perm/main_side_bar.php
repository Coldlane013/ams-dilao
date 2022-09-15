   <div class="container-scroller">
       <div class="row p-0 m-0 proBanner" id="proBanner">
           <div class="col-md-12 p-0 m-0">
           </div>
       </div>
       <!-- partial:partials/_sidebar.html -->
       <nav class="sidebar sidebar-offcanvas" id="sidebar">
           <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
               <a class="sidebar-brand brand-logo" href="dashboard"><img src="../../assets/images/mainbrand.png" alt="logo" /></a>
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
                                        echo  '<img class="img-xs rounded-circle " src="../../assets/images/faces/male.png" alt="">';
                                        ?>
                                       <span class="count bg-success"></span>
                                   </div>
                                   <div class="profile-name">
                                       <?php

                                        $user_id = $_SESSION['super_id'];
                                        $conn = new class_model();
                                        $user = $conn->super_account($user_id);
                                        echo '<h5 class="mb-0 font-weight-normal">' . ucwords($user['name']) . '</h5>';
                                        ?>

                                       <?php

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
                   <a class="nav-link" href="dashboard">
                       <span class="menu-icon">
                           <i class="mdi mdi-speedometer"></i>
                       </span>
                       <span class="menu-title">Dashboard</span>
                   </a>
               </li>
               <li class="nav-item menu-items">
                   <a class="nav-link" href="attendance">
                       <span class="menu-icon">
                           <i class="mdi mdi-laptop"></i>
                       </span>
                       <span class="menu-title">Check Attendance</span>
                   </a>
               </li>
               </li>
               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_employee">
                       <span class="menu-icon">
                           <i class="mdi mdi-playlist-play"></i>
                       </span>
                       <span class="menu-title">Manage Users</span>
                   </a>
               </li>

               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_admin">
                       <span class="menu-icon">
                           <i class="mdi mdi-table-large"></i>
                       </span>
                       <span class="menu-title">Manage Admin</span>
                   </a>
               </li>

               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_schedule">
                       <span class="menu-icon">
                           <i class="mdi mdi-chart-bar"></i>
                       </span>
                       <span class="menu-title">Manage Schedules</span>
                   </a>
               </li>
               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_attendance">
                       <span class="menu-icon">
                           <i class="mdi mdi-contacts"></i>
                       </span>
                       <span class="menu-title">Manage Attendance</span>
                   </a>
               </li>
               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_report">
                       <span class="menu-icon">
                           <i class="mdi mdi-contacts"></i>
                       </span>
                       <span class="menu-title">Manage Reports</span>
                   </a>
               </li>
               <li class="nav-item menu-items">
                   <a class="nav-link" href="manage_profile">
                       <span class="menu-icon">
                           <i class="mdi mdi-security"></i>
                       </span>
                       <span class="menu-title">Manage Profile</span>
                   </a>
               </li>
           </ul>
       </nav>