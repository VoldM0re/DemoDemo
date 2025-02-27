<?php
session_start();
require_once 'db.inc.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE employees SET login = :login, pwd = :pwd, name = :name, surname = :surname, role = :role WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':login' => $_POST['login'],
        ':pwd' => $_POST['pwd'],
        ':name' => $_POST['name'],
        ':surname' => $_POST['surname'],
        ':role' => $_POST['role'],
        ':id' => $_SESSION['user_to_edit_id'],
    ]);
    $_SESSION['message'] = 'Выбранные пользователи изменены!';
    unset($_SESSION['user_to_edit_id']);
    header('Location: ../update_user.php');

    $stmt = null;
    $pdo = null;
    die();
} else {
    header('Location: ../index.php');
}