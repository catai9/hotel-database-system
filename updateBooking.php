<head>
  <title>Update Booking</title>
  <link rel="stylesheet" href="messageFormat.css">
</head>

<div>
<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Update Booking</h1>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined 
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to update booking based on number of adults.
        $sql1 = "UPDATE booking "
        . "SET no_adults = ? "
        . "WHERE ID = ?";

        // SQL statement to update booking based on number of children.
        $sql2 = "UPDATE booking "
        . "SET no_child = ? "
        . "WHERE ID = ?";

        // Fetches and stores the required values into variables for later use.
        $bID = $_POST['bid']; 
        $nadult = $_POST['nadult']; 
        $nchild = $_POST['nchild']; 

        // Prepared statement, stage 1: prepare and bind parameters.
        $stmt1 = $mysqli->prepare($sql1);
        $stmt1->bind_param('is', $nadult, $bID); 

        // Executes the first query. If successful, executes the second query. Else, prints an error message.
        if ($stmt1->execute()) { 
            // Prepared statement, stage 1: prepare the next sql statement.
            $stmt2 = $mysqli->prepare($sql2);
            $stmt2->bind_param('is', $nchild, $bID);  

            // Executes the second query. If successful, prints a success message. Else, prints an error message.
            if ($stmt2->execute()) { 
                echo 'Booking ID # ' . $bID . ' successfully updated.';
            }
            else {
                echo 'Update not successful. Please try again'; 
            }

        } 
        else {
            echo 'Update not successful. Please try again'; 
        }

        // Close statement and connection.
        $stmt1->close(); 
        $stmt2->close(); 
        $mysqli->close();
    ?>

</body>
</div>
