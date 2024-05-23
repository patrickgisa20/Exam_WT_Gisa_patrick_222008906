<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Organizers Information</title>
    <style>
        
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
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

        /* CSS styles for header and footer */
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

          header img.logo {
            height: 50px; 
            width: 150px; 
            margin-right: 1200px;
            margin-left: auto; 
            border-radius: 5px; 
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); 
        }

        header nav {
            float: middle;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <img class="logo" src="images\log.JPG" alt="Organizers Logo" width="150" height="50">
        </div>
    </header>

    <h2>Organizers Information</h2>

    <table >
        <thead>
            <tr>
                <th>Organizer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>phonenumber</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Database connection
                require_once "./conn/connection.php";

                // Fetch organizer records from the database
                $sql = "SELECT * FROM organizers";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . (isset($row['organizer_id']) ? $row['organizer_id'] : '') . "</td>";
                        echo "<td>" . (isset($row['name']) ? $row['name'] : '') . "</td>";
                        echo "<td>" . (isset($row['email']) ? $row['email'] : '') . "</td>";
                        echo "<td>" . (isset($row['phonenumber']) ? $row['phonenumber'] : '') . "</td>";
                        echo "<td><a href='updateorganizer.php'>update</a></td>"; // Update link
                echo "<td><a href='deleteorganizer.php'>Delete</a></td>"; // Delete link
                echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }

                // Close the database connection
                $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Button to go back to the form -->
    <button type="button" onclick="location.href='adminhome.php';">Go Back</button>
    
    <footer>
        <p><marquee>&copy; EVENT MANAGEMENT SYSTEM GISA PATRICK 222008906</marquee></p>
    </footer>
</body>
</html>
