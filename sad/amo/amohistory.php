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
        $user_id_to_display = 2; // Replace with the actual user ID
        
        // Retrieve services for the specific user
        $query1 = "SELECT b.*, s.salary, s.service_name, u.first_name FROM booking b 
        LEFT JOIN services s ON b.users_id = s.users_id 
        LEFT JOIN users u ON b.users_id = u.users_id 
        WHERE b.users_id = $user_id_to_display";

        $result = mysqli_query($con, $query1);
        ?>
    <div class="table-responsive">
    <table class="table table-striped table-vcenter">
        <thead>
        <tr>
            <th class="text-center">NAME</th>
            <th class="text-center">SERVICE</th>
            <th class="text-center">STATUS</th>
            <th class="text-center">START DATE</th>
            <th class="text-center">END DATE</th>
            <th class="text-center">PAYMENT</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php foreach( $result as $row ) : ?>
            <tr>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['service_name'] ?></td>
                <td><?php echo $row['booking_confirmation'] ?></td>
                <td><?php echo $row['start_date'] ?></td>
                <td><?php echo $row['end_date'] ?></td>
                <td><?php echo $row['salary'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>



    </section>


<script src="../script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>