<?php
require_once('connectiontest.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="./amo-sidebar.css">
    <title>Kasambahay</title>
    <link rel="stylesheet" href="index.css">

</head>

<body>
    <?php include('element/amo-navbar.php');
    ?>
    
<<div class="sidebar">
    <div class="logo_details">
      <i class="bx bxl-audible icon"></i>
      <div class="logo_name">Code Effect</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <i class="bx bx-search"></i>
        <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-grid-alt"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-user"></i>
          <span class="link_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-chat"></i>
          <span class="link_name">Message</span>
        </a>
        <span class="tooltip">Message</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-pie-chart-alt-2"></i>
          <span class="link_name">Analytics</span>
        </a>
        <span class="tooltip">Analytics</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-folder"></i>
          <span class="link_name">File Manger</span>
        </a>
        <span class="tooltip">File Manger</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-cart-alt"></i>
          <span class="link_name">Order</span>
        </a>
        <span class="tooltip">Order</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bx-cog"></i>
          <span class="link_name">Settings</span>
        </a>
        <span class="tooltip">Settings</span>
      </li>
      <li class="profile">
        <div class="profile_details">
          <img src="profile.jpeg" alt="profile image">
          <div class="profile_content">
            <div class="name">Anna Jhon</div>
            <div class="designation">Admin</div>
          </div>
        </div>
        <i class="bx bx-log-out" id="log_out"></i>
      </li>
    </ul>
  </div>
 <?php
    $sql = "SELECT * FROM worker;";
    $result = mysqli_query($con, $sql);
    $resultcheck = mysqli_num_rows($result);
    ?>

    <form name="filter" method="POST" action="">
    <select class="role w-25" name="role" id="role">
      <option value=""> </option>
      <option value="Child Care">Child Care</option>
      <option value="Senior Care">Senior Care</option>
      <option value="Cook">Cook</option>
      <option value="Laundry">Laundry</option>
      <option value="Maid">Maid</option>
      <option value="Driver">Family Driver</option>
      <option value="Houseboy">Houseboy</option>
      <option value="Store Assistant">Store Assistant</option>
      <option value="Repair Man">Repair Man</option>
      <option value="Gardener">Gardener</option>

    </select>
    
    <button name="filter" class="btn btn-success"> Filter </button>
    </form>
    <?php

        //FILTER BUTTON

        if (isset($_POST['filter'])) {
            $role = $_POST['role'];

            $query = "SELECT * FROM worker WHERE role='$role'";
            $result = mysqli_query($con, $query);
            
        } else {
            $query = "SELECT * FROM worker";
            $result = mysqli_query($con, $query);
        }
        ?>

    <div class="row mt-4 d-flex justify-content-center">
        <?php
        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <div class="image">
                        <img src="<?php echo $row["role"]; ?>" alt="Profile">
                    </div>
                    <div class="description">
                        <h3 class="role">
                            <?php echo $row["role"]; ?>
                        </h3>
                        <p class="worker_details">
                            <?php echo $row["first_name"];
                            echo $row["last_name"]; ?>
                        </p>
                        <p class="address">
                                <?php echo $row["address"]; ?>
                            </p>
                        <p class="number">
                                <?php echo $row["mobile_number"]; ?>
                            </p>
                    </div>
                    <button type="button" class="btn">Hire Worker</button>
                </div>  
                    
                <?php
            }
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>