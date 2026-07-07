<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.html");
exit();
}

include "php/connect.php";

$diet = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Diet'")->fetch_assoc()['total'];
$exercise = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Exercise'")->fetch_assoc()['total'];
$mental = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Mental Health'")->fetch_assoc()['total'];
$sleep = $conn->query("SELECT COUNT(*) as total FROM health_tips WHERE category='Sleep'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Statistics</title>

<link rel="stylesheet" href="css/style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="charts">

<div class="chart-container">

<h2 class="chart-title">Tips by Category</h2>

<canvas id="barChart"></canvas>

</div>

<div class="chart-container">

<h2 class="chart-title">Tips Distribution</h2>

<canvas id="pieChart"></canvas>

</div>

</div>

<script>

/* Passing PHP values to JavaScript */

const diet = <?php echo $diet; ?>;
const exercise = <?php echo $exercise; ?>;
const mental = <?php echo $mental; ?>;
const sleep = <?php echo $sleep; ?>;

</script>

<script src="js/script.js"></script>

</body>

</html>

