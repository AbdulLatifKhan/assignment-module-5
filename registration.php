<?php
session_start();
if (isset($_SESSION['username'])) {
    if ("1" == $_SESSION['role']) {
        header('Location:role_management.php');
    } elseif ("2" == $_SESSION['role']) {
        header('Location:manager_dashboard.php');
    } elseif ("3" == $_SESSION['role'] || "" == $_SESSION['role']) {
        header('Location:user_dashboard.php');
    }
}

$usersFile = 'users.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

function saveFile($users, $usersFile)
{
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
}

//Registration form handling
if (isset($_POST['register'])) {
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    //Validation
    if (empty($userName) || empty($email) || empty($password)) {
        $errorMsg = "Please fill up  all the fields!";
    } else {
        if (isset($users[$email])) {
            $errorMsg = "This Email Already Exist!";
        } else {
            $users[$email] = [
                'username' => $userName,
                'password' => $password,
                'role' => '',

            ];
            print_r($users);
            saveFile($users, $usersFile);
            $_SESSION['email'] = $email;
            header('Location: login.php');
        }

    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <?php
include 'bootstrap.php';
?>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center mb-4">Use Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3 class="text-center mb-4">User Registration</h3>
                        </div>
                        <div class="">
                            <p class="">Already have an account?</p>
                            <div class="text-end ">
                                <a href="login.php" class="btn btn-primary text-white text-end">Login Now</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <?php

if (isset($errorMsg)) {
    echo "<p class='text-danger'>$errorMsg</p>";
}

?>
                        <form class="form" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input type="hidden" name="role" value="">
                            <input class="btn btn-primary" type="submit" name="register" value="Register">
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</body>

</html>