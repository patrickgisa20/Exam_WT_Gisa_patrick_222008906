<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Submission</title>
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

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        textarea,
        select {
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

        .event-table, .venue-table {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Feedback Submission</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="eventId">Event ID:</label>
                <input type="text" id="eventId" name="eventId" required>
                
                <label for="attendeeId">Attendee ID:</label>
                <input type="text" id="attendeeId" name="attendeeId" required>
                
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="good">Good</option>
                    <option value="bad">Bad</option>
                </select>
                
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" required></textarea>
                
                <input type="submit" value="Submit Feedback">
                <button type="button" onclick="location.href='userhome.php';">HOME</button>
            </form>
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

            <div class="venue-table">
                <h2>Venue Table</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Venue ID</th>
                            <th>Venue Name</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Your PHP code to fetch and display venues in the table -->
                        <?php
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

                        // Do not close the connection here
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ensure the connection is open here
        require_once "./conn/connection.php";

        // Get form data and sanitize it
        $eventId = mysqli_real_escape_string($conn, $_POST['eventId']);
        $attendeeId = mysqli_real_escape_string($conn, $_POST['attendeeId']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        // SQL query to insert data into database
        $sql = "INSERT INTO feedback (event_id, attendee_id, rating, comment) VALUES ('$eventId', '$attendeeId', '$rating', '$comment')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Feedback submitted successfully!');</script>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
        }

        // Close connection after all operations are done
        mysqli_close($conn);
    }
    ?>
</body>
</html>
