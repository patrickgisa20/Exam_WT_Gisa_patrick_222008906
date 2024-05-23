<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Information</title>
       <link rel="stylesheet" href="style.css">
       <style>
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
        <h2>Organizer Information</h2>
        <form action="organizer.php" method="post">
            <div class="form-group">
                <label for="organizerId">Organizer ID:</label>
                <input type="text" id="organizerId" name="organizerId" required>
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
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    // PHP code to handle form submission and database insertion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $organizerId = $_POST['organizerId'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        
        require_once "./conn/connection.php";

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO organizers (organizer_id, name, email, phonenumber) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $organizerId, $name, $email, $contact);

        // Execute the statement
        $stmt->execute();

        // Close statement and database connection
        $stmt->close();
        $conn->close();
echo "<script>alert('Organizer information submitted successfully!');</script>";
  
    }
    ?>
</body>
</html>
