<?php include 'db.php'; ?>

<h2>Pridať hru</h2>

<form method="POST">
    Názov: <input type="text" name="title"><br>
    Rok: <input type="number" name="year"><br>

    Kategória:
    <select name="category">
        <?php
        $res = mysqli_query($conn, "SELECT * FROM categories");
        while($cat = mysqli_fetch_assoc($res)) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select><br>

    <button type="submit">Uložiť</button>
</form>

<?php
if ($_POST) {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $category = $_POST['category'];

    if ($title != "") {
        $sql = "INSERT INTO games (title, year, category_id)
                VALUES ('$title', '$year', '$category')";
        mysqli_query($conn, $sql);

        header("Location: index.php");
    } else {
        echo "Vyplň názov!";
    }
}
?>