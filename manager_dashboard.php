<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location:login.php');
} elseif (isset($_SESSION['username']) && "3" == $_SESSION['role']) {
    header('Location:user_dashboard.php');
} elseif (isset($_SESSION['username']) && "" == $_SESSION['role']) {
    header('Location:user_dashboard.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manager Dashboard</title>
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

    .para {
        font-size: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row bgcolr">
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
                <h3 class="text-center mb-4 pt-4 text-white">Manager Dashboard</h3>
            </div>
            <div class="col-md-2 bgcolr">
                <p class="pt-3"><a class="logout" href="logout.php">Logout</a></p>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-3 margin">
                <div class="sidebar">
                    <?php if ('1' == $_SESSION['role']) {?>

                    <a class="active" href="role_management.php">Home</a>
                    <a href="manager_dashboard.php">Manager Dashboard</a>
                    <a href="user_dashboard.php">User Dashboard</a>
                    <a href="contact.php">Contact</a>
                    <a href="about.php">About</a>

                    <?php } elseif ('2' == $_SESSION['role']) {?>

                    <a class="active" href="manager_dashboard.php">Home</a>
                    <a href="user_dashboard.php">User Dashboard</a>
                    <a href="contact.php">Contact</a>
                    <a href="about.php">About</a>

                    <?php } else {?>

                    <a class="active" href="user_dashboard.php">Home</a>
                    <a href="contact.php">Contact</a>
                    <a href="about.php">About</a>

                    <?php }?>

                </div>
            </div>
            <div class="col-md-9">
                <h1 class="mt-5">Project Details</h1>
                <hr>
                <p class="mt-5 pb-3 para">1. Role management page can be access only admin.</p>
                <p class="pb-3 para">2. In this project users can access user dashboard, contact and about page.</p>
                <p class="pb-3 para">3. Manager can access manager dashboard, userdashboard, contact and about page.</p>
                <p class="pb-3 para">4. Admin can access user role management, and others all pages.</p>
            </div>
        </div>
    </div>
</body>

</html>