<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Formarion</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../styles/admin_page.css">
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <!-- <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/eilco-logo.png" class="mr-2" alt="logo" /></a> -->
                <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a> -->
                <h3 style="color: white; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Eilco Portail</h3>
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

                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <?php
                                            require_once("../../../BLL/formationManager.php");
                                            require_once("../../../BLL/usersManager.php");
                                            $formations = getAllFormations();
                                            if ($formations == null) {
                                                echo "no results";
                                            } else {
                                                echo
                                                "<tr>"
                                                    . "<th>" . "Formation" . "</th>"
                                                    . "<th>" . "Nb Etudiant" . "</th>"
                                                    . "</tr>";

                                                for ($i = 0; $i < count($formations); $i++) {
                                                    echo
                                                    "<tr>"
                                                        . "<td>" . $formations[$i]->getNom() . "</td>"
                                                        . "<td>" . GetStudentsbyFormation($formations[$i]->getId()) . "</td>"
                                                        . "</tr>";
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Add Formation</h4>
                                    <?php

                                    include_once("../../../DTO/formation.php");

                                    if (isset($_POST['submitBtn'])) {


                                        $nom = $_POST['nom'];

                                        try {
                                            $formation = new formation();
                                            $formation->setNom($nom);

                                            if (addnewFormation($formation)) {
                                                echo "<script type='text/javascript'>"
                                                    . " window.location.href='AddFormation.php';"
                                                    . "alert('formation added!');"
                                                    . " </script> ";
                                            } else {
                                                echo "<script type='text/javascript'>"
                                                    . " window.location.href='AddFormation.php';"
                                                    .  "alert('Faild to add formation!');"
                                                    . " </script> ";
                                            }
                                        } catch (Exception $exc) {
                                            echo $exc->getTraceAsString();
                                        }
                                    }
                                    ?>
                                    <form class="forms-sample" method="POST">
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" name="nom" placeholder="Nom Formation">
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2" name="submitBtn">Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <!-- partial -->
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../scripts/admin/js/off-canvas.js"></script>
    <script src="../../scripts/admin/js/hoverable-collapse.js"></script>
    <script src="../../scripts/admin/js/template.js"></script>
    <script src="../../scripts/admin/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../scripts/admin/js/file-upload.js"></script>
    <!-- End custom js for this page-->
</body>

</html>