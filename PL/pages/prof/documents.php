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
                        <?php
                        echo "<a class='nav-link' href='documents.php?id=" . $cours_id . "'>"
                            . "<i class='ti-import menu-icon'></i>"
                            . "<span class='menu-title'>Documents</span>"
                            . "</a>"
                        ?>
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
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <?php
                                            require("../../../BLL/documentsManager.php");
                                            $documents = getDocument($cours_id);
                                            if (isset($_POST['downloadBtn'])) {
                                                $filepath = __DIR__ . "/../../../DAL/uploadeddocuments/" . $_POST['downloadBtn'];

                                                download($filepath);
                                            }
                                            if (isset($_POST['deleteBtn'])) {
                                                if (deleteDocument($_POST['deleteBtn'], $_SESSION['fichierviser'])) {
                                                    echo "<script type='text/javascript'>"
                                                        . " window.location.href='documents.php?id=" . $cours_id . "';"
                                                        . " </script> ";
                                                } else {
                                                    echo "<script type='text/javascript'>"
                                                        . " window.location.href='documents.php?id=" . $cours_id . "';"
                                                        . "alert('Delete Failed');"
                                                        . " </script> ";
                                                }
                                            }
                                            echo "<thead>"
                                                . "<tr>"
                                                . "<th>Fichier</th>"
                                                . "<th>Date</th>"
                                                . "<th>Download</th>"
                                                . "<th>Delete</th>"
                                                . "</tr>"
                                                . "</thead>"
                                                . "<tbody>";
                                            if ($documents != null)
                                                for ($i = 0; $i < count($documents); $i++) {
                                                    $_SESSION['fichierviser'] = $documents[$i]->getLien();
                                                    echo "<tr>"
                                                        . "<td>" . $documents[$i]->getNom() . "</td>"
                                                        . "<td>" . $documents[$i]->getDate() . "</td>"
                                                        . "<td><form method='POST'><button class='btn btn-link' name='downloadBtn' value='" . $documents[$i]->getLien() . "'><i class='ti-download menu-icon'></i></button></form></td>"
                                                        . "<td><form method='POST'><button class='btn btn-link' name='deleteBtn' value='" . $documents[$i]->getId() . "'><i class='ti-trash '></i></button></form></td>";
                                                }
                                            echo "</tbody>";
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    if (isset($_POST["submit"])) {
                        $target_dir = "../../../DAL/uploadeddocuments/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                        // Check if file already exists
                        if (file_exists($target_file)) {
                            echo "<script>alert('Sorry, file already exists.')</script>";
                            $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "<script>alert('Sorry, your file is too large.')</script>";
                            $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                            // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $doc = new document();
                                $doc->setNom(htmlspecialchars(basename($_FILES["fileToUpload"]["name"])));
                                $doc->setLien(htmlspecialchars(basename($_FILES["fileToUpload"]["name"])));
                                $doc->setCours_id($cours_id);
                                addDocument($doc);
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='documents.php?id=" . $cours_id . "';"
                                    . "alert('The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.');"
                                    . " </script> ";
                            } else {
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='documents.php?id=" . $cours_id . "';"
                                    . "alert('Sorry, there was an error uploading your file.');"
                                    . " </script> ";
                            }
                        }
                    }
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        Select document to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
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