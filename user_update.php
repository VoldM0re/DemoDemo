<?php
session_start();
require_once 'include/db.inc.php';
require_once 'include/func.inc.php';

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
    <title>Изменение пользователя</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>

    <h1>Выберите пользователя для изменения</h1>
    <main>
        <form action='./user_updating.php' method='post'>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM employees WHERE role = 'employee' OR role = 'manager';");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                echo '
                <label class="users_list">
                    <input class="users_list-checkbox" type="radio" name="user_to_edit" value="' . $user['id'] . '">
                    <span>' . $user['login'] . ', ' . $user['name'] . '. Кликов: ' . $user['result'] . '</span>
                </label>';
            }
            ?>
            <input type='submit' value='Изменить данные'>
        </form>
    </main>
    <?php
    display_message('message');
    display_message('error-message');
    ?>
</body>

</html>