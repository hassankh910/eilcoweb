<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eilco Portail</title>
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../styles/admin_page.css">
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <h3 style=" font-size: 2rem;color: white; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Eilco Portail</h3>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <?php
                            session_start();
                            require("../../../DTO/user.php");
                            echo "<h3>" . unserialize($_SESSION['loggeduser'])->getUsername() . "</h3>";
                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="../logout.php">
                                <i class="ti-power-off text-primary"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="ti-view-list"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./admin_page.php">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">User </span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./AddStudent.php">Add Student </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./AddProf.php">Add Prof </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./AddSecretaire.php">Add Secretaire </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./View_Students.php">View Users </a></li>

                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth1" aria-expanded="false" aria-controls="auth">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Cours</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./AddCourse.php">Add Cours </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./ViewCourses.php"> View Courses </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Formations</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth2">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./AddFormation.php">Add Formation </a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="adminstyle">
                        <div class="col-md-4 mb-4  ">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <?php
                                    require_once("../../../BLL/usersManager.php");


                                    echo " <p class= mb-4 >Nombres des etudiants</p>";
                                    echo
                                    "<p>" . GetAllStudentsCount() . "</p>";



                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <?php
                                    require_once("../../../BLL/usersManager.php");


                                    echo " <p class= mb-4 >Nombres des Profs</p>";
                                    echo
                                    "<p>" . getAllProfC() . "</p>";



                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Nombres des Secretaires</p>
                                    <p>2</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adminstyle">

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card tale-bg ">
                            <div class="card-people mt-auto ">





                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin transparent">
                        <div class="row">

                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <?php
                                        require_once("../../../BLL/usersManager.php");


                                        echo " <p class= mb-4 >Nombres des CP</p>";
                                        echo
                                        "<p>" . getAllCP() . "</p>";



                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <?php
                                        require_once("../../../BLL/usersManager.php");
                                        echo " <p class= mb-4 >Nombres des Info</p>";
                                        echo
                                        "<p>" . getAllInfo() . "</p>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <?php
                                        require_once("../../../BLL/usersManager.php");
                                        echo " <p class= mb-4 >Nombres des GEE</p>";
                                        echo
                                        "<p>" . getAllGEE() . "</p>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <?php
                                        require_once("../../../BLL/usersManager.php");
                                        echo " <p class= mb-4 >Nombres des GI</p>";
                                        echo
                                        "<p>" . getAllGI() . "</p>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    </div>

    </div>

    <!-- plugins:js lal side nav -->
    <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>

    <!-- lal nav wl responsive -->
    <script src="../../scripts/admin/js/off-canvas.js"></script>

    <!-- lal checkpoint li bl todolist -->
    <script src="../../scripts/admin/js/template.js"></script>

    <!-- lal todo list-->
    <script src="../../scripts/admin/js/todolist.js"></script>
</body>

</html>