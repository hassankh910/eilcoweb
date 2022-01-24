<?php
session_start();
?>
<!DOCTYPE html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>View Users</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../styles/admin_page.css">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php

          require_once('../../../BLL/usersManager.php');
          include_once("../../../DTO/user.php");

          if (isset($_POST['submitBtn'])) {
            $id = $_POST['submitBtn'];

            if (deleteUser($id)) {
              echo "<script type='text/javascript'>"
                . " window.location.href='ViewUsers.php';"
                . " </script> ";
            } else {
              echo "<script type='text/javascript'>"
                . " window.location.href='ViewUsers.php';"
                . "alert('Delete Failed');"
                . " </script> ";
            }
          }
          ?>

          <form method="POST">
            <div class="row">

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Etudiants</h4>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <?php
                        require_once('../../../BLL/usersManager.php');
                        require_once('../../../BLL/formationManager.php');
                        include_once("../../../DTO/user.php");
                        $profiles = getAllStudents();

                        if ($profiles == null) {
                          echo "no results";
                        } else {
                          echo
                          "<thead>" .
                            "<tr>" .
                            "<th>" .
                            "Id" .
                            "</th>" .
                            "<th>" .
                            "Prenom" .
                            "</th>" .
                            "<th>" .
                            "Nom" .
                            "</th>" .
                            "<th>" .
                            "email personel" .
                            "</th>" .
                            "<th>" .
                            "email universitaire" .
                            "</th>" .
                            "<th>" .
                            "Formation" .
                            "</th>" .
                            "<th>" .
                            "Delete" .
                            "</th>" .
                            "</tr>" .
                            "</thead>";

                          for ($i = 0; $i < count($profiles); $i++) {
                            echo
                            "<tr>"
                              . "<td>" . $profiles[$i]->getId() . "</td>"
                              . "<td>" . $profiles[$i]->getPrenom() . "</td>"
                              . "<td>" . $profiles[$i]->getNom() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_personel() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_universitaire() . "</td>"
                              . "<td>" . GetFormationname($profiles[$i]->getFormationId()) . "</td>"
                              . "<td><button class='btn btn-danger' name='submitBtn' value='" . $profiles[$i]->getId() . "'>Delete</button></td>"
                              . "</tr>";
                          }
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="row">

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Professeurs</h4>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <?php
                        require_once('../../../BLL/usersManager.php');
                        require_once('../../../BLL/formationManager.php');
                        include_once("../../../DTO/user.php");
                        $profiles = getAllProf();


                        if ($profiles == null) {
                          echo "no results";
                        } else {
                          echo
                          "<thead>" .
                            "<tr>" .
                            "<th>" .
                            "Id" .
                            "</th>" .
                            "<th>" .
                            "Prenom" .
                            "</th>" .
                            "<th>" .
                            "Nom" .
                            "</th>" .
                            "<th>" .
                            "email personel" .
                            "</th>" .
                            "<th>" .
                            "email universitaire" .
                            "</th>" .
                            "<th>" .
                            "Delete" .
                            "</th>" .
                            "</tr>" .
                            "</thead>";

                          for ($i = 0; $i < count($profiles); $i++) {
                            echo
                            "<tr>"
                              . "<td>" . $profiles[$i]->getId() . "</td>"
                              . "<td>" . $profiles[$i]->getPrenom() . "</td>"
                              . "<td>" . $profiles[$i]->getNom() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_personel() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_universitaire() . "</td>"
                              . "<td><button class='btn btn-danger' name='submitBtn' name='submitBtn' value='" . $profiles[$i]->getId() . "'>Delete</button></td>"
                              . "</tr>";
                          }
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Secretaires</h4>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <?php
                        require_once('../../../BLL/usersManager.php');
                        require_once('../../../BLL/formationManager.php');
                        include_once("../../../DTO/user.php");
                        $profiles = getAllSec();


                        if ($profiles == null) {
                          echo "no results";
                        } else {
                          echo
                          "<thead>" .
                            "<tr>" .
                            "<th>" .
                            "Id" .
                            "</th>" .
                            "<th>" .
                            "Prenom" .
                            "</th>" .
                            "<th>" .
                            "Nom" .
                            "</th>" .
                            "<th>" .
                            "email personel" .
                            "</th>" .
                            "<th>" .
                            "email universitaire" .
                            "</th>" .
                            "<th>" .
                            "Delete" .
                            "</th>" .
                            "</tr>" .
                            "</thead>";

                          for ($i = 0; $i < count($profiles); $i++) {
                            echo
                            "<tr>"
                              . "<td>" . $profiles[$i]->getId() . "</td>"
                              . "<td>" . $profiles[$i]->getPrenom() . "</td>"
                              . "<td>" . $profiles[$i]->getNom() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_personel() . "</td>"
                              . "<td>" . $profiles[$i]->getEmail_universitaire() . "</td>"
                              . "<td><button class='btn btn-danger' name='submitBtn' name='submitBtn' value='" . $profiles[$i]->getId() . "'>Delete</button></td>"
                              . "</tr>";
                          }
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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