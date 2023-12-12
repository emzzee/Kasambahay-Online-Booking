
<?php
require_once('db/connection.php');
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
    <link rel="stylesheet" type="text/css" href="style/amo-sidebar.css">
    <link rel="stylesheet" type="text/css" href="style/amo-navbar.css">
    <link rel="stylesheet" href="amo/index.css">

    <title>Kasambahay</title>

</head>

<body>

    <?php 
    include('navbar/amo-navbar.php');
    include('navbar/amosidebar.php');
    ?>

    <section class="home-section">

        <?php
        $user_id_to_display = 1; // Replace with the actual user ID

        // Retrieve services for the specific user
        $query = "SELECT u.*, s.service_name
                  FROM users u
                  LEFT JOIN services s ON u.users_id = s.users_id
                  WHERE u.users_id = $user_id_to_display";
        
        $result = mysqli_query($con, $query);
        
        // Display services
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
        ?>
                <div class="card">
                    <div class="image">
                        <img style="height: 30px !important; width: 30px !important;" 
                            src="../upload/<?php echo $row["profile"]; ?>" alt="Profile">
                    </div>
                    <div class="description">
                        <h3 class="role">
                            <?php echo $row["service_name"]; ?>
                        </h3>
                        <p class="worker_details">
                            <?php echo $row["first_name"] . " " . $row["last_name"]; ?>
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
        
        // Close the database connection
        $con->close();
        ?>


    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>