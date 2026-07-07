<?php

if(isset($_GET['success'])){
echo "<div class='success-msg'>Tip added successfully!</div>";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['user'])){
header("Location: login.html");
exit();
}

include "php/connect.php";

$count_sql = "SELECT COUNT(*) as total FROM health_tips";
$count_result = $conn->query($count_sql);
$count_row = $count_result->fetch_assoc();
$total_tips = $count_row['total'];

$diet = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Diet'")->fetch_assoc()['total'];
$exercise = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Exercise'")->fetch_assoc()['total'];
$mental = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Mental Health'")->fetch_assoc()['total'];
$sleep = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Sleep'")->fetch_assoc()['total'];

if(isset($_GET['search'])){
$search = $_GET['search'];
$sql = "SELECT * FROM health_tips WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
}
elseif(isset($_GET['category'])){
$category = $_GET['category'];
$sql = "SELECT * FROM health_tips WHERE category='$category'";
}
else{
$sql = "SELECT * FROM health_tips";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
<title>Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

<!-- SIDEBAR -->
<div class="sidebar">

<h2><i class="fa-solid fa-heart-pulse"></i> Health Admin</h2>

<a class="active" href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>

<a href="add_tip_page.php"><i class="fa-solid fa-plus"></i> Add Tips</a>

<a href="statistics.php"><i class="fa-solid fa-chart-pie"></i> Statistics</a>

<a href="php/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>

</div>
<!-- MAIN AREA -->
<div class="main">

<!-- TOPBAR -->
<div class="topbar">
Welcome <?php echo $_SESSION['user']; ?>
</div>

<div class="container">

<h1>Health Monitoring System</h1>

<!-- STATS -->
<div class="stats">

<div class="stat-card blue">
<i class="fa-solid fa-list"></i>
<h3>Total Tips</h3>
<p class="counter"><?php echo $total_tips; ?></p>
</div>

<div class="stat-card green">
<i class="fa-solid fa-apple-whole"></i>
<h3>Diet</h3>
<p class="counter"><?php echo $diet; ?></p>
</div>

<div class="stat-card purple">
<i class="fa-solid fa-dumbbell"></i>
<h3>Exercise</h3>
<p class="counter"><?php echo $exercise; ?></p>
</div>

<div class="stat-card orange">
<i class="fa-solid fa-brain"></i>
<h3>Mental Health</h3>
<p class="counter"><?php echo $mental; ?></p>
</div>

<div class="stat-card red">
<i class="fa-solid fa-bed"></i>
<h3>Sleep</h3>
<p class="counter"><?php echo $sleep; ?></p>
</div>

</div>


<h2>Recent Activity</h2>

<?php

$recent = $conn->query("SELECT * FROM health_tips ORDER BY created_at DESC LIMIT 5");

while($r = $recent->fetch_assoc()){

echo "<div class='activity-card'>";
echo "<strong>".$r['title']."</strong>";
echo "<span class='badge ".str_replace(' ','',$r['category'])."'>".$r['category']."</span>";
echo "<p class='date'>".$r['created_at']."</p>";
echo "</div>";

}
?>


<h2>Health Tips</h2>

<br>

<a class="filter-btn" href="dashboard.php">All</a>
<a class="filter-btn" href="dashboard.php?category=Diet">Diet</a>
<a class="filter-btn" href="dashboard.php?category=Exercise">Exercise</a>
<a class="filter-btn" href="dashboard.php?category=Mental Health">Mental Health</a>
<a class="filter-btn" href="dashboard.php?category=Sleep">Sleep</a>

<br><br>

<form method="GET">
<input type="text" name="search" placeholder="Search health tips...">
<button type="submit">Search</button>
</form>

<br>

<!-- <h3>Add New Tip</h3>

<form action="php/add_tip.php" method="POST">

<input type="text" name="title" placeholder="Tip Title" required>

<br><br>

<select name="category" required>
<option value="">Select Category</option>
<option value="Diet">Diet</option>
<option value="Exercise">Exercise</option>
<option value="Mental Health">Mental Health</option>
<option value="Sleep">Sleep</option>
</select>

<br><br>

<textarea name="description" placeholder="Tip Description" required></textarea>

<br><br>

<button type="submit">Add Tip</button>

</form> -->

<hr>

<?php
while($row = $result->fetch_assoc()){

echo "<div class='tip-card'>";

echo "<h3>".$row['title']."</h3>";
echo "<span class='badge ".str_replace(' ','',$row['category'])."'>".$row['category']."</span>";
echo "<p>".$row['description']."</p>";
echo "<p class='date'>Posted on: ".$row['created_at']."</p>";

echo "<a class='edit-btn' href='edit_tip.php?id=".$row['id']."'>Edit</a>";
echo "<a class='delete-btn' onclick='return confirm(\"Are you sure?\")' href='php/delete_tip.php?id=".$row['id']."'>Delete</a>";

echo "</div>";

}
?>

</div>

</div>

</div>

</body>
<script src="js/script.js"></script>
</html>
