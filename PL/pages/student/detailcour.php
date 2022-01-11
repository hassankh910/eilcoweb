<?php
session_start();
$id = $_GET['id'];
?>
<!DOCTYPE html>

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
                                <i class="ti-user text-primary"></i> Profile
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
                        <a class="nav-link" href="student_page.php">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Mes Cours</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="edt.php">
                            <i class="ti-user menu-icon"></i>
                            <span class="menu-title">Emploi de temps </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="notes.php">
                            <i class="ti-medall menu-icon"></i>
                            <span class="menu-title">Mes Notes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="absence.php">
                            <i class="ti-pencil menu-icon"></i>
                            <span class="menu-title">Mes Absences</span>
                        </a>
                    </li>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- hon el content li bl nos-->
                    <?php
                    require('../../../BLL/coursManager.php');
                    require('../../../BLL/usersManager.php');
                    $cours = getCoursId($id);
                    echo "<div class='cours'>"
                        . "<h3 style='margin-top:2% ; margin-left:2%'>Cours :" . $cours->getNom() . "</h3>"
                        . "<h4 style='margin-top:2% ; margin-left:2%'>Enseignant:";
                    $prof = getProfName($cours->getProf_id());
                    echo strtoupper($prof->getNom()) . " " . ucfirst($prof->getPrenom()) . "</h4>"
                        . "<h5 style='margin-top:2% ; margin-left:2%'>Address mail : " . $prof->getEmail_universitaire() . "</h5>"
                        . "</div>";
                    ?>

                    <?php
                    echo "<table class='table table-striped'>";
                    require("../../../BLL/documentsManager.php");
                    $documents = getDocument($id);
                    if (isset($_POST['downloadBtn'])) {
                        $filepath = __DIR__ . "/../../../DAL/uploadeddocuments/" . $_POST['downloadBtn'];
                        download($filepath);
                    }
                    echo "<thead>"
                        . "<tr>"
                        . "<th>Fichier</th>"
                        . "<th>Date</th>"
                        . "<th>Download</th>"
                        . "</tr>"
                        . "</thead>"
                        . "<tbody>";
                    if ($documents != null)
                        for ($i = 0; $i < count($documents); $i++) {
                            $_SESSION['fichierviser'] = $documents[$i]->getLien();
                            echo "<tr>"
                                . "<td>" . $documents[$i]->getNom() . "</td>"
                                . "<td>" . $documents[$i]->getDate() . "</td>"
                                . "<td><form method='POST'><button class='btn btn-link' name='downloadBtn' value='" . $documents[$i]->getLien() . "'><i class='ti-download menu-icon'></i></button></form></td>";
                        }
                    echo "</tbody></table>";
                    ?>

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