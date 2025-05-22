<?php
$connection = new mysqli("localhost", "root", "", "kael_db");

$subject_id = $_GET['subject_id'];
$result = $connection->query("SELECT * FROM lessons WHERE subject_id = $subject_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lessons</title>
</head>
<body>
    <h2>Lessons</h2>
    <ul>
        <?php while($row = $result->fetch_assoc()) { ?>
            <li><?php echo $row['title']; ?></li>
        <?php } ?>
    </ul>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>