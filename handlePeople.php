<head>
  <title>Update Booking</title>
    <link rel="stylesheet" href="formFormat.css">
</head>

<body>
    
    <!-- Provides a link back to the Home page. -->
    <a href="index.html" class="button">Back to Home</a><br>
    
    <h1>Update Booking</h1>
    
    <div>
        <!-- Directs to the updateBooking.php when the user presses the Continue button.
         Uses post as it is more secure than get -->
        <form action="updateBooking.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);

            // mysqli connection via user-defined function
            include('./my_connect.php');
            $mysqli = get_mysqli_conn();

            // SQL statement to get the current number of adults and children for this booking.
            $sql = "SELECT no_adults, no_child "
            . "FROM booking "
            . "WHERE ID = ?";

            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);
            // Prepared statement, stage 2: bind and execute 
            $bID = $_POST['bID']; 
            $stmt->bind_param('s', $bID);
            $stmt->execute();

            // Binds the results to the $nadult and $nchild variables respectively.
            $stmt->bind_result($nadult,$nchild);

            // If there are values to fetch, i.e. the booking exists, then initializes the input fields to the current database values.
            if ($stmt->fetch()) { 
                // Hidden input type to pass the booking ID to the next file without allowing users to edit it.
                echo '<input type="hidden" name="bid" value="' . $bID . '"/>'; 
                echo '<label for="nadult">Number of Adult(s): </label>';  
                echo '<input type="number" name="nadult" value="'.$nadult.'"/><br>'; 
                echo '<label for="nchild">Number of Child(ren): </label>';  
                echo '<input type="number" name="nchild" value="'.$nchild.'"/><br>'; 
                // Continue button only appears if the booking exists in the system.
                echo '<input type="submit" name="submit" class="teal" value="Continue"/>';
            } 
            // Message to display for the user if the booking does not exist in the system.
            else {
                echo '<center>Booking not found in the database. Please try again.</center>'; 
            }

            // Close statement and connection. 
            $stmt->close(); 
            $mysqli->close();
        ?>

        </form>
    </div>

</body>
