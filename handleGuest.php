<head>
    <title>Update Guest Information</title>
    <link rel="stylesheet" href="formFormat.css">
</head>

<body>
    <!-- Provides a link back to the Home page. -->
    <a href="index.html" class="button">Back to Home</a> <br>
    
    <h1>Update Guest Information</h1>

    <div>
        <!-- Directs to the updateGuest.php when the user presses the Update button.
         Uses post as it is more secure than get. -->
        <form action="updateGuest.php" method="post">

            <?php
                // Enable error logging.
                error_reporting(E_ALL ^ E_NOTICE);
                // mysqli connection via user-defined function
                include('./my_connect.php');
                $mysqli = get_mysqli_conn();
                // SQL statement to obtain the relevant guest information based on the provided ID.
                $sql = "SELECT first_name, last_name, city, street_no, postal_code, phone_no "
                . "FROM guest "
                . "WHERE ID = ? ";
                // Prepared statement, stage 1: prepare
                $stmt = $mysqli->prepare($sql);
                // Prepared statement, stage 2: bind and execute 
                $guest_ID = $_POST['guest_ID']; 
                $stmt->bind_param('i', $guest_ID); 
                $stmt->execute();
                // Bind result variables.
                $stmt->bind_result($first_name, $last_name, $city, $street_no, $postal_code, $phone_no); 
                // If guest exists in the database, then pre-initializes the values for the guest with the current values in the database.
                if ($stmt->fetch()) { 
                    echo '<input type="hidden" name="guest_ID" value="' . $guest_ID . '"/>'; 
                    echo '<label for="fname">First Name: </label>'; 
                    echo '<input type="text" name="fname" value="'.$first_name.'"required/><br>'; 
                    echo '<label for="lname">Last Name: </label>'; 
                    echo '<input type="text" name="lname" value="'.$last_name.'"required/><br>'; 
                    echo '<label for="city">City: </label>'; 
                    echo '<input type="text" name="city" value="'.$city.'"required/><br>'; 
                    echo '<label for="street_no">Street: </label>'; 
                    echo '<input type="text" name="street_no" value="'.$street_no.'"required/><br>'; 
                    echo '<label for="pcode">Postal Code: </label>'; 
                    echo '<input type="text" name="pcode" value="'.$postal_code.'"required/><br>'; 
                    echo '<label for="phone_no">Phone Number: </label>'; 
                    echo '<input type="text" name="phone_no" value="'.$phone_no.'"required/><br>'; 
                    echo '<input type="submit" class="pink" value="Update"/>';
                } 
                // Provides a message to the user if the guest does not exist.
                else {
                    echo '<label for="guest_ID"><center>Guest does not exist.</center></label>'; 
                }
                // Close statement and connection.
                $stmt->close(); 
                $mysqli->close();
            ?>

        </form>
    </div>
</body>