<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Admin Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 40px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        header h1 {
            margin: 0;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        main {
            padding-top: 60px; 
            padding-bottom: 60px; 
        }
        header img.logo {
    height: 50px; 
    width: 50px; 
    
    margin-right: 1200px;
}

    </style>
</head>
<body>

    <header>
        <img class="logo" src="images\log.JPG" alt="Logo" width="50" height="30">
        <button type="button" onclick="location.href='adminhome.php';">HOME</button>
        <h1>User and Admin Details</h1>
    </header>

    <main>
        <h2>Admin Details</h2>
        
        <table>
            
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>password</th>
                    
                </tr>
            </thead>
           
            <tbody>
                
                <?php
                    // Database connection
                    require_once "./conn/connection.php";

                    // Fetch admin records from the database
                    $sql = "SELECT * FROM admins";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No admin records found</td></tr>";
                    }

                    // Close the database connection
                    
                ?>
            </tbody>
        </table>

        <h2>User Details</h2>
        <!-- User Details Table -->
        <table>
            <!-- Table Header -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Action</th> <!-- New column for the delete button -->
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                <!-- PHP Script to Fetch and Display User Records -->
                <?php
                    // Database connection
                    require_once "./conn/connection.php";

                    // Fetch user records from the database
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            // Add a delete button for each row
                            echo "<td><form action='deleteuser.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'></form></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No user records found</td></tr>";
                    }
                     
                    // Close the database connection
                    $conn->close();
                ?>
            </tbody>
        </table>
    </main>
 
    <footer>
        <p><marquee>&copy; EVENT MANAGEMENT SYSTEM GISA PATRICK 222008906</marquee></p>
    </footer>
</body>
</html>
