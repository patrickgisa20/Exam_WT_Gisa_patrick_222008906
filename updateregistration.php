<?php
require_once "./conn/connection.php";

// Check if the form is submitted for registration update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_registration'])) {
    // Retrieve the submitted form data
    $registration_id = $conn->real_escape_string($_POST['registration_id']);
    $event_id = $conn->real_escape_string($_POST['event_id']);
    $attendee_id = $conn->real_escape_string($_POST['attendee_id']);
    $description = $conn->real_escape_string($_POST['description']);

    // Check if the provided event_id exists in the events table
    $event_check_sql = "SELECT * FROM events WHERE event_id='$event_id'";
    $event_check_result = $conn->query($event_check_sql);
    if ($event_check_result->num_rows != 1) {
        echo "Error: Event with ID $event_id does not exist.";
        exit;
    }

    // Check if the provided attendee_id exists in the attendees table
    $attendee_check_sql = "SELECT * FROM attendees WHERE attendee_id='$attendee_id'";
    $attendee_check_result = $conn->query($attendee_check_sql);
    if ($attendee_check_result->num_rows != 1) {
        echo "Error: Attendee with ID $attendee_id does not exist.";
        exit;
    }

    // Update the registration record in the database
    $update_sql = "UPDATE registrations SET  event_id='$event_id', attendee_id='$attendee_id', description='$description' WHERE registration_id='$registration_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Registration updated successfully');</script>";
        echo "<script>window.location.href = 'viewregistration.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating registration: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['registration_id'])) {
    $registration_id = $conn->real_escape_string($_GET['registration_id']);
    $select_sql = "SELECT * FROM registrations WHERE registration_id='$registration_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the registration data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $event_id = $row['event_id'];
        $attendee_id = $row['attendee_id'];
        $description = $row['description'];
    } else {
        echo "Registration not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Registration</title>
</head>
<body>
    <h2>Registration Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="registration_id">Enter Registration ID:</label>
        <input type="text" id="registration_id" name="registration_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($registration_id)) : ?>
        <h1>Update Registration</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
            <label for="event_id">Event ID:</label><br>
            <input type="text" id="event_id" name="event_id" value="<?php echo $event_id; ?>" required><br><br>
            <label for="attendee_id">Attendee ID:</label><br>
            <input type="text" id="attendee_id" name="attendee_id" value="<?php echo $attendee_id; ?>" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required><?php echo $description; ?></textarea><br><br>
            <button type="submit" name="update_registration">Update Registration</button>
        </form>
    <?php endif; ?>

</body>
</html>

