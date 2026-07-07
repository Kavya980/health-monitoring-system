<?php

include "connect.php";

$id = $_GET['id'];

$sql = "DELETE FROM health_tips WHERE id=$id";

if($conn->query($sql)){
    header("Location: ../dashboard.php");
}
else{
    echo "Error deleting tip";
}

?>