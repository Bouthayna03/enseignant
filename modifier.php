<?php
if (isset($_POST['submit'])) {
    $id = $_SESSION['prpen'];
    if (!empty($_POST['adresse'])) {
      $adresse = $_POST['adresse'];
      mysqli_query($conn, "UPDATE enseignant SET adresse = '$adresse' WHERE prp = '$id';");
    }
    if (!empty($_POST['telephone'])) {
      $gsm = $_POST['telephone'];
      mysqli_query($conn, "UPDATE enseignant SET gsm = '$gsm' WHERE prp = '$id';");
    }
    if (!empty($_POST['password'])) {
      $password = $_POST['password'];
      $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
      mysqli_query($conn, "UPDATE enseignant SET password = '$encrypted_password' WHERE prp = '$id';");
    }
    if (!empty($_FILES['file']['name'])) {
      $fichier = $_FILES['file'];
      $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);// recover the file extension
      if($fichier['error'] == 0) {
        if ($path!="../images/default_users_profile_image.jpg") {
          unlink($path); // suprime l'anciene image
      }
      $src = $fichier['tmp_name'];
      $dest = "./profile_pic/{$nom}_{$prenom}.{$extension}";
      move_uploaded_file($src, $dest);
      mysqli_query($conn, "UPDATE enseignant SET photo_profil = '$dest' WHERE prp = '$id';");
      }
    }
    $path = mysqli_fetch_assoc(mysqli_query($conn, "select photo_profil from enseignant where prp = '$id';"))['photo_profil'];
    
    mysqli_close($conn);
  }
?>