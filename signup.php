<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "kael_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $product = $_POST['product'];
    $occupation = $_POST['occupation'];
    $consent = isset($_POST['consent']) ? "Yes" : "No";
    $passwordPlain = $_POST['password'];
    $password = password_hash($passwordPlain, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO signups (name, email, country, product, occupation, password, consent) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssss", $name, $email, $country, $product, $occupation, $password, $consent);

        if ($stmt->execute()) {
            header("Location: thankyou.html");
            exit();
        } else {
            echo "Signup failed. Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}

$conn->close();
?>