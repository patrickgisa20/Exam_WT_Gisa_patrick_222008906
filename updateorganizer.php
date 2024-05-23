<?php
require_once "./conn/connection.php";

// Check if the form is submitted for organizer update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_organizer'])) {
    // Retrieve the submitted form data
    $organizer_id = $conn->real_escape_string($_POST['organizer_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);

    // Update the organizer record in the database
    $update_sql = "UPDATE organizers SET name='$name', email='$email', phonenumber='$phonenumber' WHERE organizer_id='$organizer_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Organizer updated successfully');</script>";
        echo "<script>window.location.href = 'vieworganizer.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating organizer: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['organizer_id'])) {
    $organizer_id = $conn->real_escape_string($_GET['organizer_id']);
    $select_sql = "SELECT * FROM organizers WHERE organizer_id='$organizer_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the organizer data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phonenumber = $row['phonenumber'];
    } else {
        echo "Organizer not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Organizer</title>
</head>
<body>
    <h2>Organizer Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="organizer_id">Enter Organizer ID:</label>
        <input type="text" id="organizer_id" name="organizer_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($organizer_id)) : ?>
        <h1>Update Organizer</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="organizer_id" value="<?php echo $organizer_id; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
            <label for="phonenumber">Phone Number:</label><br>
            <input type="tel" id="phonenumber" name="phonenumber" value="<?php echo $phonenumber; ?>" required><br><br>
            <button type="submit" name="update_organizer">Update Organizer</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
