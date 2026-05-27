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
<?php
include 'db.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: registerlogin.php");
    exit();
}

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$mode = $_GET['mode'] ?? 'login';

if ($mode == "register") {
?>
    <h2>Registrácia</h2>
    <a href="?mode=login">Prepnúť na prihlásenie</a><br><br>

    <form method="POST">
        Meno: <input type="text" name="username" required><br>
        Heslo: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';

        if ($u && $p) {
            $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
            mysqli_stmt_bind_param($stmt, "s", $u);
            mysqli_stmt_execute($stmt);
            $check = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($check) > 0) {
                echo "<p>User existuje</p>";
            } else {
                $hashed_password = password_hash($p, PASSWORD_BCRYPT);
                $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
                mysqli_stmt_bind_param($stmt, "ss", $u, $hashed_password);
                
                if (mysqli_stmt_execute($stmt)) {
                    echo "<p>Registrovaný ✔ (Môžete sa prihlásiť)</p>";
                }
            }
        } else {
            echo "<p>Vyplň všetko</p>";
        }
    }

} else {
?>
    <h2>Prihlásenie</h2>
    <a href="?mode=register">Prepnúť na registráciu</a><br><br>

    <form method="POST">
        Meno: <input type="text" name="username" required><br>
        Heslo: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $u);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) == 1) {
            $user = mysqli_fetch_assoc($res);
            if (password_verify($p, $user['password'])) {
                $_SESSION['user'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Nesprávne meno alebo heslo</p>";
            }
        } else {
            echo "<p>Nesprávne meno alebo heslo</p>";
        }
    }
}
?>