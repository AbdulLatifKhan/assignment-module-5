<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location:login.php');
} elseif ("1" != $_SESSION['role']) {
    header('Location:login.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Role Management</title>
    <?php
include 'bootstrap.php';
?>

    <style>
    .actionlink {
        text-decoration: none;
    }

    .bgcolr {
        background-color: #3d3d3d;
    }

    .logout {
        color: red;
        padding-left: 50px;
        font-size: 22px;
        text-decoration: none;
    }

    .logout:hover {
        color: #bd3939;
    }

    body {
        margin: 0;
        font-family: "Lato", sans-serif;
    }

    .sidebar {
        margin-left: -12px;
        padding: 0;
        width: 250px;
        background-color: #f1f1f1;
        position: fixed;
        height: 100%;
        overflow: auto;
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
        border-top: 1px solid #e5d7d7;
    }

    .sidebar a:first-child {
        border-top: none;
    }

    .sidebar a.active {
        background-color: #04AA6D;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
    </style>
</head>

<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-2 bgcolr">
                <h5 class="mb-1 pt-3 ps-3 text-white"><?php echo $_SESSION['username']; ?></h5>
                <h6 class="mb-2 ps-3 pt-1 text-white">
                    <?php if ('1' == $_SESSION['role']) {
    echo "Admin";
} elseif ('2' == $_SESSION['role']) {
    echo "Manager";
} elseif ('3' == $_SESSION['role']) {
    echo "User";
} elseif ('' == $_SESSION['role']) {
    echo "User";
}

?>
                </h6>
            </div>
            <div class="col-md-8 bgcolr">
                <h3 class="text-center mb-4  pt-4 text-white">User Role Management</h3>
            </div>
            <div class="col-md-2 bgcolr">
                <p class="pt-3"><a class="logout" href="logout.php">Logout</a></p>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-4">
                <div class="sidebar">
                    <a class="active" href="role_management.php">Home</a>
                    <a href="manager_dashboard.php">Manager Dashboard</a>
                    <a href="user_dashboard.php">User Dashboard</a>
                    <a href="contact.php">Contact</a>
                    <a href="about.php">About</a>
                </div>

            </div>
            <div class="col-md-5 pt-5 mt-5">

                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="padding: 0px 70px;">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
$users = json_decode(file_get_contents('users.json'), true);

foreach ($users as $userEmail => $userData) {

    ?>

                        <tr>
                            <td><?php echo $userData['username']; ?></td>
                            <td><?php echo $userEmail; ?></td>
                            <td> <?php

    if ('1' == $userData['role']) {
        echo "Admin";
    } elseif ('2' == $userData['role']) {
        echo "Manager";
    } elseif ('3' == $userData['role']) {
        echo "User";
    } elseif ('' == $userData['role']) {
        echo "";
    }
    ?>
                            </td>

                            <?php
$email = "updateable_users_email";
    $role = "updateable_users_role";
    ?>

                            <td>
                                <a href="create_role.php?<?php echo $email . "=" . $userEmail; ?>"
                                    class="actionlink text-primary">Create</a> |
                                <a href="update_role.php?<?php echo $email . "=" . $userEmail . "&" . $role . "=" . $userData['role']; ?>"
                                    class="actionlink text-success">Edit</a> |
                                <a href="delete_roles.php?<?php echo $email . "=" . $userEmail . "&" . $role . "=" . $userData['role']; ?>"
                                    class="actionlink text-danger">Delete</a>
                            </td>

                        </tr>
                        <?php

}
?>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</body>

</html>