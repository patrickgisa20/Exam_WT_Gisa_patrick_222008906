<?php
require_once "./conn/connection.php";

// Check if the form is submitted for feedback update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_feedback'])) {
    // Retrieve the submitted form data
    $feedback_id = $conn->real_escape_string($_POST['feedback_id']);
    $comment = $conn->real_escape_string($_POST['comment']);
    
    // Convert the selected option to a numerical rating
    $rating = ($_POST['rating'] == "Good") ? "good" : "bad";

    // Update the feedback record in the database
    $update_sql = "UPDATE feedback SET comment='$comment', rating='$rating' WHERE feedback_id='$feedback_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Feedback updated successfully');</script>";
        echo "<script>window.location.href = 'viewfeedback.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating feedback: " . $conn->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['feedback_id'])) {
    $feedback_id = $conn->real_escape_string($_GET['feedback_id']);
    $select_sql = "SELECT * FROM feedback WHERE feedback_id='$feedback_id'";
    $result_update = $conn->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the feedback data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $comment = $row['comment'];
        $rating = ($row['rating'] == 5) ? "Good" : "Bad"; // Convert numerical rating to option
    } else {
        echo "Feedback not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Feedback</title>
</head>
<body>
    <h2>Feedback Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="feedback_id">Enter Feedback ID:</label>
        <input type="text" id="feedback_id" name="feedback_id" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($feedback_id)) : ?>
        <h1>Update Feedback</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>">
            <label for="comment">Comment:</label><br>
            <textarea id="comment" name="comment" rows="4" cols="50" required><?php echo $comment; ?></textarea><br><br>
            <label for="rating">Rate:</label><br>
            <input type="radio" id="good" name="rating" value="Good" <?php if ($rating == "Good") echo "checked"; ?>>
            <label for="good">Good</label><br>
            <input type="radio" id="bad" name="rating" value="Bad" <?php if ($rating == "Bad") echo "checked"; ?>>
            <label for="bad">Bad</label><br><br>
            <button type="submit" name="update_feedback">Update Feedback</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
