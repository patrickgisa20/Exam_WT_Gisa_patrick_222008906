<?php
require_once "./conn/connection.php";

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the submitted form data
    $event_id = $conn->real_escape_string($_POST['event_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $date = $conn->real_escape_string($_POST['date']);

    // Update the event record in the database
    $update_sql = "UPDATE events SET title='$title', date='$date' WHERE event_id='$event_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewevents.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['event_id'])) {
    $event_id = $conn->real_escape_string($_GET['event_id']);
    $select_sql = "SELECT * FROM events WHERE event_id='$event_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the event data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $title = $row['title'];
        $date = $row['date'];
    } else {
        echo "Event not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
</head>
<body>
    <h2>Event Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event_id">Enter Event ID:</label>
        <input type="text" id="event_id" name="event_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($event_id)) : ?>
        <h1>Update Event Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <label for="title">Event Name:</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br><br>
            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
