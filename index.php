<?php 
include 'db.php'; 

if (!isset($_SESSION['user'])) {
    header("Location: registerlogin.php");
    exit();
}
?>

<h2>Zoznam hier</h2>
<a href="add.php">+ Pridať hru</a>

<table border="1">
<tr>
    <th>Názov</th>
    <th>Rok</th>
    <th>Kategória</th>
    <th>Akcie</th>
</tr>

<?php
$sql = "SELECT games.*, categories.name AS category 
        FROM games 
        LEFT JOIN categories ON games.category_id = categories.id";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $title    = htmlspecialchars($row['title']);
    $year     = htmlspecialchars($row['year']);
    $category = htmlspecialchars($row['category'] ?? '');
    $id       = (int)$row['id'];

    echo "<tr>
        <td>{$title}</td>
        <td>{$year}</td>
        <td>{$category}</td>
        <td>
            <a href='edit.php?id={$id}'>Edit</a>
            <a href='delete.php?id={$id}' onclick=\"return confirm('Naozaj vymazať?')\">Delete</a>
        </td>
    </tr>";
}
?>
</table>