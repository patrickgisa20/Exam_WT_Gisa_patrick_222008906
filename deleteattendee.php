<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $attendee_id = $_POST['attendee_id'];

    // Delete attendee record
    $sql = "DELETE FROM attendees WHERE attendee_id=$attendee_id";

    if ($conn->query($sql) === TRUE) {
        echo "Attendee record deleted successfully";
        header("Location: viewattendees.php");
    } else {
        echo "Error deleting attendee record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Attendee Record</title>
</head>
<body>
    <h2>Delete Attendee Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="attendee_id">Select Attendee to Delete:</label>
        <select name="attendee_id">
            <?php
            // Fetch attendee records
            $sql = "SELECT * FROM attendees";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['attendee_id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No attendees available</option>";
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
