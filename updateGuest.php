<head>
  <title>Update Guest Information</title>
   <link rel="stylesheet" href="messageFormat.css">
</head>


<body>
    <!-- Provides a link back to the Home page. -->
    <a href="index.html" class="button">Back to Home</a><br>
    <div>
        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);

            // mysqli connection via user-defined function
            include('./my_connect.php');
            $mysqli1 = get_mysqli_conn();
            $mysqli2 = get_mysqli_conn();
            $mysqli3 = get_mysqli_conn();
            $mysqli4 = get_mysqli_conn();
            $mysqli5 = get_mysqli_conn();
            $mysqli6 = get_mysqli_conn();
            // SQL statement to update the first name information for the guest.
            $sqlfname = "UPDATE guest "
            . "SET first_name = ? "
            . "WHERE ID = ?";
            // SQL statement to update the last name information for the guest.
            $sqllname = "UPDATE guest "
            . "SET last_name = ? "
            . "WHERE ID = ?";
            // SQL statement to update the city information for the guest.
            $sqlcity = "UPDATE guest "
            . "SET city = ? "
            . "WHERE ID = ?";
            // SQL statement to update the street information for the guest.
            $sqlstreet = "UPDATE guest "
            . "SET street_no = ? "
            . "WHERE ID = ?";
            // SQL statement to update the postal code information for the guest.
            $sqlpostal = "UPDATE guest "
            . "SET postal_code = ? "
            . "WHERE ID = ?";
            // SQL statement to update the phone number information for the guest.
            $sqlphone = "UPDATE guest "
            . "SET phone_no = ? "
            . "WHERE ID = ?";
            // Prepared statement, stage 1: prepare
            $stmt = $mysqli1->prepare($sqlfname);
            $stmt2 = $mysqli2->prepare($sqllname);
            $stmt3 = $mysqli3->prepare($sqlcity);
            $stmt4 = $mysqli4->prepare($sqlstreet);
            $stmt5 = $mysqli5->prepare($sqlpostal);
            $stmt6 = $mysqli6->prepare($sqlphone);
            // Fetches the desired information and stores them into variables for later use.
            $guest_ID = $_POST['guest_ID']; 
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname']; 
            $city = $_POST['city'];
            $street_no = $_POST['street_no']; 
            $postal_code = $_POST['pcode'];
            $phone_no = $_POST['phone_no'];
            // Binds the required parameters to each SQL statement. 
            $stmt->bind_param('si', $first_name, $guest_ID); 
            $stmt2->bind_param('si', $last_name, $guest_ID); 
            $stmt3->bind_param('si', $city, $guest_ID); 
            $stmt4->bind_param('si', $street_no, $guest_ID); 
            $stmt5->bind_param('si', $postal_code, $guest_ID); 
            $stmt6->bind_param('si', $phone_no, $guest_ID); 
            // $stmt->execute() function returns boolean indicating success. If successful, then prints a success message.
            if ($stmt->execute() & $stmt2->execute() & $stmt3->execute() & $stmt4->execute() & $stmt5->execute() & $stmt6->execute()) { 
                echo '<h1>Success!</h1>'; 
                echo '<p>Guest information for Guest #' . $guest_ID . ' updated successfully!</p>'; 
            } 
            // If not successful, then prints an error message.
            else {
                echo '<h1>Error!</h1>';
                echo '<p>Guest information not updated successfully. Please try again.</p>'; 
            } 
            // Close statement and connection.
            $stmt->close(); 
            $stmt2->close(); 
            $stmt3->close(); 
            $stmt4->close(); 
            $stmt5->close(); 
            $stmt6->close(); 
            $mysqli1->close();
            $mysqli2->close();
            $mysqli3->close();
            $mysqli4->close();
            $mysqli5->close();
            $mysqli6->close();
        ?>
    </div>
</body>
