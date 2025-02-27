<?php
session_start();
require_once 'include/db.inc.php';
require_once 'include/func.inc.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
} else if ($_SESSION['user']['role'] != 'manager') {
    to_other_profile($_SESSION['user']['role']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Профиль директора</title>
</head>

<body>
    <div class="menu">
        <a href="include/logout.inc.php" class='link-button'>Выйти из аккаунта</a>
        <button class='link-button' onclick='history.go(-1)'>Назад</button>
    </div>
    <main>
        <h1>Добро пожаловать, <?= $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] ?></h1>
        <table border='2'>
            <thead>
                <tr>
                    <th>Номер сотрудника</th>
                    <th>Имя сотрудника</th>
                    <th>Результативность</th>
                </tr>
            </thead>
            <tbody>
                <h2>Результаты сотрудников</h2>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM employees WHERE role = 'employee';");
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    echo '
                    <tr>
                        <td>' . $user['id'] . '</td>
                        <td>' . $user['name'] . '</td>
                        <td>' . $user['result'] . '</td>
                    </tr>
                    ';
                }
                $stmt = null;
                $pdo = null;
                ?>
            </tbody>
        </table>

        <section class='diagram'>
            <?php
            foreach ($users as $user) {
                echo '
                <div class="diagram-column" style="height: ' . $user['result'] * 10 . 'px;">' . $user['id'] . ': ' . $user['result'] . '</div>
                ';
            }
            ?>
        </section>

    </main>
</body>

</html>