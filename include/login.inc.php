<?php
session_start();
require_once 'db.inc.php';
require_once 'func.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];

    if (!empty($login) && !empty($pwd)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM employees WHERE login = :login AND pwd = :pwd");
            $stmt->execute([':login' => $login, ':pwd' => $pwd]);
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

            // $_SESSION['DEBUG'] = [$user_data, password_verify($pwd, $user_data['pwd'])];
            if ($user_data && $pwd == $user_data['pwd']) {
                $_SESSION['user'] = [
                    'id' => $user_data['id'],
                    'login' => $user_data['login'],
                    'pwd' => $user_data['pwd'],
                    'role' => $user_data['role'],
                    'name' => $user_data['name'],
                    'surname' => $user_data['surname'],
                    'result' => $user_data['result'],
                ];
                go_to_profile($_SESSION['user']['role']);
            } else {
                $_SESSION['error-message'] = 'Неверное имя пользователя или пароль!';
                header('Location: ../index.php');
            }
        } catch (PDOException $e) {
            die("Ошибка при выполнении SQL-запроса: " . $e->getMessage());
        }
    } else {
        $_SESSION['error-message'] = 'Заполните все поля!';
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}