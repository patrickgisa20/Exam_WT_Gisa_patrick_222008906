<?php
require_once "./conn/connection.php";

// Check if the form is submitted for venue update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_venue'])) {
    // Retrieve the submitted form data
    $venue_id = $conn->real_escape_string($_POST['venue_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $location = $conn->real_escape_string($_POST['location']);
    $capacity = $conn->real_escape_string($_POST['capacity']);

    // Update the venue record in the database
    $update_sql = "UPDATE venues SET name='$name', location='$location', capacity='$capacity' WHERE venue_id='$venue_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Venue updated successfully');</script>";
        echo "<script>window.location.href = 'viewvenue.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating venue: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['venue_id'])) {
    $venue_id = $conn->real_escape_string($_GET['venue_id']);
    $select_sql = "SELECT * FROM venues WHERE venue_id='$venue_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the venue data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $name = $row['name'];
        $location = $row['location'];
        $capacity = $row['capacity'];
    } else {
        echo "Venue not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Venue</title>
</head>
<body>
    <h2>Venue Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="venue_id">Enter Venue ID:</label>
        <input type="text" id="venue_id" name="venue_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($venue_id)) : ?>
        <h1>Update Venue</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location" value="<?php echo $location; ?>" required><br><br>
            <label for="capacity">Capacity:</label><br>
            <input type="text" id="capacity" name="capacity" value="<?php echo $capacity; ?>" required><br><br>
            <button type="submit" name="update_venue">Update Venue</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
