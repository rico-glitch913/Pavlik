<?php 
include 'db.php'; 

if (!isset($_SESSION['user'])) {
    header("Location: registerlogin.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $year        = intval($_POST['year'] ?? 0);
    $category_id = intval($_POST['category'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    if ($title != "") {
        $stmt = mysqli_prepare($conn, "INSERT INTO games (title, year, category_id, description) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siis", $title, $year, $category_id, $description);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        }
    } else {
        $errors[] = "Vyplň názov!";
    }
}

$res = mysqli_query($conn, "SELECT * FROM categories");
?>

<h2>Pridať hru</h2>

<?php if (!empty($errors)): ?>
    <p style="color: red;"><?= htmlspecialchars($errors[0]) ?></p>
<?php endif; ?>

<form method="POST">
    Názov: <input type="text" name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"><br>
    Rok: <input type="number" name="year" value="<?= htmlspecialchars($_POST['year'] ?? '') ?>"><br>

    Kategória:
    <select name="category">
        <?php while($cat = mysqli_fetch_assoc($res)): ?>
            <option value="<?= $cat['id'] ?>" <?= (isset($_POST['category']) && intval($_POST['category']) === intval($cat['id'])) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    Popis: <br>
    <textarea name="description" rows="3"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea><br>

    <button type="submit">Uložiť</button>
</form>