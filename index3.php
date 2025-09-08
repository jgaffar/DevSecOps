<?php
// config.php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'test_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// index.php
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // 🚨 Vulnerable to SQL Injection!
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Welcome, " . $row['username'];
        }
    } else {
        echo "User not found.";
    }
}
?>
