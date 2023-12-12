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
    include('../navbar/kbnavbar.php');
    include('../navbar/kbsidebar.php');
    ?>

    <section class="home-section">

    <?php
        $user_id_to_display = 2; // Replace with the actual user ID
        
        // Retrieve services for the specific user
        $query1 = "SELECT u.*, s.service_name FROM users u 
        LEFT JOIN services s ON u.users_id = s.users_id 
        WHERE u.users_id = $user_id_to_display";

        $result = mysqli_query($con, $query1);
        ?>

    <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Address</th>
              <th>Date</th>
              <th>Queries</th>
              <th>Booking type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php 
                while($row = mysqli_fetch_assoc($result5))
                {

                  switch($row['booking_type']) {
                    case 1:
                        $status_icon = 'fa-solid fa-clock-rotate-left'; 
                        $status_color = 'th-color-orange';
                        break;
                    case 2:
                        $status_icon = 'fa-check-circle';
                        $status_color = 'th-color-success';
                        break;
                    case 3:
                        $status_icon = 'fa-times-circle';
                        $status_color = 'th-color-red';
                        break;
                }
              ?>
                <td><?=$row['fname'];?> <?=$row['lname'];?></td>
                <td><?=$row['contact'];?></td>
                <td><?=$row['adder'];?></td>
                <td><?=$row['date'];?></td>
                <td><?=$row['queries'];?></td>
                <td>
                <span class="th-badge <?php echo $status_color ?>">
                  <?=$booking[$row['booking_type']]?>
                  <i class="fas <?php echo $status_icon ?> ml-1"></i>
                </span>
                </td>
                <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deny<?=$row['id']; ?>">
                  Deny
                </button>
                </td>
                <td>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#update<?=$row['id']; ?>">
                  Accept 
                </button>
              </td>
              </tr>
              <!-- MODAL ACCEPT -->
              <div class="modal fade" id="update<?=$row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Confirm Booking Request</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <form action="logic.php" method="POST">
                      <div class="modal-body">
                      <input type="text" name="id" value="<?=$row['id']; ?>" hidden>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Accept" name="confirm">
                    </div>
                  </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="deny<?=$row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Deny Booking Request</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <form action="logic.php" method="POST">
                      <div class="modal-body">
                      <input type="text" name="id" value="<?=$row['id']; ?>" hidden>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary" value="Deny" name="Deny">
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <?php
                }
              ?>
           
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