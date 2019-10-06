<head>
  <title>Employee Salary Statistics</title>
  <link rel="stylesheet" href="messageFormat.css">
</head>


<body>
    <!-- Provides a link back to the Home page. -->
    <br><center><a href="index.html" class="button">Back to Home</a></br></center>
    <h1>Employee Salary Statistics</h1>
    <div>
    <form>

        <?php
            // Enable error logging: 
            error_reporting(E_ALL ^ E_NOTICE);
        
            // mysqli connection via user-defined function
            include('./my_connect.php');
        
            // Fetches the required information from the previous files.
            $hotel_name = $_POST['hotel_name'];
            $type = $_POST['emp_type'];
        
            // Uses conditional statements to initialize the SQL statement based on the desired type of employee.
            if ($type == 'Manager'){
                $sql = "SELECT avg(salary), avg(hours_per_week), max(salary), min(salary) "
                . "FROM employee natural join manager "
                . "WHERE hotel_name = ? ";
            }
            if ($type == 'Maintenance'){
                $sql = "SELECT avg(salary), avg(hours_per_week), max(salary), min(salary) "
                . "FROM employee natural join maintenance "
                . "WHERE hotel_name = ? ";
            }
            if ($type == 'Front Desk'){
                $sql = "SELECT avg(salary), avg(hours_per_week), max(salary), min(salary) "
                . "FROM employee natural join front_desk "
                . "WHERE hotel_name = ? ";
            }
            if ($type == 'All'){
                $sql = "SELECT avg(salary), avg(hours_per_week), max(salary), min(salary) "
                . "FROM employee "
                . "WHERE hotel_name = ? ";
            }

            // Prepared statement, stage 1: prepare
            $mysqli = get_mysqli_conn(); 
            $stmt = $mysqli->prepare($sql);
            
            // Binds the parameters and executes the statement.
            $stmt->bind_param('s', $hotel_name);
            $stmt->execute();

            $stmt->bind_result($avg_salary, $avg_hours, $max_salary, $min_salary);
            
            // Prints the desired statistics for the selected employee type (or all). 
            if ($stmt->fetch()){
                printf('Average salary of %s employees: $%.2f <br>', $type, $avg_salary);
                printf('Average hours/week of %s employees: %.2f hours<br>', $type, $avg_hours);
                printf('Maximum salary of %s employees: $%.2f <br>', $type, $max_salary);
                printf('Minimum salary of %s employees: $%.2f <br>', $type, $min_salary);
            }
            // Else statement to display an error message in the event of any errors.
            else {
                echo 'Error occurred. Please try again.';
            }
            // Close statement and connection.
            $stmt->close(); 
            $mysqli->close();
        ?>

    </form>
    </div>

</body>
