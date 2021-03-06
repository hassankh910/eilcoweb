<!DOCTYPE html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Courses</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
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
                            <span class="menu-title">Acceuil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Utilisateur </span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="./AddStudent.php">Ajouter un etudiant </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./AddProf.php">Ajouter un professeur </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./AddSecretaire.php">Ajouter un secretaire </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./ViewUsers.php">Voire les utilisateurs </a></li>

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
                                <li class="nav-item"> <a class="nav-link" href="./AddCourse.php">Ajouter un cour </a></li>
                                <li class="nav-item"> <a class="nav-link" href="./ViewCourses.php"> Voir les cours</a></li>
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
                                <li class="nav-item"> <a class="nav-link" href="./AddFormation.php">Ajouter une formation</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Cours</h4>

                                    <div class="table-responsive">
                                        <?php

                                        require_once('../../../BLL/coursManager.php');
                                        include_once("../../../DTO/cour.php");

                                        if (isset($_POST['submitBtn'])) {
                                            $id = $_POST['submitBtn'];
                                            if (deleteCour($id)) {
                                                echo "<script type='text/javascript'>"
                                                    . " window.location.href='ViewCourses.php';"
                                                    . " </script> ";
                                            } else {
                                                echo "<script type='text/javascript'>"
                                                    . " window.location.href='ViewCourses.php';"
                                                    . "alert('Delete Failed');"
                                                    . " </script> ";
                                            }
                                        }
                                        ?>

                                        <form method="POST">
                                            <table class="table table-striped">
                                                <?php
                                                require_once('../../../BLL/usersManager.php');
                                                require_once('../../../BLL/formationManager.php');
                                                $profiles = getAllCours();


                                                if ($profiles == null) {
                                                    echo "no results";
                                                } else {
                                                    echo
                                                    "<thead>" .
                                                        "<tr>" .
                                                        "<th>" .
                                                        "Abreviation" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Nom" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Prof" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Formation" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Nombre de credits" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Delete" .
                                                        "</th>" .
                                                        "</tr>" .
                                                        "</thead>";

                                                    for ($i = 0; $i < count($profiles); $i++) {
                                                        $prof = getProfName($profiles[$i]->getProf_id());
                                                        echo
                                                        "<tr>"
                                                            . "<td>" . $profiles[$i]->getAbreviation() . "</td>"
                                                            . "<td>" . $profiles[$i]->getNom() . "</td>"
                                                            . "<td>" . strtoupper($prof->getNom()) . " " . ucfirst($prof->getPrenom()) . "</td>"
                                                            . "<td>" .  GetFormationname($profiles[$i]->getFormation_id()) . "</td>"
                                                            . "<td>" . $profiles[$i]->getNb_credits() . "</td>"
                                                            . "<td><button class='btn btn-danger' name='submitBtn' value='" . $profiles[$i]->getId() . "'>Delete</button></td>"
                                                            . "</tr>";
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../../scripts/admin/js/off-canvas.js"></script>
        <script src="../../scripts/admin/js/hoverable-collapse.js"></script>
        <script src="../../scripts/admin/js/template.js"></script>
        <script src="../../scripts/admin/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->
</body>

</html>