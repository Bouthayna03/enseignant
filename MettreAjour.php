<?php

$connexion = mysqli_connect("127.0.0.1","root","", "entgi");

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

$id=$_GET['id'];
//echo $id;

$heure=$_POST['heure'];
$date=$_POST['datee'];

mysqli_query($connexion,"UPDATE absence SET nbr_heure = '$heure' WHERE id_massar = '$id';");
mysqli_query($connexion,"UPDATE absence SET date_absence = '$date' WHERE id_massar = '$id';");
header('location: Absences.php');

?>