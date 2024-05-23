<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $event_id = $_POST['event_id'];

    // Delete event record
    $sql = "DELETE FROM events WHERE event_id=$event_id";

    if ($conn->query($sql) === TRUE) {
        echo "Event record deleted successfully";
        header("Location: viewevents.php");
    } else {
        echo "Error deleting event record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event Record</title>
</head>
<body>
    <h2>Delete Event Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event_id">Select Event to Delete:</label>
        <select name="event_id">
            <?php
            // Fetch event records
            $sql = "SELECT * FROM events";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['event_id'] . "'>" . $row['title'] . $row['venue_id'] . "</option>";
                }
            } else {
                echo "<option value=''>No events available</option>";
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
