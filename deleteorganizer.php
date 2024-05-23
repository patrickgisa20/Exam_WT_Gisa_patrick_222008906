<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $organizer_id = $_POST['organizer_id'];

    // Delete organizer record
    $sql = "DELETE FROM organizers WHERE organizer_id=$organizer_id";

    if ($conn->query($sql) === TRUE) { echo "Organizer record deleted
    successfully"; header("Location: vieworganizer.php"); } else{ echo "Error
    deleting organizer record: " . $conn->error; } }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Organizer Record</title>
</head>
<body>
    <h2>Delete Organizer Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="organizer_id">Select Organizer to Delete:</label>
        <select name="organizer_id">
            <?php
            // Fetch organizer records
            $sql = "SELECT * FROM organizers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['organizer_id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No organizers available</option>";
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
