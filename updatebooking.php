<?php
require_once "./conn/connection.php";

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the submitted form data
    $booking_id = $conn->real_escape_string($_POST['booking_id']);
    $email = $conn->real_escape_string($_POST['email']);
    $date = $conn->real_escape_string($_POST['date']);
    $event_id = $conn->real_escape_string($_POST['event_id']);

    // Update the booking record in the database
    $update_sql = "UPDATE booking SET email='$email', date='$date', event_id='$event_id' WHERE booking_id='$booking_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewbooking.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['booking_id'])) {
    $booking_id = $conn->real_escape_string($_GET['booking_id']);
    $select_sql = "SELECT * FROM booking WHERE booking_id='$booking_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the booking data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $email = $row['email'];
        $date = $row['date'];
         $event_id = $row['event_id'];
    } else {
        echo "Booking not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
</head>
<body>
    <h2>Booking Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="booking_id">Enter Booking ID:</label>
        <input type="text" id="booking_id" name="booking_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($booking_id)) : ?>
        <h1>Update Booking Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
           
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>
             <label for="event_id">EVENT ID:</label>
            <input type="number" id="event_id" name="event_id" value="<?php echo $event_id; ?>" required><br><br>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
