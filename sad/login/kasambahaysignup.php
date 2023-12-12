<?php
session_start();
include("../db/connection.php");
include("../db/function.php");
//Resident Signup
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $fname = sec_input($_POST['first_name']);
    $lname = sec_input($_POST['last_name']);
    $contact = sec_input($_POST['contact']);
    $password = $_POST['password'];
    $profile = $_FILES['profile'];
    $address = sec_input($_POST['address']);
    $birthdate = sec_input($_POST['birthdate']); 
    $credentials = $_FILES['credentials'];
    $date = date('Y-m-d');

    
    $stmt = $con->prepare("SELECT * FROM users WHERE mobile_number = ?");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo('<script>alert(" Mobile Number already exist!");window.location = "kasambahayregister.php";</script>');
    }

    // if user password and email is not empty
    else {
            // Proceed with the insertion process
    
            // Hash the password for security (you should use a more secure method in a real-world scenario)
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //Generate a unique filename to avoid conflicts
            $filename = uniqid() . '_' . $profile['name'];
            
            // Move the uploaded file to the desired location
            $uploadDir = '../upload/';
            $destination = $uploadDir . $filename;
            if(move_uploaded_file($profile['tmp_name'], $destination)){
            //Insert user data into the 'users' table
            $insert_stmt = $con->prepare("INSERT INTO users (first_name, last_name, mobile_number, password, profile, address, birthdate, valid_id, date, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 3, 1)");
            $insert_stmt->bind_param("sssssssss", $fname, $lname, $contact, $password, $profile, $address, $birthdate, $credentials, $date);
    
            if ($insert_stmt->execute()) {
                $_SESSION['status'] = "You've Successfully Registered";
                $user_id = $con->insert_id;
                
                if (!empty($_POST['services'])) {
                    $services = $_POST['services'];
                    foreach ($services as $service) {
                        $service_insert_sql = "INSERT INTO services (service_name,users_id) VALUES (?, ?)";
                        $service_stmt = $con->prepare($service_insert_sql);
                        $service_stmt->bind_param("si", $service, $user_id );
                        $service_stmt->execute();
                        $service_stmt->close();
                    }
                }

                header("Location: ../login/login.php");
                
            } else {
                echo "Error: " . $insert_stmt->error;
            }
        }else {
            echo 'Failed to move uploaded file.';
            }
    
        // Close the database connection
        $stmt->close();
        $insert_stmt->close();
        $con->close();
    }
}


//         if(!empty($contact) && !empty($password))
//     {
//          // Generate a unique filename to avoid conflicts
//             $filename = uniqid() . '_' . $profile['name'];

//             // Move the uploaded file to the desired location
//             $uploadDir = '../upload/';
//             $destination = $uploadDir . $filename;
//            if(move_uploaded_file($profile['tmp_name'], $destination)){

//             $sql = "insert into users (first_name,last_name,mobile_number,password,profile,address,birthdate,valid_id,date,role,status)
//             VALUES ('$fname','$lname','$contact','$password','$profile','$address','$birthdate','$credentials','$date',3,1)";
//             if ($con->query($sql) === TRUE) {
//               $_SESSION['status'] = "You've Successfully Registered";
//               header("Location: ../login/login.php");
//           } else {
//               echo 'Error: ' . $sql . '<br>' . $con->error;
//           }
//       } else {
//           echo 'Failed to move uploaded file.';
//       }
//     }
//     }

// }

function sec_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>
