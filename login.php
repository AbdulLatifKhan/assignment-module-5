<?php
session_start();

if (isset($_SESSION['username'])) {
    if ("1" == $_SESSION['role']) {
        header('Location:role_management.php');
    } elseif ("2" == $_SESSION['role']) {
        header('Location:manager_dashboard.php');
    } elseif ("3" == $_SESSION['role']) {
        header('Location:user_dashboard.php');
    } else {
        header('Location:user_dashboard.php');
    }
}

$users = json_decode(file_get_contents('users.json'), true);
//print_r($users);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errorMsg = "Please fill up  all the fields!";
    } else {
        foreach ($users as $userEmail => $userEmailArr) {
            echo $userEmailArr['username'];

            if ($email == $userEmail && $password == $userEmailArr['password']) {
                $_SESSION['username'] = $userEmailArr['username'];
                $_SESSION['role'] = $userEmailArr['role'];

                if ($userEmailArr['role'] == 1) {
                    header('Location:role_management.php');
                } elseif ($userEmailArr['role'] == 2) {
                    header('Location:manager_dashboard.php');
                } elseif ($userEmailArr['role'] == 3) {
                    header('Location:user_dashboard.php');
                } else {
                    header('Location:user_dashboard.php');
                }
            } else {
                $errorMsg = "Username and password didn't match!";
            }

        }

    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <?php
include 'bootstrap.php';
?>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-5 mx-auto">
                <h3 class="text-center mb-4">Use Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5 class="text-center mb-4">User Login</h5>
                        </div>
                        <div class="">
                            <p class="">Already haven't an account?</p>
                            <div class="text-end ">
                                <a href="registration.php" class="btn btn-primary text-white text-end">Register Now</a>
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
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input class="btn btn-primary" type="submit" name="login" value="Login">
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</body>

</html>