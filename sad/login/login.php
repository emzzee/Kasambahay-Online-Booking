<?php 

session_start();
include("../db/function.php");
// die($_SESSION['id']);
if(isset($_POST['submit'])){
    include("../db/connection.php");
    
    $username = $_POST['mobile_number'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE `mobile_number` = '$username' AND `password` = '$password'";
    $query = $con->query($sql);
    $row = $query->fetch_array();

    if($query->num_rows != 0){
        $_SESSION['users_id'] = $row['users_id'];
        if($row['role'] == 1){
        @header("Location: ../admin/index.php");
        exit();
    }else if($row['role'] == 2){
        @header("Location: ../amo/index.php");
        exit();
    }else if($row['role'] == 3){
        @header("Location: ../kasambahay/index.php");
        exit();
    }
    } else {
      // die("Error: ".$con->error);
      
        echo('<script>alert("Wrong username or password!");window.location = "../login/login.php";</script>');
        exit();
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
 

    <title>KOB Login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<style>
    .background {

        background-image: url('../images/BG.jpg');
    }
</style>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top flex-md-nowrap">
    <div class="container-fluid col-lg-12 col-md-12">
        <div class="logo flex">
            <div class="logo_items">
                <img src="../images/Kasambahay.png" alt="" />
            </div>
            <div class="logo_name" flex>CONNECT WITH TRUSTED PERSON</div>
        </div>
    </div>
</nav>

    <div class="background">
    </div>
    <div class="container d-flex flex-column mt-2 login">
    <?php
                    if(isset($_SESSION['status']))
                    {
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> Hey! </strong> <?php echo $_SESSION['status'];?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php

                        unset($_SESSION['status']);
                    }
                ?>
        <div class="box form-box">
            <header>KASAMBAHAY</header>
            <form action="login.php" method="POST">
            
                <div class="field input">
                    <label for="mobile_numbner">Mobile Number</label>
                    <input type="text" name="mobile_number" id="mobile_number" required>
                    <box-icon name='user'></box-icon>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <box-icon name='lock-alt' ></box-icon>
                </div>
                <div class="forgot mt-3">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="field mt-3">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>