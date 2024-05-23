<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration to attend an event</title>
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
            max-width: 1200px;
        }

        .form-container, .table-container {
            width: 48%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
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

        .event-table, .attendee-table {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Event Registration</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="eventId">Event ID:</label>
                    <input type="text" id="eventId" name="eventId" required>
                </div>

                <div class="form-group">
                    <label for="attendeeId">Attendee ID:</label>
                    <input type="text" id="attendeeId" name="attendeeId" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <button type="submit" name="submit">Register</button>
            </form>
            <button type="button" onclick="location.href='userhome.php';">HOME</button>

            <?php
            // Check if the form is submitted
            include('conn/connection.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Include database connection
                require_once "./conn/connection.php";

                // Get form data and sanitize it
                $eventId = mysqli_real_escape_string($conn, $_POST['eventId']);
                $attendeeId = mysqli_real_escape_string($conn, $_POST['attendeeId']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);

                // SQL query to insert data into database
                $sql = "INSERT INTO registrations (event_id, attendee_id, description) VALUES ('$eventId', '$attendeeId', '$description')";

                // Execute query
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Registration successful!');</script>";
                } else {
                    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                }
            }
            ?>
        </div>

        <div class="table-container">
            <div class="event-table">
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

            <div class="attendee-table">
                <h2>Attendee Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Attendee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Your PHP code to fetch and display attendees in the table -->
                        <?php
                        // SQL query to fetch attendees
                        $sql = "SELECT * FROM attendees";

                        // Execute query
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any attendees
                        if (mysqli_num_rows($result) > 0) {
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . (isset($row['attendee_id']) ? $row['attendee_id'] : '') . "</td>";
                                echo "<td>" . (isset($row['name']) ? $row['name'] : '') . "</td>";
                                echo "<td>" . (isset($row['email']) ? $row['email'] : '') . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No attendees found.</td></tr>";
                        }

                        // Close the connection
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
