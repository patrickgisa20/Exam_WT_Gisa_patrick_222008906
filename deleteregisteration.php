<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $registration_id = $_POST['registration_id'];

    // Delete registration record
    $sql = "DELETE FROM registrations WHERE registration_id=$registration_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registration record deleted successfully";
        header("Location: viewregistration.php");
    } else {
        echo "Error deleting registration record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Registration Record</title>
</head>
<body>
    <h2>Delete Registration Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="registration_id">Select Registration to Delete:</label>
        <select name="registration_id">
            <?php
            // Fetch registration records
            $sql = "SELECT * FROM registrations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['registration_id'] . "'>" . $row['user_Name'] . " - " . $row['event_id'] . "</option>";
                }
            } else {
                echo "<option value=''>No registrations available</option>";
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
