<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional CSS for header */
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 15px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<div class="navbar">
        <a href="adminhome.php">Home</a>
    </div>
    
<body>
    
    <div class="container">
        <h2>Venue Registration</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="venueId"></label>
                <input type="hidden" id="venueId" name="venueId" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>

            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="text" id="capacity" name="capacity" required>
            </div>

            <button type="submit">Register</button>
        </form>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include database connection
            require_once "./conn/connection.php";

            // Get form data and sanitize it
            $venueId = mysqli_real_escape_string($conn, $_POST['venueId']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $location = mysqli_real_escape_string($conn, $_POST['location']);
            $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);

            // SQL query to insert data into database
            $sql = "INSERT INTO venues (venue_id, name, location, capacity) VALUES ('$venueId', '$name', '$location', '$capacity')";

            // Execute query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Venue information submitted successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
