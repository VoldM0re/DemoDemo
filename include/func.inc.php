<?php
function go_to_profile($user_role)
{
    if ($user_role == 'admin') {
        header('Location: ../admin.php');
        die();
    } else if ($user_role == 'manager') {
        header('Location: ../manager.php');
        die();
    } else if ($user_role == 'employee') {
        header('Location: ../employee.php');
        die();
    }
}

function to_other_profile($user_role)
{
    if ($user_role == 'admin') {
        header('Location: admin.php');
        die();
    } else if ($user_role == 'manager') {
        header('Location: manager.php');
        die();
    } else if ($user_role == 'employee') {
        header('Location: employee.php');
        die();
    }
}

function display_message($type)
{
    if (isset($_SESSION[$type])) {
        echo '
        <div class="' . $type . 's">
            <p class="' . $type . '">' . $_SESSION[$type] . '</p>
        </div>';
        unset($_SESSION[$type]);
    }
}