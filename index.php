<?php include 'db.php'; ?>

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
    echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['year']}</td>
        <td>{$row['category']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a>
            <a href='delete.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>";
}
?>
</table>