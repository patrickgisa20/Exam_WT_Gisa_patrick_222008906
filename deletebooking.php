<?php
require_once "./conn/connection.php";

// Check if form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $booking_id = $_POST['booking_id'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("DELETE FROM booking WHERE booking_id=?");
    $stmt->bind_param("i", $booking_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Booking record deleted successfully";
        // Redirect to viewbookings.php
        header("Location: viewbooking.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error deleting booking record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Booking Record</title>
</head>
<body>
    <h2>Delete Booking Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="booking_id">Select Booking to Delete:</label>
        <select name="booking_id">
            <?php
            // Fetch booking records
            $sql = "SELECT * FROM booking";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['booking_id'] . "'>" . $row['email'] . " - Event ID: " . $row['event_id'] . "</option>";
                }
            } else {
                echo "<option value=''>No bookings available</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
