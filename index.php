<?php
session_start();
require_once './include/func.inc.php';

if (isset($_SESSION['user'])) {
    to_other_profile($_SESSION['user']['role']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Войти</title>
</head>

<body>
    <main>
        <h1>Войдите в систему</h1>
        <form action="include/login.inc.php" method="post">
            <input type="text" name='login' placeholder="Логин">
            <input type="password" name='pwd' placeholder="Пароль">
            <input type="submit" value='Войти'>
        </form>
    </main>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '
            <div class="error-messages">
                <p class="error-message">' . $_SESSION['error_message'] . '</p>
            </div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <pre></pre>
</body>

</html>