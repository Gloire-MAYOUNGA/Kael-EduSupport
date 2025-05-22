<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "kael_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $enteredPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, name FROM signups WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword, $name);
        $stmt->fetch();

        if (password_verify($enteredPassword, $hashedPassword)) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>