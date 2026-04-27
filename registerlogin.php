<?php
include 'db.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: auth.php");
}

if (isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Auth</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card p-4 shadow" style="width:350px;">

    <h3 class="text-center mb-3">Game App</h3>

    <div class="text-center mb-3">
        <a href="?mode=login" class="btn btn-primary btn-sm">Login</a>
        <a href="?mode=register" class="btn btn-success btn-sm">Register</a>
    </div>

<?php
$mode = $_GET['mode'] ?? 'login';

if ($mode == "register") {
?>

    <form method="POST">
        <input class="form-control mb-2" name="username" placeholder="Username">
        <input class="form-control mb-2" type="password" name="password" placeholder="Password">
        <button class="btn btn-success w-100">Register</button>
    </form>

<?php
    if ($_POST) {
        $u = $_POST['username'];
        $p = $_POST['password'];

        if ($u && $p) {
            $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");

            if (mysqli_num_rows($check) > 0) {
                echo "<p class='text-danger mt-2'>User existuje</p>";
            } else {
                mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$u','$p')");
                echo "<p class='text-success mt-2'>Registrovaný ✔</p>";
            }
        } else {
            echo "<p class='text-danger mt-2'>Vyplň všetko</p>";
        }
    }

} else {
?>

    <form method="POST">
        <input class="form-control mb-2" name="username" placeholder="Username">
        <input class="form-control mb-2" type="password" name="password" placeholder="Password">
        <button class="btn btn-primary w-100">Login</button>
    </form>

<?php
    if ($_POST) {
        $u = $_POST['username'];
        $p = $_POST['password'];

        $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");

        if (mysqli_num_rows($res) == 1) {
            $_SESSION['user'] = $u;
            header("Location: index.php");
        } else {
            echo "<p class='text-danger mt-2'>Zlé údaje</p>";
        }
    }
}
?>

</div>

</body>
</html>