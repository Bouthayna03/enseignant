<?php

$connexion = mysqli_connect("127.0.0.1","root","", "entgi");
// Get id from href
$id=$_GET['id'];

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// get all data note by id
$sql = "DELETE FROM note where id_massar='$id'";
$query = mysqli_query($connexion, $sql) or die('Error getting query');

 header('location: Notes.php');
?>