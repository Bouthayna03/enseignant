<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profile</title>
  <link rel="stylesheet" href="../CSS/enseignant.css">
  <link rel="stylesheet" href="../CSS/profile_ens.css">
  <script src="../JS/profile.js"></script>
</head>

<body>
  <?php
  require("../server/verifie_session.php");
  require("../server/connection_DB.php");
  $id = $_SESSION['prpen'];
  $requete = mysqli_query($conn, "SELECT * FROM enseignant WHERE prp = '$id';");
  $row = mysqli_fetch_assoc($requete); // fetch the result
  $adresse = $row['adresse'];
  $email = $row['email'];
  $gsm = $row['gsm'];
  $nom = $row['nom'];
  $prenom = $row['prenom'];
  $path = mysqli_fetch_assoc(mysqli_query($conn, "select photo_profil from enseignant where prp = '$id';"))['photo_profil'];
  ?>

  <body>
    <div class="left-bar">
      <a href="index.php"> <img src="../images/1.png" class="logo"></a>
      <ul>
        <li>
          <a href="index.php"><img src="../images/home.png" class="icon"> Accueil</a>
        </li>
        <li>
          <a href="profile.php"><img src="../images/teacher.png" class="icon"> Profil</a>
        </li>
        <li>
          <a href=""><img src="../images/pen.png" class="icon"> Cours</a>
        </li>
        <li>
          <a href="Notes.php"><img src="../images/note.png" class="icon"> Notes</a>
        </li>
        <li>
          <a href="Absences.php"><img src="../images/absence.png" class="icon"> Absences</a>
        </li>
        <li>
          <a href="../server/deconnexion.php"><img src="../images/logout.png" class="icon"> Déconnexion</a>
        </li>
      </ul>
    </div>
    <main>
      <div class="info-prfl">
        <form action="" class="profile-form" method="post" enctype="multipart/form-data" name="myForm" onsubmit="return verifie() ">
          <?php
          require('modifier.php');
          ?>

          <div class="profile-pic-div" id="prfl">
            <img src="<?php echo $path; ?>" id="photo">
            <input type="file" id="file" name="file" accept="image/*">
            <label for="file" id="uploadBtn">Changer</label>
          </div>
          <h2>Modifier mes informations de profil</h2>
          <?php
          if (isset($_POST['submit'])) {
            print("<div class='form-group'>
        <p>les changement sont sauvgardes</p>
        </div>");
          }
          ?>
          <div class="form-group">
            <label for="prenom">Prenom :</label>
            <input type="text" id="prenom" value="<?php echo $prenom; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" value="<?php echo $nom; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" value="<?php echo $email; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Entrez votre nouvelle adresse" value="<?php echo $adresse; ?>">
            <img src="../images/modify3.png" style="height: 20px;width: 20px;" class="edit-icon">
          </div>
          <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" placeholder="Entrez votre nouveau numéro de téléphone" value="<?php echo $gsm; ?>">
            <img src="../images/modify3.png" style="height: 20px;width: 20px;" class="edit-icon">
          </div>

          <!-- pass -->
          <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre nouveau mot de passe  ~plus de 6 caractères~" oninput="mdp();">
            <img src="../images/modify3.png" style="height: 20px;width: 20px;" class="edit-icon">
          </div>


          <!-- confirm -->
          <div class="form-group" id="pass" style="display: none;">
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre nouveau mot de passe" oninput="confirmmdp()">
          </div>
          <button type="submit" name="submit">Enregistrer les modifications</button>
        </form>
      </div>

    </main>
  </body>

</html>