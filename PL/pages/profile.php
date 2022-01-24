<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eilco Portail</title>
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="../styles/admin_page.css">
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
                            require("../../DTO/user.php");
                            echo "<h3>" . unserialize($_SESSION['loggeduser'])->getUsername() . "</h3>";
                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="logout.php">
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
                        <?php
                        if (unserialize($_SESSION['loggeduser'])->getRole() == 3) {
                            echo "<a class='nav-link' href='prof/prof_page.php'>";
                        } else if (unserialize($_SESSION['loggeduser'])->getRole() == 2) {
                            echo "<a class='nav-link' href='student/student_page.php'>";
                        } else if (unserialize($_SESSION['loggeduser'])->getRole() == 4) {
                            echo "<a class='nav-link' href='secretaire/secretaires_page.php'>";
                        }
                        ?>
                            <i class="ti-home menu-icon"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="adminstyle">
                        <div class="col-md-6 mb-4  ">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <?php
                                    require('../../BLL/usersManager.php');
                                    require('../../BLL/formationManager.php');

                                    $prof = unserialize($_SESSION['loggeduser']);

                                    echo
                                    "<p><b>Nom: </b> " . $prof->getNom() . "</p>"
                                        . "<p><b>Prenom: </b>" . $prof->getPrenom() . "</p>"
                                        . "<p><b>Nom d'utilisateur: </b>" . $prof->getUsername() . "</p>"
                                        . "<p><b>Courriel universitaire: </b>" . $prof->getEmail_universitaire() . "</p>"
                                        . "<p><b>Courriel personnel: </b>" . $prof->getEmail_personel() . "</p>"
                                        . "<p><b>Date De Naissance: </b> " . $prof->getDate_de_naissance() . "</p>"
                                        . "<p><b>N° Téléphone portable: </b>" . $prof->getPhone() . "</p>"
                                        . "<p><b>Formation: </b>" . GetFormationname($prof->getFormationId()) . "</p>"
                                        . "<p><b>Nationnalite: </b>" . $prof->getNationalite()  . "</p>"
                                        . "<p><b>Adresse: </b>" . $prof->getAdresse()  . "</p>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4  ">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <?php
                                    if (isset($_POST['submitBtn'])) {
                                        $pass = $_POST['newpass'];
                                        $old = $_POST['oldPass'];
                                        $comf = $_POST['comfpass'];
                                        $u = unserialize($_SESSION['loggeduser']);
                                        if ($old != $u->getPassword()) {
                                            echo "<script type='text/javascript'>"
                                                .  "alert('your old pass is not correct!');"
                                                . " </script> ";
                                        } else {
                                            if ($pass == $comf) {
                                            if (UpdatePass($u->getId(), $pass)) {
                                                $u->setPassword($pass);
                                                $_SESSION['loggeduser']=serialize($u);
                                                echo "<script type='text/javascript'>"
                                                    . "alert('Pass Updated!');"
                                                    . " </script> ";
                                            } else {
                                                echo "<script type='text/javascript'>"
                                                    .  "alert('Faild to update pass!');"
                                                    . " </script> ";
                                            }
                                        }else {
                                            echo "<script type='text/javascript'>"
                                            .  "alert('check the confirmation of the new pass!');"
                                            . " </script> ";
                                        }
                                        }
                                    }
                                    ?>
                                    <form method="POST">
                                        <h3>Modifier le mot de passe</h3>
                                        <p>Ancien mot de passe</p>
                                        <input type="password" name="oldPass" />
                                        <hr>
                                        <p>Nouveau mot de passe</p>
                                        <input type="password" name="newpass" />
                                        <p>Confirmer mot de passe</p>
                                        <input type="password" name="comfpass" />
                                        <br>

                                        <br>
                                        <button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <!-- plugins:js lal side nav -->
            <script src="../assets/vendors/base/vendor.bundle.base.js"></script>

            <!-- lal nav wl responsive -->
            <script src="../scripts/admin/js/off-canvas.js"></script>

            <!-- lal checkpoint li bl todolist -->
            <script src="../scripts/admin/js/template.js"></script>

            <!-- lal todo list-->
            <script src="../scripts/admin/js/todolist.js"></script>
</body>

</html>