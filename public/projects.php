<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/Project.php';

if (isset($_GET['delete'])) {
    Project::delete($_GET['delete']);
    header('Location: projects.php');
    exit;
}

if (isset($_GET['edit'])) {
    $edit = Project::find($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        Project::update($_POST['id'], $_POST);
    } else {
        Project::create($_POST);
    }
    header('Location: projects.php');
    exit;
}

$projects = Project::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Projeler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Projeler</h1>
    <?php include __DIR__ . '/../src/nav.php'; ?>
    <form method="post" class="mb-4">
        <?php if (!empty($edit)): ?>
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php endif; ?>
        <div class="row g-2">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Proje Adı" value="<?= htmlspecialchars($edit['name'] ?? '') ?>" required>
            </div>
            <div class="col">
                <select name="status" class="form-select">
                    <option value="devam ediyor" <?= (isset($edit['status']) && $edit['status'] === 'devam ediyor') ? 'selected' : '' ?>>Devam Ediyor</option>
                    <option value="tamamlandı" <?= (isset($edit['status']) && $edit['status'] === 'tamamlandı') ? 'selected' : '' ?>>Tamamlandı</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    <?= empty($edit) ? 'Ekle' : 'Kaydet' ?>
                </button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Durum</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project['id']) ?></td>
                <td><?= htmlspecialchars($project['name']) ?></td>
                <td><?= htmlspecialchars($project['status']) ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="projects.php?edit=<?= $project['id'] ?>">Düzenle</a>
                    <a class="btn btn-sm btn-outline-danger" href="projects.php?delete=<?= $project['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
