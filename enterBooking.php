<head>
    <title>Update Booking</title>
    <link rel="stylesheet" href="formFormat.css">
</head>

<body>
    <!-- Provides a link back to the Home page. -->
    <br><a href="index.html" class="button">Back to Home</a>

    <h1>Update Booking</h1>
    
    <!-- Directs to the handlePeople.php when the user presses the Continue button.
     Uses post as it is more secure than get. -->
    <div>
        <form action="handlePeople.php" method="post">
            <p>Enter Booking ID: </p>
            <!-- Stores the user input of booking ID into a variable named bID. -->
            <input type="text" name="bID" required/><br>
            <input type="submit" name="submit" class="teal" value="Continue"/>

        </form>

        
    </div>
</body>
