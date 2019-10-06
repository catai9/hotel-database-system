<head>
    <title>Delete Guest</title>
    <link rel="stylesheet" href="messageFormat.css">
</head>

<div>
<body>
    <!-- Provides a link back to the Home page. -->
    <a href="index.html" class="button">Back to Home</a> <br>

    <h1>Delete Guest Information</h1>
    
    <?php
    // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function.
        include('./my_connect.php');
        // Connection 1 is used for the first sql.
        $mysqli = get_mysqli_conn();
        // Connection 2 is used for the second sql.
        $mysqli2 = get_mysqli_conn();

        // SQL statements.
        // SQL #1: Checks if guest is in table as phpmyadmin will approve deletions even if ID not in table.
        $sql = "SELECT ID "
        . "FROM guest "
        . "WHERE ID = ? ";

        // SQL #2: Deletes the guest if the guest is in the table.
        $sql2 = "DELETE FROM guest "
        . "WHERE ID = ? ";

        // Prepared statement, stage 1: prepare the first sql query.
        $stmt = $mysqli->prepare($sql);

        // Prepared statement, stage 2: bind and execute the first sql query.
        $guest_ID = $_POST['guest_ID']; 
        $stmt->bind_param('i', $guest_ID);
        $stmt->execute();
        $stmt->bind_result($guest_ID2);

        // Checks that the guest is in the database before the deletion query is executed. Displays a message if the guest is not in the database.
        if($stmt->fetch()){
            // Prepared statement, stage 1: prepare the second sql query.
            $stmt2 = $mysqli2->prepare($sql2);
            // Prepared statement, stage 2: bind and execute the second sql query.
            $stmt2->bind_param('i', $guest_ID2); 
            // If statement checks that the query ran successfully. Displays a message if there is an issue in deletion.
            if ($stmt2->execute()) { 
                echo '<p>Guest ' . $guest_ID2 . ' deleted successfully!</p>';
             } 
            else {
                echo '<p>Guest not deleted. Please try again.</p>'; 
            }
        }
        else {
            echo '<p>Guest does not exist. Please try a different guest ID.</p>';
        }

        // Close statement and connection.
        $stmt->close(); 
        $stmt2->close(); 
        $mysqli->close();
        $mysqli2->close();

    ?>

</body>
</div>
