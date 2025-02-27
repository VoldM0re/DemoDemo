<?php
session_start();
require_once 'include/db.inc.php';
require_once './include/func.inc.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
} else if ($_SESSION['user']['role'] != 'employee') {
    to_other_profile($_SESSION['user']['role']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Профиль сотрудника</title>
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>
    <main>
        <h1>Добро пожаловать, <?= $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] ?></h1>
        <h2>Ваш текущий результат: <?= $_SESSION['user']['result'] ?></h2>
        <form action="./include/add_result.inc.php" method='POST'>
            <button type="submit" name='click_button' class='employee_button'>Нажать</button>
        </form>

    </main>
</body>

</html>