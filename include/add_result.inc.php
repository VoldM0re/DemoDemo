<?php
session_start();
require_once 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['click_button'])) {
    $stmt = $pdo->prepare("UPDATE employees SET result = result + 1 WHERE id = :id;");
    $stmt->execute([':id' => $_SESSION['user']['id']]);

    $_SESSION['user']['result']++;
    header('Location: ../employee.php');
    die();
} else {
    header('Location: ../index.php');
}