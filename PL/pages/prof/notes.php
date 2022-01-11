<?php

session_start();
$cours_id = $_GET["id"];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
                        <a class="nav-link" href="prof_page.php">
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>



                    <li class="nav-item">
                        <?php
                        echo "<a class='nav-link' href='notes.php?id=" . $cours_id . "'>"
                            . "<i class='ti-medall  menu-icon'></i>"
                            . "<span class='menu-title'>Notes</span>"
                            . "</a>"
                        ?>
                    </li>

                    <li class="nav-item">
                        <?php
                        echo "<a class='nav-link' href='absence.php?id=" . $cours_id . "'>"
                            . "<i class='ti-pencil  menu-icon'></i>"
                            . "<span class='menu-title'>Absences</span>"
                            . "</a>"
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
                                    <h4 class="card-title">Notes</h4>
                                    <?php
                                    require_once('../../../BLL/notesManager.php');
                                    require_once('../../../BLL/usersManager.php');
                                    if (isset($_POST['submitBtn'])) {
                                        $profiles =  GetAllStudentsbycour($cours_id);

                                        for ($i = 0; $i < count($profiles); $i++) {
                                            $note = $_POST[$profiles[$i]->getId()];
                                            addNotes($cours_id, $profiles[$i]->getId(), $note);
                                        }
                                        echo "<script type='text/javascript'>"
                                            . " window.location.href='cours.php?id=" . $cours_id . "';"
                                            . " </script> ";
                                    }
                                    ?>
                                    <form method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <?php
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
                                                        "Formation" .
                                                        "</th>" .
                                                        "<th>" .
                                                        "Note" .
                                                        "</th>" .

                                                        "</tr>" .
                                                        "</thead>";

                                                    for ($i = 0; $i < count($profiles); $i++) {
                                                        echo
                                                        "<tr>"
                                                            . "<td>" . $profiles[$i]->getPrenom() . "</td>"
                                                            . "<td>" . $profiles[$i]->getNom() . "</td>"

                                                            . "<td>" . GetFormationname($profiles[$i]->getFormationId()) . "</td>"
                                                            . "<td><input type='text' name=" . $profiles[$i]->getId() . " class='form-control-1 notes' style='width: 2.5rem;'></td>"
                                                            . "</tr>";
                                                    }
                                                }
                                                ?>
                                            </table>

                                        </div>
                                        <button class="btn btn-info" name="submitBtn">submit </button>
                                    </form>
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