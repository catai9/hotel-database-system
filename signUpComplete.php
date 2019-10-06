<head>
  <title>Sign Up!</title>
  <link rel="stylesheet" href="messageFormat.css">
</head>

<div>
<body>
<!-- Provides a link back to the Home page. -->
<br><center><a href="index.html" class="button">Back to Home</a></br></center>
  <h1>Sign Up!</h1>
    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to insert the user inputted values into the guest table.
        $sql = "INSERT INTO guest "
        . "VALUES (null, ?, ?, ?, ?, ?, ?) ";

        //SQL statement 2: finds the guest ID for that guest.
        $sql2 = "SELECT ID "
        . "FROM guest "
        . "WHERE first_name = ? and last_name = ? and city = ? and street_no = ? and postal_code = ? and phone_no = ? ";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Fetches the needed values from the previous file. 
        $fname = $_POST['fname']; 
        $lname = $_POST['lname']; 
        $city = $_POST['city']; 
        $street = $_POST['street']; 
        $pcode = $_POST['pcode']; 
        $phone = $_POST['phone']; 

        // Prepared statement, stage 2: bind and execute
        $stmt->bind_param('ssssss', $fname, $lname, $city, $street, $pcode, $phone); 

        // If statement executes successfully, then prints a success message to the user.
        if($stmt->execute()){
            echo '<p>' . $fname . ' ' . $lname . ' added successfully!</p>';
            //Prepare second sql statement to provide user with the ID of the newly inserted guest.
            $stmt2 = $mysqli->prepare($sql2);
            $stmt2->bind_param('ssssss', $fname, $lname, $city, $street, $pcode, $phone); 
            $stmt2->execute();
            $stmt2->bind_result($guest_ID); 
            // Checks to make sure that the ID can be fetched. If it cannot, then prints a message to the user to let them know.
            if ($stmt2->fetch()) { 
                echo '<p> Guest ID: ' . $guest_ID . '.</p>';
             } 
            else {
                echo '<p>Guest not inserted. Please try again.</p>'; 
            }

        }
        // Prints message to the user if the guest was not inserted into the table.
        else {
            echo '<p>Guest not inserted. Please try again.</p>';
        }

        // Close statement and connection.
        $stmt->close(); 
        $stmt2-> close();
        $mysqli->close();

    ?>


</body>
</div>
