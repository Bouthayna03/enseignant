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
$sql = "SELECT * FROM note where id_massar='$id'";
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
</head>
<body>
<!-- <h2>Edit</h2> -->
<form method="POST" action="update.php?id=<?php echo $id; ?>">
    <label>Note:</label><input type="number" step="any" min="0" max="20" value="<?php echo $row['valeur']; ?>" name="note">
    <label>Description:</label><input type="text" value="<?php echo $row['description']; ?>" name="massar">
    <input type="submit" name="submit" value="changer">
    <!-- <a href="Notes.php">Back</a> -->
</form>
</body>
</html>