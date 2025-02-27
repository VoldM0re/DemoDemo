<?php
session_start();
require_once 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_to_delete = $_POST['users_to_delete'];

    foreach ($users_to_delete as $id) {
        $stmt = $pdo->prepare("DELETE FROM employees WHERE id = :id;");
        $stmt->execute([':id' => $id,]);
    }

    $_SESSION['message'] = 'Выбранные пользователи удалены!';
    header('Location: ../delete_user.php');

    $stmt = null;
    $pdo = null;
    die();
} else {
    header('Location: ../index.php');
}