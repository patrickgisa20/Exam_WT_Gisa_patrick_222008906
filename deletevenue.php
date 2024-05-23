<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $venue_id = $_POST['venue_id'];

    // Delete venue record
    $sql = "DELETE FROM venues WHERE venue_id=$venue_id";

    if ($conn->query($sql) === TRUE) {
        echo "Venue record deleted successfully";
        header("Location: viewvenue.php");
    } else {
        echo "Error deleting venue record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Venue Record</title>
</head>
<body>
    <h2>Delete Venue Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="venue_id">Select Venue to Delete:</label>
        <select name="venue_id">
            <?php
            // Fetch venue records
            $sql = "SELECT * FROM venues";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['venue_id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No venues available</option>";
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
