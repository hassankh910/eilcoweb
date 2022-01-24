<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AddStudent</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/base/vendor.bundle.base.css">

  <link rel="stylesheet" href="../../styles/admin_page.css">
</head>

<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
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
              session_start();
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
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php

                  require_once('../../../BLL/usersManager.php');
                  include_once("../../../DTO/user.php");

                  if (isset($_POST['submitBtn'])) {


                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $date_de_naissance = $_POST['date_de_naissance'];
                    $email_personel = $_POST['email_personel'];
                    $sexe = $_POST['sexe'];
                    $formation_id = $_POST['formation'];
                    $phone = $_POST['phone'];
                    $Adresse = $_POST['Adresse'] ." ". $_POST['ComplementAdresse'];
                    $nationalite = $_POST['nationalite'];

                    try {
                      $user = new user();
                      $user->setPrenom($prenom);
                      $user->setNom($nom);
                      $user->setDate_de_naissance($date_de_naissance);
                      $user->setEmail_personel($email_personel);
                      $user->setSexe($sexe);
                      $user->setPhone($phone);
                      $user->setAdresse($Adresse);
                      $user->setFormationId($formation_id);
                      $user->setNationalite($nationalite);

                      if (addStudent($user)) {
                        echo "<script type='text/javascript'>"
                          . " window.location.href='AddStudent.php';"
                          . "alert('student added!');"
                          . " </script> ";
                      } else {
                        echo "<script type='text/javascript'>"
                          . " window.location.href='AddStudent.php';"
                          .  "alert('Faild to add student!');"
                          . " </script> ";
                      }
                    } catch (Exception $exc) {
                      echo $exc->getTraceAsString();
                    }
                  }
                  ?>

                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="nom">Nom</label>
                      <input type="text" class="form-control" name="nom" placeholder="Nom">
                    </div>
                    <div class="form-group">
                      <label for="prenom">Prenom</label>
                      <input type="text" class="form-control" name="prenom" placeholder="Prenom">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Courriel Personnel</label>
                      <input type="email" class="form-control" name="email_personel" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="birthday">Date De Naissance</label>
                      <input type="date" class="form-control" name="date_de_naissance" name="birthday">
                    </div>
                    <div class="form-group">
                      <label for="phone">N° Téléphone portable </label>
                      <input type="text" class="form-control" name="phone" placeholder="Phone number">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">



                  <div class="form-group">
                    <select class="select" name="formation">
                      <?php
                      require_once("../../../BLL/formationManager.php");
                      $formation = getAllFormations();
                      echo "<option value=" . '"' . "0" . '"' . ">" . "Formation" . "</option>";
                      if ($formation != null) {
                        for ($i = 0; $i < count($formation); $i++) {
                          echo "<option value=" . '"' . $formation[$i]->getId() . '"' . ">" . $formation[$i]->getNom() . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="select" name="nationalite">
                      <option value="not set">Nationalite</option>
                      <option value="afghan">Afghan</option>
                      <option value="albanian">Albanian</option>
                      <option value="algerian">Algerian</option>
                      <option value="american">American</option>
                      <option value="andorran">Andorran</option>
                      <option value="angolan">Angolan</option>
                      <option value="antiguans">Antiguans</option>
                      <option value="argentinean">Argentinean</option>
                      <option value="armenian">Armenian</option>
                      <option value="australian">Australian</option>
                      <option value="austrian">Austrian</option>
                      <option value="azerbaijani">Azerbaijani</option>
                      <option value="bahamian">Bahamian</option>
                      <option value="bahraini">Bahraini</option>
                      <option value="bangladeshi">Bangladeshi</option>
                      <option value="barbadian">Barbadian</option>
                      <option value="barbudans">Barbudans</option>
                      <option value="batswana">Batswana</option>
                      <option value="belarusian">Belarusian</option>
                      <option value="belgian">Belgian</option>
                      <option value="belizean">Belizean</option>
                      <option value="beninese">Beninese</option>
                      <option value="bhutanese">Bhutanese</option>
                      <option value="bolivian">Bolivian</option>
                      <option value="bosnian">Bosnian</option>
                      <option value="brazilian">Brazilian</option>
                      <option value="british">British</option>
                      <option value="bruneian">Bruneian</option>
                      <option value="bulgarian">Bulgarian</option>
                      <option value="burkinabe">Burkinabe</option>
                      <option value="burmese">Burmese</option>
                      <option value="burundian">Burundian</option>
                      <option value="cambodian">Cambodian</option>
                      <option value="cameroonian">Cameroonian</option>
                      <option value="canadian">Canadian</option>
                      <option value="cape verdean">Cape Verdean</option>
                      <option value="central african">Central African</option>
                      <option value="chadian">Chadian</option>
                      <option value="chilean">Chilean</option>
                      <option value="chinese">Chinese</option>
                      <option value="colombian">Colombian</option>
                      <option value="comoran">Comoran</option>
                      <option value="congolese">Congolese</option>
                      <option value="costa rican">Costa Rican</option>
                      <option value="croatian">Croatian</option>
                      <option value="cuban">Cuban</option>
                      <option value="cypriot">Cypriot</option>
                      <option value="czech">Czech</option>
                      <option value="danish">Danish</option>
                      <option value="djibouti">Djibouti</option>
                      <option value="dominican">Dominican</option>
                      <option value="dutch">Dutch</option>
                      <option value="east timorese">East Timorese</option>
                      <option value="ecuadorean">Ecuadorean</option>
                      <option value="egyptian">Egyptian</option>
                      <option value="emirian">Emirian</option>
                      <option value="equatorial guinean">Equatorial Guinean</option>
                      <option value="eritrean">Eritrean</option>
                      <option value="estonian">Estonian</option>
                      <option value="ethiopian">Ethiopian</option>
                      <option value="fijian">Fijian</option>
                      <option value="filipino">Filipino</option>
                      <option value="finnish">Finnish</option>
                      <option value="french">French</option>
                      <option value="gabonese">Gabonese</option>
                      <option value="gambian">Gambian</option>
                      <option value="georgian">Georgian</option>
                      <option value="german">German</option>
                      <option value="ghanaian">Ghanaian</option>
                      <option value="greek">Greek</option>
                      <option value="grenadian">Grenadian</option>
                      <option value="guatemalan">Guatemalan</option>
                      <option value="guinea-bissauan">Guinea-Bissauan</option>
                      <option value="guinean">Guinean</option>
                      <option value="guyanese">Guyanese</option>
                      <option value="haitian">Haitian</option>
                      <option value="herzegovinian">Herzegovinian</option>
                      <option value="honduran">Honduran</option>
                      <option value="hungarian">Hungarian</option>
                      <option value="icelander">Icelander</option>
                      <option value="indian">Indian</option>
                      <option value="indonesian">Indonesian</option>
                      <option value="iranian">Iranian</option>
                      <option value="iraqi">Iraqi</option>
                      <option value="irish">Irish</option>
                      <option value="italian">Italian</option>
                      <option value="ivorian">Ivorian</option>
                      <option value="jamaican">Jamaican</option>
                      <option value="japanese">Japanese</option>
                      <option value="jordanian">Jordanian</option>
                      <option value="kazakhstani">Kazakhstani</option>
                      <option value="kenyan">Kenyan</option>
                      <option value="kittian and nevisian">Kittian and Nevisian</option>
                      <option value="kuwaiti">Kuwaiti</option>
                      <option value="kyrgyz">Kyrgyz</option>
                      <option value="laotian">Laotian</option>
                      <option value="latvian">Latvian</option>
                      <option value="lebanese">Lebanese</option>
                      <option value="liberian">Liberian</option>
                      <option value="libyan">Libyan</option>
                      <option value="liechtensteiner">Liechtensteiner</option>
                      <option value="lithuanian">Lithuanian</option>
                      <option value="luxembourger">Luxembourger</option>
                      <option value="macedonian">Macedonian</option>
                      <option value="malagasy">Malagasy</option>
                      <option value="malawian">Malawian</option>
                      <option value="malaysian">Malaysian</option>
                      <option value="maldivan">Maldivan</option>
                      <option value="malian">Malian</option>
                      <option value="maltese">Maltese</option>
                      <option value="marshallese">Marshallese</option>
                      <option value="mauritanian">Mauritanian</option>
                      <option value="mauritian">Mauritian</option>
                      <option value="mexican">Mexican</option>
                      <option value="micronesian">Micronesian</option>
                      <option value="moldovan">Moldovan</option>
                      <option value="monacan">Monacan</option>
                      <option value="mongolian">Mongolian</option>
                      <option value="moroccan">Moroccan</option>
                      <option value="mosotho">Mosotho</option>
                      <option value="motswana">Motswana</option>
                      <option value="mozambican">Mozambican</option>
                      <option value="namibian">Namibian</option>
                      <option value="nauruan">Nauruan</option>
                      <option value="nepalese">Nepalese</option>
                      <option value="new zealander">New Zealander</option>
                      <option value="ni-vanuatu">Ni-Vanuatu</option>
                      <option value="nicaraguan">Nicaraguan</option>
                      <option value="nigerien">Nigerien</option>
                      <option value="north korean">North Korean</option>
                      <option value="northern irish">Northern Irish</option>
                      <option value="norwegian">Norwegian</option>
                      <option value="omani">Omani</option>
                      <option value="pakistani">Pakistani</option>
                      <option value="palauan">Palauan</option>
                      <option value="panamanian">Panamanian</option>
                      <option value="papua new guinean">Papua New Guinean</option>
                      <option value="palestinian">Palestinian</option>
                      <option value="paraguayan">Paraguayan</option>
                      <option value="peruvian">Peruvian</option>
                      <option value="polish">Polish</option>
                      <option value="portuguese">Portuguese</option>
                      <option value="qatari">Qatari</option>
                      <option value="romanian">Romanian</option>
                      <option value="russian">Russian</option>
                      <option value="rwandan">Rwandan</option>
                      <option value="saint lucian">Saint Lucian</option>
                      <option value="salvadoran">Salvadoran</option>
                      <option value="samoan">Samoan</option>
                      <option value="san marinese">San Marinese</option>
                      <option value="sao tomean">Sao Tomean</option>
                      <option value="saudi">Saudi</option>
                      <option value="scottish">Scottish</option>
                      <option value="senegalese">Senegalese</option>
                      <option value="serbian">Serbian</option>
                      <option value="seychellois">Seychellois</option>
                      <option value="sierra leonean">Sierra Leonean</option>
                      <option value="singaporean">Singaporean</option>
                      <option value="slovakian">Slovakian</option>
                      <option value="slovenian">Slovenian</option>
                      <option value="solomon islander">Solomon Islander</option>
                      <option value="somali">Somali</option>
                      <option value="south african">South African</option>
                      <option value="south korean">South Korean</option>
                      <option value="spanish">Spanish</option>
                      <option value="sri lankan">Sri Lankan</option>
                      <option value="sudanese">Sudanese</option>
                      <option value="surinamer">Surinamer</option>
                      <option value="swazi">Swazi</option>
                      <option value="swedish">Swedish</option>
                      <option value="swiss">Swiss</option>
                      <option value="syrian">Syrian</option>
                      <option value="taiwanese">Taiwanese</option>
                      <option value="tajik">Tajik</option>
                      <option value="tanzanian">Tanzanian</option>
                      <option value="thai">Thai</option>
                      <option value="togolese">Togolese</option>
                      <option value="tongan">Tongan</option>
                      <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                      <option value="tunisian">Tunisian</option>
                      <option value="turkish">Turkish</option>
                      <option value="tuvaluan">Tuvaluan</option>
                      <option value="ugandan">Ugandan</option>
                      <option value="ukrainian">Ukrainian</option>
                      <option value="uruguayan">Uruguayan</option>
                      <option value="uzbekistani">Uzbekistani</option>
                      <option value="venezuelan">Venezuelan</option>
                      <option value="vietnamese">Vietnamese</option>
                      <option value="welsh">Welsh</option>
                      <option value="yemenite">Yemenite</option>
                      <option value="zambian">Zambian</option>
                      <option value="zimbabwean">Zimbabwean</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="select" name="sexe">
                      <option value="not set">Sexe</option>
                      <option value="Homme">Homme</option>
                      <option value="Femme">Femme</option>
                    </select>
                  </div>


                  <div class="form-group ">
                    <label for="pass">Adresse</label>

                    <input type="text" class="form-control" name="Adresse" placeholder="Addresse">

                  </div>
                  <div class="form-group ">
                    <label for="exampleInputConfirmPassword2">Complement d'Adresse</label>

                    <input type="text" class="form-control" name="ComplementAdresse" placeholder="(Facultatif)">

                  </div>
                  <button class="btn btn-primary mr-2" name="submitBtn">
                    Submit
                  </button>

                  </form>


                </div>
              </div>
            </div>


          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../assets/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../scripts/admin/js/off-canvas.js"></script>
  <script src="../../scripts/admin/js/hoverable-collapse.js"></script>
  <script src="../../scripts/admin/js/template.js"></script>
  <script src="../../scripts/admin/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../scripts/admin/js/file-upload.js"></script>
  <!-- End custom js for this page-->
</body>

</html>