<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM games WHERE id=$id");

header("Location: index.php");
?>