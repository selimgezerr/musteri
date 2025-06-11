<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/Task.php';
require_once __DIR__ . '/../src/Project.php';

if (isset($_GET['delete'])) {
    Task::delete($_GET['delete']);
    header('Location: tasks.php');
    exit;
}

if (isset($_GET['edit'])) {
    $edit = Task::find($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        Task::update($_POST['id'], $_POST);
    } else {
        Task::create($_POST);
    }
    header('Location: tasks.php');
    exit;
}

$tasks = Task::all();
$projects = Project::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Görevler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Görevler</h1>
    <?php include __DIR__ . '/../src/nav.php'; ?>
    <form method="post" class="mb-4">
        <?php if (!empty($edit)): ?>
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php endif; ?>
        <div class="row g-2">
            <div class="col">
                <select name="project_id" class="form-select">
                    <?php foreach ($projects as $project): ?>
                        <option value="<?= $project['id'] ?>" <?= (isset($edit['project_id']) && $edit['project_id'] == $project['id']) ? 'selected' : '' ?>><?= htmlspecialchars($project['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Görev Başlığı" value="<?= htmlspecialchars($edit['title'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="date" name="due_date" class="form-control" value="<?= htmlspecialchars($edit['due_date'] ?? '') ?>">
            </div>
            <div class="col">
                <select name="status" class="form-select">
                    <option value="to-do" <?= (isset($edit['status']) && $edit['status'] === 'to-do') ? 'selected' : '' ?>>to-do</option>
                    <option value="in progress" <?= (isset($edit['status']) && $edit['status'] === 'in progress') ? 'selected' : '' ?>>in progress</option>
                    <option value="done" <?= (isset($edit['status']) && $edit['status'] === 'done') ? 'selected' : '' ?>>done</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">
                    <?= empty($edit) ? 'Ekle' : 'Kaydet' ?>
                </button>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <textarea name="description" class="form-control" placeholder="Açıklama"><?= htmlspecialchars($edit['description'] ?? '') ?></textarea>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proje</th>
                <th>Başlık</th>
                <th>Durum</th>
                <th>Teslim Tarihi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= htmlspecialchars($task['id']) ?></td>
                <td><?= htmlspecialchars($task['project_name']) ?></td>
                <td><?= htmlspecialchars($task['title']) ?></td>
                <td><?= htmlspecialchars($task['status']) ?></td>
                <td><?= htmlspecialchars($task['due_date']) ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="tasks.php?edit=<?= $task['id'] ?>">Düzenle</a>
                    <a class="btn btn-sm btn-outline-danger" href="tasks.php?delete=<?= $task['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
