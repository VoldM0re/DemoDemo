<?php
session_start();
require_once 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $role = $_POST['role'];

    $query = "INSERT INTO employees (login, pwd, name, surname, role) VALUES (:login, :pwd, :name, :surname, :role);";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':login' => $login,
        ':pwd' => $pwd,
        ':name' => $name,
        ':surname' => $surname,
        ':role' => $role
    ]);

    $_SESSION['message'] = "Новый пользователь $login успешно добавлен!";
    header('Location: ../add_user.php');

    $stmt = null;
    $pdo = null;
    die();
} else {
    header('Location: ../index.php');
}