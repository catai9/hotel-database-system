<head>
  <title>Choose Hotel Chain</title>
  <link rel= "stylesheet" href="formFormat.css">
</head>

<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Choose Hotel Chain</h1>

    <!-- Directs to the employeeHotel.php when the user presses the Continue button. 
        Uses post as it is more secure than get. -->
    <div>
    <form action="employeeHotel.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);
        
            // mysqli connection via user-defined function
            include ('./my_connect.php');
            $mysqli = get_mysqli_conn();
            
            // SQL statement to get the names of the various chains in the database. DISTINCT not used as name is a primary key of the chain entity.
            $sql = "SELECT name " 
                . "FROM chain ";
        
            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);
        
            // Prepared statement, stage 2: execute
            $stmt->execute();
        
            // Bind result to a variable for future use.
            $stmt->bind_result($name);

            // Stores the user selected value in the dropdown in a variable.
            echo '<label for="chain">Choose a Hotel Chain: </label>'; 
            echo '<select name="chain">'; 
            
            // Uses a while loop to add values into the dropdown as long as there is still a value to be fetched.
            while ($stmt->fetch()) {
                printf ('<option>%s</option>', $name); 
            }
            echo '</select><br>'; 

            // Close statement and connection.
            $stmt->close(); 
            $mysqli->close();

        ?>

        <br>
        <input type="submit" class="blue" value="Continue"/>
        </br>
    </form>
    </div>


</body>
