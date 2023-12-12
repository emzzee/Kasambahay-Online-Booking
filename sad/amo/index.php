<?php
require_once('../db/connection.php');

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
    <link rel="stylesheet" type="text/css" href="../style/amo-sidebar.css">
    <link rel="stylesheet" type="text/css" href="../style/amo-navbar.css">
    <link rel="stylesheet" href="index.css">

    <title>Kasambahay</title>

</head>

<body>

    <?php
    include('../navbar/amo-navbar.php');
    include('../navbar/amosidebar.php');
    ?>

    <section class="home-section">

        <?php
        $user_id_to_display = 3; // Replace with the actual user ID
        
        // Retrieve services for the specific user
        $query1 = "SELECT u.*, s.service_name
                   FROM users u
                   LEFT JOIN services s ON u.users_id = s.users_id
                   WHERE u.role = 3";

        $query6 = "SELECT users.*, services.service_name
        FROM users
        LEFT JOIN services ON users.users_id = services.users_id WHERE role = 3";

        $result = mysqli_query($con, $query6);
        //FILTER BUTTON
        if (isset($_POST['filter'])) {
            $role = $_POST['role'];
            if ($role != "") {
                // If a role is selected, filter based on the role using a JOIN
                $query2 = "SELECT users.*, services.service_name
                          FROM users
                          LEFT JOIN services ON users.users_id = services.users_id
                          WHERE services.service_name='$role'";
                $result = mysqli_query($con, $query2);

            } else {
                $query3 = "SELECT users.*, services.service_name
            FROM users
            LEFT JOIN services ON users.users_id = services.users_id WHERE role = 3";
                $result = mysqli_query($con, $query3);
            }
        }
        ?>
        <div class="container">
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
        </div>

        <div class="row mt-4 justify-content-center">
            <?php
            // Display services in one card
            if ($result && mysqli_num_rows($result) > 0) {
                while ($user_data = mysqli_fetch_assoc($result)) {

                    // Concatenate service names into one string
                    // $services_string = implode(', ', array_column($result->fetch_all(MYSQLI_ASSOC), 'service_name'));
                    ?>
                    <div class="card">
                        <div class="image">
                            <img src="../upload/<?php echo $user_data["profile"] ?>" width="90" height="120" alt="">
                        </div>
                        <div class="description">
                            <h3 class="role">
                                <?php echo $user_data["service_name"] ?>
                            </h3>
                            <p class="worker_details">
                                <?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?>
                            </p>
                            <p class="address">
                                <?php echo $user_data["address"]; ?>
                            </p>
                            <p class="number">
                                <?php echo $user_data["mobile_number"]; ?>
                            </p>
                        </div>
                        <button type="button" class="btn">Hire Kasambahay</button>

                        <button class="btn btn-success mt-2" data-bs-toggle="modal"
                            data-bs-target="#create-booking<?= $row['id']; ?>">Message</button>
                    </div>


                <?php
                }
            } // Close the database connection
            $con->close(); ?>
        </div>
        </div>

    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>