<?php
$connection = new mysqli("localhost", "root", "", "kael_db"); 

$name = "Glory";
$email = "glory@gmail.com";
$password = password_hash("1234", PASSWORD_DEFAULT);

$sql = "INSERT INTO signups (name, email, password) VALUES ('$name', '$email', '$password')";

if ($connection->query($sql) === TRUE) {
    echo "User created successfully!";
} else {
    echo "Error: " . $connection->error;
}
?>