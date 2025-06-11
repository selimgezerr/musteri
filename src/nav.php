<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="mb-3">
    <span class="me-3">Hoş geldiniz, <?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?></span>
    <a class="btn btn-secondary" href="index.php">Panel</a>
    <a class="btn btn-secondary" href="projects.php">Projeler</a>
    <a class="btn btn-secondary" href="tasks.php">Görevler</a>
    <a class="btn btn-secondary" href="incomes.php">Gelirler</a>
    <a class="btn btn-secondary" href="expenses.php">Giderler</a>
    <a class="btn btn-secondary" href="customers.php">Müşteriler</a>
    <a class="btn btn-outline-danger" href="logout.php">Çıkış</a>
</nav>
