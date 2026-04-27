<?php include 'db.php'; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS game_app");
$conn->select_db("game_app");

$conn->query("CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
)");

$conn->query("CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    year INT,
    category_id INT
)");

$conn->query("INSERT INTO categories (name) VALUES ('RPG'), ('FPS'), ('Strategy')");

$conn->query("INSERT INTO games (title, year, category_id) VALUES
('GTA V', 2013, 2),
('Witcher 3', 2015, 1)");

$conn->close();
?>