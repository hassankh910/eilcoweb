<?php
session_start();
$id=$_GET["id"];
$id_formation=$_GET["id_formation"];
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
                        <a class="nav-link" <?php echo "href='View_cours.php?id=".$id_formation."'"; ?>>
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Les Cours</span>
                        </a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php echo "href='Notes.php?id_formation=".$id_formation."&id=".$id."'"; ?>>
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Les Notes</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                <table class="table table-striped">
                        <?php
                        require('../../../BLL/notesManager.php');
                        require('../../../BLL/usersManager.php');
                        $courses = GetnotesByCours($id);
                        $totalNbCredit = 0;
                        $moyenne = 0;
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
                            "Note" .
                            "</th>" .
                            "<th>" .
                            "Nombre de credits" .
                            "</th>" .
                            "<th>" .
                            "Total" .
                            "</th>" .
                            "</tr>" .
                            "</thead>";
                        if ($courses != null) {
                            echo count($courses);
                            for ($i = 1; $i <= count($courses); $i++) {
                                if($courses[$i]!=null) {
                                    $s = UserByid($i);
                                echo "<tr>"
                                    . "<td>" . $i . "</td>"
                                    . "<td>" . $s->getNom() . "</td>"
                                    . "<td>" . getNoteCour($u->getId(), $courses[$i]->getId()) . "</td>"
                                    . "<td>" . $courses[$i]->getNb_credits() . "</td>"
                                    . "<td>" . getNoteCour($u->getId(), $courses[$i]->getId()) * $courses[$i]->getNb_credits() . "</td>"
                                    . "</tr>";
                                
                                $totalNbCredit = $totalNbCredit + $courses[$i]->getNb_credits();
                                $moyenne = $moyenne + getNoteCour($u->getId(), $courses[$i]->getId()) * $courses[$i]->getNb_credits();
                                
                            }}
                            // echo "<tr>"
                            //     . "<td></td>"
                            //     . "<td>Moyenne</td>"
                            //     . "<td>" . $moyenne / $totalNbCredit . "</td>"
                            //     . "<td>" . $totalNbCredit . "</td>"
                            //     . "<td>" . $moyenne . "</td>"
                            //     . "</tr>";
                        }
                        else {
                            echo "dfghjk";
                        }
                        ?>
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