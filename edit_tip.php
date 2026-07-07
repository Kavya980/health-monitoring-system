<?php

include "php/connect.php";

if(!isset($_GET['id'])){
echo "No tip selected";
exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM health_tips WHERE id=$id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
<title>Edit Tip</title>
</head>

<body>

<h2>Edit Health Tip</h2>

<form action="php/update_tip.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="title" value="<?php echo $row['title']; ?>" required>

<br><br>

<textarea name="description" required><?php echo $row['description']; ?></textarea>

<br><br>

<button type="submit">Update Tip</button>

</form>

</body>

</html>