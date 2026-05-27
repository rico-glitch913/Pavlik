<?php
session_start();

$conn = mysqli_connect("localhost", "root", "root", "game_app");

if (!$conn) {
    die("Chyba pripojenia k databáze: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>