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
    <link rel="stylesheet" href="styles.css">
    <title>Кабинет админа</title>
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>
    <main>
        <h1>Добро пожаловать, <?= $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] ?></h1>
        <table border="2">
            <thead>
                <tr>
                    <th>Номер сотрудника</th>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Роль</th>
                    <th>Имя сотрудника</th>
                </tr>
            </thead>
            <tbody>
                <h1>Список пользователей</h1>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM employees WHERE role = 'employee' OR role = 'manager';");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    echo '
                    <tr>
                        <td>' . $user['id'] . '</td>
                        <td>' . $user['login'] . '</td>
                        <td>' . $user['pwd'] . '</td>
                        <td>' . $user['role'] . '</td>
                        <td>' . $user['name'] . '</td>
                    </tr>
                    ';
                }
                $stmt = null;
                $pdo = null;
                ?>
            </tbody>
        </table>

        <div class="admin-buttons">
            <a href="user_add.php" class='link-button admin-button'>Добавить</a>
            <a href="user_update.php" class='link-button admin-button'>Изменить</a>
            <a href="user_delete.php" class='link-button admin-button'>Удалить</a>
        </div>
    </main>

    <!-- <pre><?= print_r($users); ?></pre> -->
</body>

</html>