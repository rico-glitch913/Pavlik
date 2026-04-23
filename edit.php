<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM games WHERE id=$id");
$data = mysqli_fetch_assoc($result);
?>

<h2>Upraviť hru</h2>

<form method="POST">
    Názov: <input type="text" name="title" value="<?php echo $data['title']; ?>"><br>
    Rok: <input type="number" name="year" value="<?php echo $data['year']; ?>"><br>

    <button type="submit">Uložiť</button>
</form>

<?php
if ($_POST) {
    $title = $_POST['title'];
    $year = $_POST['year'];

    $sql = "UPDATE games SET title='$title', year='$year' WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>