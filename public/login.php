<?php
require_once __DIR__ . '/../src/User.php';
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = User::authenticate($_POST['email'], $_POST['password']);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Hatalı giriş';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width:400px;">
    <h1 class="mb-3">Giriş</h1>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-posta" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Şifre" required>
        </div>
        <button class="btn btn-primary" type="submit">Giriş Yap</button>
    </form>
</div>
</body>
</html>
