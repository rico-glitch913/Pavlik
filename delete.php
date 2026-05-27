<?php 
include 'db.php'; 

if (!isset($_SESSION['user'])) {
    header("Location: registerlogin.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM games WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: index.php");
exit();
?>
