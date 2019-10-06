<head>
  <title>Check Hotel Availability</title>
<link rel="stylesheet" href="formFormat.css">
</head>

<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Choose Desired Hotel Chain</h1>
    
    <!-- Directs to the handleHotelPref.php when the user presses the Continue button. 
     Uses post as it is more secure than get -->
    <div>
    <form action="handleHotelPref.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);
            // mysqli connection via user-defined function
            include ('./my_connect.php');
            $mysqli = get_mysqli_conn();

            // SQL statement to get the chain names from the database. Does not need DISTINCT as name is the primary key of the chain entity.
            $sql = "SELECT name "
                . "FROM chain";

            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);

            // Prepared statement, stage 2: execute
            $stmt->execute();

            // Bind result variables 
            $stmt->bind_result($chain_name); 

            // Initializes the drop-down with the unique chain names. 
            echo '<label for="chain">Hotel Chain: </label>'; 
            echo '<select name="chain">'; 

            // Uses a while loop to add options to the drop down as long as there is still a chain to be fetched.
            while ($stmt->fetch()) {
                printf ('<option>%s</option>', $chain_name); 
            }

            echo '</select><br>'; 

            // Close statement and connection.
            $stmt->close(); 
            $mysqli->close();
        ?>

        <br>
        <input type="submit" class="green" value="Continue"/>

    </form>
    </div>

</body>
