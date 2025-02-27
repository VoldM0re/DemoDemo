<?php
session_start();
require_once 'include/db.inc.php';
require_once 'include/func.inc.php';

if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: user_update.php');
} else if ($_SESSION['user']['role'] != 'admin') {
    to_other_profile($_SESSION['user']['role']);
}

if (!isset($_POST['user_to_edit'])) {
    $_SESSION['error-message'] = 'Выберите пользователя!';
    header('Location: user_update.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>

    <h1>Измените данные</h1>
    <main>
        <form action='./include/user_update.inc.php' method='post'>
            <?php
            $_SESSION['user_to_edit_id'] = $_POST['user_to_edit'];
            $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = :id;");
            $stmt->execute([':id' => $_SESSION['user_to_edit_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "
                <input type='text' name='login' placeholder='Логин' value='" . $user['login'] . "'>
                <input type='password' name='pwd' placeholder='Пароль' value='" . $user['pwd'] . "'>
                <input type='text' name='name' placeholder='Имя' value='" . $user['name'] . "'>
                <input type='text' name='surname' placeholder='Фамилия' value='" . $user['surname'] . "'>
                <select name='role' class='role-select'>
                    <option value='admin'" . ($user['role'] == 'admin' ? 'selected' : '') . ">Админ</option>
                    <option value='manager'" . ($user['role'] == 'manager' ? 'selected' : '') . ">Директор</option>
                    <option value='employee'" . ($user['role'] == 'employee' ? 'selected' : '') . ">Работник</option>
                </select>";
            ?>
            <input type='submit' value='Изменить данные'>
        </form>
    </main>
    <?php
    display_message('message')
    ?>
</body>

</html>