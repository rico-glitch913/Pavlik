<?php
$conn = mysqli_connect("localhost", "root", "", "game_app");

if (!$conn) {
    die("Chyba pripojenia k databáze");
}
?>