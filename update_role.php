<?php

session_start();

//catching user email from url for update
if (isset($_GET['updateable_users_email'])) {
    $role = $_GET['updateable_users_role'];

    $updatemail = $_GET['updateable_users_email'];

    $users = json_decode(file_get_contents('users.json'), true);

    if (isset($_POST['update_role'])) {
        $user_email = $updatemail;
        $new_role = $_POST['role'];

        if (isset($users[$user_email])) {
            $users[$user_email]['role'] = $new_role;
            file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
            header('Location:role_management.php');
        }

    }

} else {
    echo "Email not found";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>role Update</title>
    <?php
include 'bootstrap.php';
?>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Update Role</h3>
                    </div>
                    <div class="card-body">
                        <form class="form" method="POST">

                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                name="role">
                                <option selected>
                                    <?php
if ('1' == $role) {
    echo "Admin";
} elseif ('2' == $role) {
    echo "Manager";
} elseif ('3' == $role) {
    echo "Manager";
} else {
    echo "";
}

?>
                                </option>
                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">User</option>
                            </select>
                            <input class="btn btn-primary" type="submit" name="update_role" value="Update">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>