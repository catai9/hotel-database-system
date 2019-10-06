<head>
  <title>Check Hotel Availability</title>
 <link rel="stylesheet" href="messageFormat.css">
</head>

<div>
<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Available Rooms</h1>
    <?php
        // Enable error logging: 
        error_reporting(E_ALL ^ E_NOTICE);
        // mysqli connection via user-defined function
        include('./my_connect.php');
        $mysqli = get_mysqli_conn();

        // SQL statement to get the number of available rooms of a certain type.
        $sql = "SELECT count(*) "
            . "FROM room "
            . "WHERE suite_no not in (SELECT suite_no "
                . "FROM books "
                . "WHERE hotel_name = ? and booking_ID in (SELECT ID "
                    . "FROM booking " 
                    . "WHERE start_date >= ? and end_date <= ?)) "
            . "and hotel_name = ? "
            . "and classification = ? ";

        // Prepared statement, stage 1: prepare
        $stmt = $mysqli->prepare($sql);

        // Fetches and initializes needed variables.
        $hotel_name = $_POST['hotel']; 
        $sDate = $_POST['sDate'];
        $eDate = $_POST['eDate'];
    
        // Creates an array variable to store the unique room types in the database.
        $type=array();
        
        // mysqli2 connection for the second SQL statement.
        $mysqli2 = get_mysqli_conn();

        // SQL statement to get all different types of rooms. Does not need DISTINCT as classification is the primary key of the type entity.
        $sqlTypes = "SELECT classification "
            . "FROM type ";

        // Prepared statement, stage 1: prepare
        $stmtTypes = $mysqli2->prepare($sqlTypes);
    
        // Prepared statement, stage 2: execute 
        $stmtTypes->execute();

        // Bind result variables.
        $stmtTypes->bind_result($classification); 

        // Uses a while loop to initialize the type array with the different room types.
        while ($stmtTypes->fetch()) {
            $type[] = $classification;
        }
    
        echo 'Number of available rooms in ' . $hotel_name . ' for '.$sDate . ' to ' . $eDate .' of type: <br>';

        // Loop through the type arrays and print the available rooms under each type.
        for ($index = 0; $index < count($type); $index++){
             // Prepared statement, stage 2: bind and execute 
            $stmt->bind_param('sssss', $hotel_name, $sDate, $eDate, $hotel_name, $type[$index]); 
            $stmt->execute();
            // Bind result variables 
            $stmt->bind_result($no_rooms); 
            
            // Fetches the value from the SQL statement and prints the number of available rooms for each type.
            if ($stmt->fetch()) { 
                echo $type[$index].': ' . $no_rooms . ' rooms <br>'; 
            } 
            // If there are no rooms for the type, prints 0.
            else {
                echo $type .' : 0 rooms'; 
            }
        }   
                
        // Close statement and connection. 
        $stmt->close(); 
        $mysqli->close();
    ?>

</body>
</div>
