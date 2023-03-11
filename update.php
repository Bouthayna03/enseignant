<?php

$connexion = mysqli_connect("127.0.0.1","root","", "entgi");

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

$id=$_GET['id'];
//echo $id;

$note=$_POST['note'];
$description=$_POST['massar'];

mysqli_query($connexion,"UPDATE note SET valeur = '$note' WHERE id_massar = '$id';");
mysqli_query($connexion,"UPDATE note SET description = '$description' WHERE id_massar = '$id';");

header('location: Notes.php');

?>