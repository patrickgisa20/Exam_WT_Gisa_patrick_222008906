<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
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

        .form-group input, .form-group textarea {
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
<body>
    <div class="navbar">
        <a href="adminhome.php">Home</a>
    </div>

    <div class="container">
        <h2>Sponsor Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="sponsorId">Sponsor ID:</label>
                <input type="text" id="sponsorId" name="sponsorId" required>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <button type="submit" name="submit">Register</button>
        </form>
        
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Include database connection
            require_once "./conn/connection.php";

            // Get form data and sanitize it
            $sponsorId = mysqli_real_escape_string($conn, $_POST['sponsorId']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            // SQL query to insert data into database
            $sql = "INSERT INTO sponsors (sponsor_id, name, email, phonenumber, description) VALUES ('$sponsorId', '$name', '$email', '$phoneNumber', '$description')";

            // Execute query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Sponsor registration successful!');</script>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
