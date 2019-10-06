<head>
  <title>See Event Booking for Large Groups</title>
  <link rel="stylesheet" href="messageFormat.css">
</head>

<div>
<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Possible Hotels</h1>

    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);

        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to get the hotel names of all hotels that have a total room capacity greater or equal to than the desired number of people.
        $sql = "SELECT DISTINCT hotel_name "
        . "FROM room natural join type natural join hotel "
        . "GROUP BY hotel_name "
        . "HAVING SUM(capacity) >= ?";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Prepared statement, stage 2: bind and execute.
        $numPeople = $_GET['numPeople']; 
        $stmt->bind_param('i', $numPeople); 
        $stmt->execute();

        // Binds the results of the query into a variable.
        $stmt->bind_result($hotel_name);

        // Uses a list format to list the potential hotels.
        echo '<ul>';

        // Fetches the result of the SQL query. Uses a do while loop as the fetch() is executed in the if statement.
        if ($stmt->fetch()) { 
            do {
                printf('<li>%s</li>', $hotel_name);
            } while($stmt->fetch());

        } 
        // Prints a message to the user if there is no hotel with a total room capacity greater than or equal to the desired number.
        else {
            echo 'No hotels have a total room capacity greater than ' . $numPeople; 
        }
        echo '</ul>';

        // Close statement and connection. 
        $stmt->close(); 
        $mysqli->close();

    ?>

</body>
</div>
