<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/kcc.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1000px;
        }

        .form-container, .table-container {
            width: 48%;
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
        input[type="date"],
        input[type="email"] {
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
            text-align: center;
        }

        thead {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Booking Form</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="event_id">Event ID:</label>
                <input type="text" id="event_id" name="event_id" required>

                <input type="submit" value="Book Now">
            </form>
            <button type="button" onclick="location.href='userhome.php';">HOME</button>
        </div>

        <div class="table-container">
            <h2>Event Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Your PHP code to fetch and display events in the table -->
                    <?php
                    // Include database connection
                    require_once "./conn/connection.php";

                    // SQL query to fetch events
                    $sql = "SELECT * FROM events";

                    // Execute query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any events
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . (isset($row['event_id']) ? $row['event_id'] : '') . "</td>";
                            echo "<td>" . (isset($row['title']) ? $row['title'] : '') . "</td>";
                            echo "<td>" . (isset($row['date']) ? $row['date'] : '') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No events found.</td></tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ensure the connection is open here
            require_once "./conn/connection.php";

            // Get form data and sanitize it
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $date = mysqli_real_escape_string($conn, $_POST['date']);
            $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

            // SQL query to insert data into database
            $sql = "INSERT INTO booking (email, date, event_id) VALUES ('$email', '$date', '$event_id')";

            // Execute query
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Booking successful!');</script>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
            }

            // Close connection
            mysqli_close($conn);
        }
        ?>
</body>
</html>
