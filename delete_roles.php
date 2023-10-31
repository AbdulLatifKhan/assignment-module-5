<?php

session_start();

//catching user email from url for update
if (isset($_GET['updateable_users_email'])) {
    $role = $_GET['updateable_users_role'];

    $updatemail = $_GET['updateable_users_email'];

    $users = json_decode(file_get_contents('users.json'), true);

    $user_email = $updatemail;
    $new_role = "";

    if (isset($users[$user_email])) {
        $users[$user_email]['role'] = $new_role;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        header('Location:role_management.php');
    }

} else {
    echo "Email not found";
}
