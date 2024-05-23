<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $feedback_id = $_POST['feedback_id'];

    // Delete feedback record
    $sql = "DELETE FROM feedback WHERE feedback_id=$feedback_id";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback record deleted successfully";
        header("Location: viewfeedback.php");
    } else {
        echo "Error deleting feedback record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Feedback Record</title>
</head>
<body>
    <h2>Delete Feedback Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="feedback_id">Select Feedback to Delete:</label>
        <select name="feedback_id">
            <?php
            // Fetch feedback records
            $sql = "SELECT * FROM feedback";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['feedback_id'] . "'>" . $row['event_id'] . " - " . $row['comment'] . "</option>";
                }
            } else {
                echo "<option value=''>No feedback available</option>";
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
