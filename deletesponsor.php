<?php
require_once "./conn/connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $sponsor_id = $_POST['sponsor_id'];

    // Delete sponsor record
    $sql = "DELETE FROM sponsors WHERE sponsor_id=$sponsor_id";

    if ($conn->query($sql) === TRUE) {
        echo "Sponsor record deleted successfully";
        header("Location: viewsponsor.php");
    } else {
        echo "Error deleting sponsor record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Sponsor Record</title>
</head>
<body>
    <h2>Delete Sponsor Record</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="sponsor_id">Select Sponsor to Delete:</label>
        <select name="sponsor_id">
            <?php
            // Fetch sponsor records
            $sql = "SELECT * FROM sponsors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['sponsor_id'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>No sponsors available</option>";
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
