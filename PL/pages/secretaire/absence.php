<?php
session_start();
$id = $_GET["id"];
$id_formation = $_GET["id_formation"];
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
                        <a class="nav-link" href="edt.php">
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Emploi de temps </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='View_cours.php?id=" . $id_formation . "'"; ?>>
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Les Cours</span>
                        </a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='Notes.php?id_formation=" . $id_formation . "&id=" . $id . "'"; ?>>
                            <i class="ti-medall menu-icon"></i>
                            <span class="menu-title">Les Notes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='absence.php?id_formation=" . $id_formation . "&id=" . $id . "'"; ?>>
                            <i class="ti-pencil menu-icon"></i>
                            <span class="menu-title">Les Absences</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <table class="table table-striped">
                        <?php
                        require('../../../BLL/presencesManager.php');
                        require('../../../BLL/usersManager.php');
                        require('../../../BLL/coursManager.php');
                        ?>
                        <form method="POST">
                            <?php
                            $courses = getPresenceByCours($id);
                            echo
                            "<thead>" .
                                "<tr>" .
                                "<th>" .
                                "Nom" .
                                "</th>" .
                                "<th>" .
                                "Prenom" .
                                "</th>" .
                                "<th>" .
                                "Status" .
                                "</th>" .
                                "<th>" .
                                "Date" .
                                "</th>" .
                                "<th>" .
                                "P<=>A" .
                                "</th>" .
                                "</tr>" .
                                "</thead>";
                            if ($courses != null) {
                                $c = getCoursbyId($id);
                                echo "<h3>" . $c->getNom() . ":</h3> ";
                                for ($i = 0; $i < count($courses); $i++) {
                                    $s = UserByid($courses[$i]->getEtudiantId());

                                    echo "<tr>"
                                        . "<td>" . $s->getNom() . "</td>"
                                        . "<td>" . $s->getPrenom() . "</td>"
                                        . "<td>" . $courses[$i]->getStatus() . "</td>"
                                        . "<td>" . $courses[$i]->getDate() . "</td>"
                                        . "<td><button name='sbmtBtn' value='" . $courses[$i]->getEtudiantId() . "'>Changer</button></td>"
                                        . "</tr>";
                                    if (isset($_POST["sbmtBtn"])) {
                                        $pres = new presence();
                                        $pres->setEtudiantId($_POST["sbmtBtn"]);
                                        $pres->setCourId($id);
                                        $pres->setDate($courses[$i]->getDate());
                                        if ($courses[$i]->getStatus() == "A") {
                                            $pres->setStatus("P");
                                        } else {
                                            $pres->setStatus("A");
                                        }
                                        updateStatus($pres);
                                        echo "<script type='text/javascript'>"
                                            . " window.location.href='absence.php?id_formation=" . $id_formation . "&id=" . $id . "'"
                                            . "</script>";
                                    }
                                }
                            }
                            ?>
                        </form>
                    </table>
                </div>
            </div>
        </div>
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