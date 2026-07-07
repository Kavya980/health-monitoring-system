<?php

include 'connect.php';

$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$sql = "INSERT INTO health_tips (title, description, category) VALUES ('$title','$description','$category')";

if($conn->query($sql)){
    echo "Health tip added successfully";
}
else{
    echo "Error: " . $conn->error;
}

?>