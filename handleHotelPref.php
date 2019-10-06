<head>
    <title>Check Hotel Availability</title>
    <link rel="stylesheet" href="formFormat.css">
</head>

<body>
     <!-- Provides a link back to the Home page. -->
    <a href="index.html" class="button">Back to Home</a><br>

    <h1>Select Desired Hotel</h1>
    
    <!-- Directs to the listAvailableRooms.php when the user presses the Check Availability button.
     Uses post as it is more secure than get -->
    <div>
    <form action="listAvailableRooms.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);
            // mysqli connection via user-defined function

            include('./my_connect.php');
            $mysqli = get_mysqli_conn();

            // SQL statement to get a list of the unique hotel names in the chain. Does not need DISTINCT as name is the primary key of the hotel entity.
            $sql = "SELECT name "
                . "FROM hotel "
                . "WHERE chain_name = ? ";

            // Prepared statement, stage 1: prepare.
            $stmt = $mysqli->prepare($sql);

            // Prepared statement, stage 2: bind and execute.
            $chain = $_POST['chain']; 
            $stmt->bind_param('s', $chain); 
            $stmt->execute();

            // Bind result variable.
            $stmt->bind_result($hotel_name); 

            // Initializes the drop-down with the unique hotel names.
            echo '<label for="hotel">Hotel: </label>'; 
            echo '<select name="hotel">'; 

            // Uses a while loop to add values to the drop-down as long as there is a value to fetch.
            while ($stmt->fetch()) {
                printf ('<option>%s</option>', $hotel_name); 
            }
            echo '</select><br>'; 

            // Stores the user's inputs for the start and end date in variables named sDate and eDate respectively.
            echo '<label for="sDate">Start Date (yyyy-mm-dd): </label>'; 
            echo '<input type="date" name="sDate" value="'.$startDate.'" required/><br>';
            echo '<label for="eDate">End Date (yyyy-mm-dd): </label>'; 
            echo '<input type="date" name="eDate" value="'.$endDate.'" required/><br>';

            // Close statement and connection.
            $stmt->close(); 
            $mysqli->close();
        ?>
        <br>
        <input type="submit" class="green" value="Check Availability"/>
    </form>
    </div>

</body>
