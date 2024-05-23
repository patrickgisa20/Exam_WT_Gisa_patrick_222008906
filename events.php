<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items at the top */
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-between; /* Distribute items evenly */
            width: 80%;
            max-width: 1200px;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            margin-right: 20px; /* Add margin between form and tables */
        }

        .table-container {
            width: 400px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left; /* Adjust text alignment */
        }

        thead {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Event Registration</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                
                <label for="venueId">Venue ID:</label>
                <input type="text" id="venueId" name="venueId" required>
                
                <label for="organizerId">Organizer ID:</label>
                <input type="text" id="organizerId" name="organizerId" required>
                
                <input type="submit" value="Register Event">
                <button type="button" onclick="location.href='adminhome.php';">HOME</button>
            </form>
            
            <?php
            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Include database connection
                require_once "./conn/connection.php";

                // Get form data and sanitize it
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $date = mysqli_real_escape_string($conn, $_POST['date']);
                $venueId = mysqli_real_escape_string($conn, $_POST['venueId']);
                $organizerId = mysqli_real_escape_string($conn, $_POST['organizerId']);

                // SQL query to insert data into database
                $sql = "INSERT INTO events (title, date, venue_id, organizer_id) VALUES ('$title', '$date', '$venueId', '$organizerId')";

                // Execute query
                if (mysqli_query($conn, $sql)) {
                echo "<script>alert('event registred  successfully!');</script>";
                } else {
                    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                }

                // Close connection
                
            }
            ?>
        </div>

        <div class="table-container">
            <h2>Venue Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>Venue ID</th>
                        <th>Name</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch and display venues -->
                    <?php
                    // Include database connection
                    require_once "./conn/connection.php";

                    // SQL query to fetch venues
                    $sql = "SELECT * FROM venues";

                    // Execute query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any venues
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . (isset($row['venue_id']) ? $row['venue_id'] : '') . "</td>";
                            echo "<td>" . (isset($row['name']) ? $row['name'] : '') . "</td>";
                            echo "<td>" . (isset($row['location']) ? $row['location'] : '') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No venues found.</td></tr>";
                    }
                    
                    ?>
                </tbody>
            </table>

            <h2>Organizer Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>Organizer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch and display organizers -->
                    <?php
                    // SQL query to fetch organizers
                    $sql = "SELECT * FROM organizers";

                    // Execute query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any organizers
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . (isset($row['organizer_id']) ? $row['organizer_id'] : '') . "</td>";
                            echo "<td>" . (isset($row['name']) ? $row['name'] : '') . "</td>";
                            echo "<td>" . (isset($row['email']) ? $row['email'] : '') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No organizers found.</td></tr>";
                    }

                    // Close connection
                   
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
