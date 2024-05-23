<?php
require_once "./conn/connection.php";

// Check if the form is submitted for sponsor update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_sponsor'])) {
    // Retrieve the submitted form data
    $sponsor_id = $conn->real_escape_string($_POST['sponsor_id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);
    $description = $conn->real_escape_string($_POST['description']);

    // Update the sponsor record in the database
    $update_sql = "UPDATE sponsors SET name='$name', email='$email', phonenumber='$phonenumber', description='$description' WHERE sponsor_id='$sponsor_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Sponsor updated successfully');</script>";
        echo "<script>window.location.href = 'viewsponsors.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating sponsor: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['sponsor_id'])) {
    $sponsor_id = $conn->real_escape_string($_GET['sponsor_id']);
    $select_sql = "SELECT * FROM sponsors WHERE sponsor_id='$sponsor_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the sponsor data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phonenumber = $row['phonenumber'];
        $description = $row['description'];
    } else {
        echo "Sponsor not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Sponsor</title>
</head>
<body>
    <h2>Sponsor Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="sponsor_id">Enter Sponsor ID:</label>
        <input type="text" id="sponsor_id" name="sponsor_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($sponsor_id)) : ?>
        <h1>Update Sponsor</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="sponsor_id" value="<?php echo $sponsor_id; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
            <label for="phonenumber">Phone Number:</label><br>
            <input type="tel" id="phonenumber" name="phonenumber" value="<?php echo $phonenumber; ?>" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required><?php echo $description; ?></textarea><br><br>
            <button type="submit" name="update_sponsor">Update Sponsor</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
