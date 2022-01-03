<?php
session_start();
$cours_id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eilco</title>
    <!-- icons -->
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">

    <link rel="stylesheet" href="../../styles/admin_page.css">

    <link rel="stylesheet" href="../../styles/rome.css">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <h3 style="color: white; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Eilco Portail</h3>
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
                            <a class="dropdown-item">
                                <i class="ti-settings text-primary"></i> Profile
                            </a>
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
                        <a class="nav-link" href="prof_page.php">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <?php
                        echo "<a class='nav-link' href='notes.php?id=".$cours_id."'>"
                            ."<i class='ti-medall  menu-icon'></i>"
                            ."<span class='menu-title'>Notes</span>"
                       ."</a>"
                        ?>
                    </li>

                    <li class="nav-item">
                    <?php
                        echo "<a class='nav-link' href='absence.php?id=".$cours_id."'>"
                            ."<i class='ti-pencil  menu-icon'></i>"
                            ."<span class='menu-title'>Absences</span>"
                       ."</a>"
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">
                            <i class="ti-import menu-icon"></i>
                            <span class="menu-title">Documents</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- hon el content li bl nos-->
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
           $profiles =  GetAllStudentsbycour($cours_id);
          if ($profiles == null) {
            echo "no results";
          } else {
            echo
            "<thead>" .
              "<tr>" .
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
           
              "</tr>" .
              "</thead>";

            for ($i = 0; $i < count($profiles); $i++) {
              echo
              "<tr>"
                . "<td>" . $profiles[$i]->getPrenom() . "</td>"
                . "<td>" . $profiles[$i]->getNom() . "</td>"
                . "<td>" . $profiles[$i]->getEmail_personel() . "</td>"
                . "<td>" . $profiles[$i]->getEmail_universitaire() . "</td>"
                . "<td>" . GetFormationname($profiles[$i]->getFormationId()) . "</td>"
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





                </div>
            </div>
            <nav class="sidebar calendarbar" id="sidebar">
                <form action="#" class="row">
                    <div class="col-md-12">
                        <div id="inline_cal"></div>
                    </div>
                </form>
        </div>
    </div>

    <!-- plugins:js lal profile-->
    <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>
        <!-- lal nav wl responsive -->
    <script src="../../scripts/admin/js/off-canvas.js"></script>
    <!-- lal calendar-->
    <script src="../../scripts/student/js/rome.js"></script>

    <script src="../../scripts/student/js/main.js"></script>
</body>

</html>