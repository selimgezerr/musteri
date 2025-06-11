<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/Customer.php';

if (isset($_GET['delete'])) {
    Customer::delete($_GET['delete']);
    header('Location: customers.php');
    exit;
}

if (isset($_GET['edit'])) {
    $edit = Customer::find($_GET['edit']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id'])) {
        Customer::update($_POST['id'], $_POST);
    } else {
        Customer::create($_POST);
    }
    header('Location: customers.php');
    exit;
}

$customers = Customer::all();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Müşteriler</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Müşteriler</h1>
    <?php include __DIR__ . '/../src/nav.php'; ?>
    <form method="post" class="mb-4">
        <?php if (!empty($edit)): ?>
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php endif; ?>
        <div class="row g-2">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Ad" value="<?= htmlspecialchars($edit['name'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="email" name="email" class="form-control" placeholder="E-posta" value="<?= htmlspecialchars($edit['email'] ?? '') ?>" required>
            </div>
            <div class="col">
                <input type="text" name="phone" class="form-control" placeholder="Telefon" value="<?= htmlspecialchars($edit['phone'] ?? '') ?>">
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
                <th>E-posta</th>
                <th>Telefon</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['id']) ?></td>
                <td><?= htmlspecialchars($customer['name']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="customers.php?edit=<?= $customer['id'] ?>">Düzenle</a>
                    <a class="btn btn-sm btn-outline-danger" href="customers.php?delete=<?= $customer['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
