<?php
session_start();
$id = $_GET["id"];
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
    <link href='../../assets/lib/main.css' rel='stylesheet' />
    <script src='../../assets/lib/main.js'></script>
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
                            <a class="dropdown-item" href='../profile.php'>
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
                        <a class="nav-link" href="secretaire_page.php">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Les formations</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='edt.php?id=" . $id . "'" ?>>
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Emploi de temps </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='View_cours.php?id=" . $id . "'"; ?>>
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Les Cours</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper" style="padding: 2%;">
                    <!-- hon el content li bl nos-->
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-5 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <?php

                                        require_once("../../../BLL/coursManager.php");
                                        require_once("../../../BLL/edtManager.php");
                                        include_once("../../../DTO/edt.php");
                                        if (isset($_POST['submitBtn'])) {
                                            try {
                                                $edt = new edt();
                                                $edt->setCours_Id($_POST['cour']);
                                                $edt->setStartDate($_POST['date_debut']);
                                                $edt->setStartTime($_POST['temp_debut']);
                                                $edt->setEndDate($_POST['date_fin']);
                                                $edt->setEndTime($_POST['temp_fin']);

                                                if (addedt($edt->getCours_Id(), $edt->getStartDate() . " " . $edt->getStartTime(), $edt->getEndDate() . " " . $edt->getEndTime())) {
                                                    echo "<script type='text/javascript'>"
                                                        . " window.location.href='edt.php?id=" . $id . "';"
                                                        . " </script> ";
                                                } else {
                                                    echo "<script type='text/javascript'>"
                                                        . " window.location.href='edt.php?id=" . $id . "';"
                                                        . " </script> ";
                                                }
                                            } catch (Exception $exc) {
                                                echo $exc->getTraceAsString();
                                            }
                                        } else {
                                        }
                                        ?>
                                        <form class="forms-sample" method="POST">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select class="select" name="cour">
                                                        <?php
                                                        $profs = getCoursbyFormationIddetails($id);
                                                        echo "<option value=" . '"' . "0" . '"' . ">" . "Cours" . "</option>";
                                                        if ($profs != null) {
                                                            for ($i = 0; $i < count($profs); $i++) {
                                                                echo "<option value=" . '"' . $profs[$i]->getId() . '"' . ">" . $profs[$i]->getNom() . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Debut</label>
                                                    <input type="date" class="form-control" name="date_debut">
                                                    <input type="time" class="form-control" name="temp_debut">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fin</label>
                                                    <input type="date" class="form-control" name="date_fin">
                                                    <input type="time" class="form-control" name="temp_fin">
                                                </div>
                                                <button type="submit" class="btn btn-primary mr-2" name="submitBtn">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





                            <div class="col-md-7 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <?php
                                                require_once("../../../BLL/formationManager.php");
                                                $formations = edtbyformation($id);
                                                if ($formations == null) {
                                                    echo "no results";
                                                } else {
                                                    if (isset($_POST['deleteBtn'])) {
                                                        if (deleteedt($_POST['deleteBtn'])) {
                                                            echo "<script type='text/javascript'>"
                                                                . " window.location.href='edt.php?id=" . $id . "';"
                                                                . " </script> ";
                                                        } else {
                                                            echo "<script type='text/javascript'>"
                                                                . " window.location.href='edt.php?id=" . $id . "';"
                                                                . "alert('Delete Failed');"
                                                                . " </script> ";
                                                        }
                                                    }

                                                    echo
                                                    "<tr>"
                                                        . "<th>" . "Cours" . "</th>"
                                                        . "<th>" . "Debut" . "</th>"
                                                        . "<th>" . "Fin" . "</th>"
                                                        . "<th>Delete</th>"
                                                        . "</tr>";

                                                    for ($i = 0; $i < count($formations); $i++) {
                                                        echo
                                                        "<tr>"
                                                            . "<td>" . getCoursbyId($formations[$i]->getCours_Id())->getNom() . "</td>"
                                                            . "<td>" . $formations[$i]->getStartDate() . " " . $formations[$i]->getStartTime() . "</td>"
                                                            . "<td>" . $formations[$i]->getEndDate() . " " . $formations[$i]->getEndTime() . "</td>"
                                                            . "<td><form method='POST'><button class='btn btn-link' name='deleteBtn' value='" . $formations[$i]->getId() . "'><i class='ti-trash '></i></button></form></td>"
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