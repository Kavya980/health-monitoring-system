<?php

include 'connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$password = password_hash($password, PASSWORD_DEFAULT);

$check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check);

if($result->num_rows > 0){

echo "Email already registered";

}
else{

$sql = "INSERT INTO users (name, email, password)
VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
echo "Signup successful!";
} 
else {
echo "Error: " . $conn->error;
}

}

?>