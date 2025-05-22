<?php
$conn = new mysqli('localhost','root','','kael_db');
if ($conn->connect_error) die("Connection failed: ".$conn->connect_error);

$res = $conn->query("SELECT id,name,email FROM signups");
echo "<h2>Registered Users</h2><ul>";
while($row = $res->fetch_assoc()){
    echo "<li>[{$row['id']}] {$row['name']} &lt;{$row['email']}&gt;</li>";
}
echo "</ul>";
$conn->close();
?>