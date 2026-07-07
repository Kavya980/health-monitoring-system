<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location: login.html");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Add Health Tip</title>
header("Location: ../dashboard.php?success=1");
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<div class="form-card">

<h2>Add New Health Tip</h2>

<form action="php/add_tip.php" method="POST">

<label>Tip Title</label>
<input type="text" name="title" required>

<br>

<label>Category</label>
<select name="category" required>
<option value="">Select Category</option>
<option value="Diet">Diet</option>
<option value="Exercise">Exercise</option>
<option value="Mental Health">Mental Health</option>
<option value="Sleep">Sleep</option>
</select>

<br>

<label>Description</label>
<textarea name="description" required></textarea>

<button type="submit">Add Tip</button>

</form>

</div>

</body>
</html>

