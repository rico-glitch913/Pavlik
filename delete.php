<<<<<<< HEAD
<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM games WHERE id=$id");

header("Location: index.php");
=======
<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM games WHERE id=$id");

header("Location: index.php");
>>>>>>> 68a8f4aaf55cdca1184d8ca9d37747c1f116971b
?>