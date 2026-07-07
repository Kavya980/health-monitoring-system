<?php

include "connect.php";

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];

$sql = "UPDATE health_tips 
SET title='$title', description='$description' 
WHERE id=$id";

if($conn->query($sql) === TRUE){

header("Location: ../dashboard.php");

}
else{

echo "Error updating tip";

}

?>