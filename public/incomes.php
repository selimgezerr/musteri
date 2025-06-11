<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/Income.php';

if (isset($_GET['delete'])) {
    Income::delete($_GET['delete']);
    header('Location: incomes.php');
    exit;
}

if (isset($_GET['edit'])) {
    $edit = Income::find($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        Income::update($_POST['id'], $_POST);
    } else {
        Income::create($_POST);
    }
    header('Location: incomes.php');
    exit;
}

$incomes = Income::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gelirler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Gelirler</h1>
    <?php include __DIR__ . '/../src/nav.php'; ?>
    <form method="post" class="mb-4">
        <?php if (!empty($edit)): ?>
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php endif; ?>
        <div class="row g-2">
            <div class="col">
                <input type="text" name="description" class="form-control" placeholder="Açıklama" value="<?= htmlspecialchars($edit['description'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="number" step="0.01" name="amount" class="form-control" placeholder="Tutar" value="<?= htmlspecialchars($edit['amount'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="date" name="tx_date" class="form-control" value="<?= htmlspecialchars($edit['tx_date'] ?? '') ?>">
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
                <th>Açıklama</th>
                <th>Tutar</th>
                <th>Tarih</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($incomes as $income): ?>
            <tr>
                <td><?= htmlspecialchars($income['id']) ?></td>
                <td><?= htmlspecialchars($income['description']) ?></td>
                <td><?= htmlspecialchars($income['amount']) ?></td>
                <td><?= htmlspecialchars($income['tx_date']) ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="incomes.php?edit=<?= $income['id'] ?>">Düzenle</a>
                    <a class="btn btn-sm btn-outline-danger" href="incomes.php?delete=<?= $income['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
