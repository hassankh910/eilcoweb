<body>
    <?php
    session_start();
    require_once('../../BLL/notesManager.php');
    require_once('../../BLL/usersManager.php');
    include_once("../../DTO/user.php");
    if (isset($_POST['submitBtn'])) {
        $profiles =  GetAllStudentsbycour($_SESSION['cours_id']);

        for ($i = 0; $i < count($profiles); $i++) {
            $note = $_POST[$profiles[$i]->getId()];
            addNotes($_SESSION['cours_id'],$profiles[$i]->getId(),$note);
        }
        echo "<script type='text/javascript'>"
        . " window.location.href='./prof/cours.php?id=".$_SESSION['cours_id']."';"
        . " </script> ";
    } else {
        echo "<script type='text/javascript'>"
        . " window.location.href='./prof/cours.php?id=".$_SESSION['cours_id']."';"
        . "alert('Error adding notes!');"
        . " </script> ";
    }
    ?>
</body>