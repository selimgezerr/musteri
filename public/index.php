<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/Customer.php';
require_once __DIR__ . '/../src/Project.php';
require_once __DIR__ . '/../src/Task.php';
require_once __DIR__ . '/../src/Income.php';
require_once __DIR__ . '/../src/Expense.php';

$customers = Customer::all();
$projectCount = count(Project::all());
$taskCount = count(Task::all());
$incomeTotal = array_sum(array_column(Income::all(), 'amount'));
$expenseTotal = array_sum(array_column(Expense::all(), 'amount'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Genel Bakış</h1>
    <div class="row mb-4">
        <div class="col">
            <div class="p-3 bg-light rounded">
                <strong>Proje Sayısı:</strong> <?= $projectCount ?>
            </div>
        </div>
        <div class="col">
            <div class="p-3 bg-light rounded">
                <strong>Görev Sayısı:</strong> <?= $taskCount ?>
            </div>
        </div>
        <div class="col">
            <div class="p-3 bg-light rounded">
                <strong>Toplam Gelir:</strong> <?= number_format($incomeTotal,2) ?>
            </div>
        </div>
        <div class="col">
            <div class="p-3 bg-light rounded">
                <strong>Toplam Gider:</strong> <?= number_format($expenseTotal,2) ?>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/../src/nav.php'; ?>
    <h2>Müşteri Listesi</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>E-posta</th>
                <th>Telefon</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['id']) ?></td>
                <td><?= htmlspecialchars($customer['name']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td><?= htmlspecialchars($customer['phone']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
