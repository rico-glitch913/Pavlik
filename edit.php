<?php 
include 'db.php'; 

if (!isset($_SESSION['user'])) {
    header("Location: registerlogin.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);
if ($id < 1) {
    header("Location: index.php");
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT * FROM games WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($res);

if (!$data) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title'];
    $year        = $_POST['year'];
    $category_id = $_POST['category'];
    $description = $_POST['description'];

    $stmt = mysqli_prepare($conn, "UPDATE games SET title = ?, year = ?, category_id = ?, description = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "siisi", $title, $year, $category_id, $description, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit();
}

$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<h2>Upraviť hru</h2>

<form method="POST">
    Názov: <input type="text" name="title" value="<?php echo htmlspecialchars($data['title']); ?>"><br>
    Rok: <input type="number" name="year" value="<?php echo htmlspecialchars($data['year']); ?>"><br>

    Kategória:
    <select name="category">
        <?php while($cat = mysqli_fetch_assoc($categories)): ?>
            <option value="<?= $cat['id'] ?>" <?= intval($data['category_id']) === intval($cat['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    Popis: <br>
    <textarea name="description" rows="3"><?php echo htmlspecialchars($data['description'] ?? ''); ?></textarea><br>

    <button type="submit">Uložiť</button>
</form>