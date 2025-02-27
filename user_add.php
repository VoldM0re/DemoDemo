<?php
session_start();
require_once 'include/db.inc.php';
require_once './include/func.inc.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
} else if ($_SESSION['user']['role'] != 'admin') {
    to_other_profile($_SESSION['user']['role']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>

    <h1>Добавить сотрудника</h1>
    <main>
        <form action='./include/user_add.inc.php' method='post'>
            <input type='text' name='login' placeholder='Логин'>
            <input type='password' name='pwd' placeholder='Пароль'>
            <input type='text' name='name' placeholder='Имя'>
            <input type='text' name='surname' placeholder='Фамилия'>
            <select name="role" class='role-select'>
                <option value="admin">Админ</option>
                <option value="manager">Директор</option>
                <option value="employee" selected>Работник</option>
            </select>
            <input type='submit' value='Добавить'>
        </form>
    </main>
    <?php
    display_message('message')
    ?>
</body>

</html>