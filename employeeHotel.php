<head>
  <title>Choose Hotel and Employee</title>
  <link rel="stylesheet" href="formFormat.css">
</head>

<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Choose Hotel and Employee</h1>
    
    <!-- Directs to the employeeStats.php when the user presses the Continue button. 
        Uses post as it is more secure than get. -->
    <div>
    <form action="employeeStats.php" method="post">

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);
            // mysqli connection via user-defined function

            include('./my_connect.php');
            $mysqli = get_mysqli_conn();

            // SQL statement to select the hotel names that belong to a specific chain. DISTINCT not used as name is primary key of the hotel entity.
            $sql = "SELECT name "
            . "FROM hotel "
            . "WHERE chain_name = ?";

            // Prepared statement, stage 1: prepare
            $stmt = $mysqli->prepare($sql);

            //Prepared statement, stage 2: bind and execute 
            $name = $_POST['chain']; 
            $stmt->bind_param('s', $name); 
            $stmt->execute();
        
            //Binds the results of the query into a variable.
            $stmt->bind_result($hotel_name);

            // Stores the value of the selected hotel in a variable named hotel_name.
            echo '<label for="hotel_name">Choose a Hotel: </label>'; 
            echo '<select name="hotel_name">'; 
            
            // Adds options to the dropdown menu as long as there is a statement to fetch.
            while ($stmt->fetch()) {
                printf ('<option>%s</option>', $hotel_name); 
            }
            echo '</select><br>'; 
            
            // Populates a dropdown with all the types of employees and includes All as an option.
            // Does not use a sql query to populate as the types are reflected in separate tables due to specialization of the employee entity.
            echo '<label for="emp_type">Choose a Type of Employee: </label>'; 
            // Stores the value the user selected in a variable named emp_type.
            echo '<select name="emp_type">';
            printf ('<option>Manager</option>', manager); 
            printf ('<option>Maintenance</option>', maintenance); 
            printf ('<option>Front Desk</option>', front_desk); 
            printf ('<option>All</option>', all); 

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
