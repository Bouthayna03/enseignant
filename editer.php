<?php
$connexion = mysqli_connect("127.0.0.1","root","", "entgi");
// Get id from href
$id=$_GET['id'];

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// get all data absence by id
$sql = "SELECT * FROM absence where id_massar='$id'";
$query = mysqli_query($connexion, $sql) or die('Error getting query');

// Fetch all rows by id
$row=mysqli_fetch_array($query)or die('Error returning array');
//Count numbers of rows
//echo $query->num_rows;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Basic MySQLi Commands</title>
    <link rel="script" href="image_note.js">
</head>
<body>
<!-- <h2>Edit</h2> -->
<form method="POST" action="MettreAjour.php?id=<?php echo $id; ?>">
    <label>Nombre d'heures d'absences:</label><input type="number" step="any" min="0" value="<?php echo $row['nbr_heure']; ?>" name="heure" id="heure">
    <label>Date d'absence:</label><input type="date" value="<?php echo $row['date_absence']; ?>" name="datee" id="datee" onsubmit="verifier();">
    <input type="submit" name="submit" value="changer">
    <!-- <a href="Notes.php">Back</a> -->
</form>
</body>
</html>