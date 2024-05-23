<?php
// Establish connection to database
  require_once "./conn/connection.php";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $userType = $conn->real_escape_string($_POST['userType']);

    // Check if the user type is admin
    if ($userType === "admin") {
        // Insert admin into admins table
        $adminSql = "INSERT INTO admins (name, Email, Password) 
                     VALUES ('$name', '$email' ,'$password')";
        if ($conn->query($adminSql) === TRUE) {
          echo "<script>
    alert('admin Registration successfully!');
    window.location.href = 'login.php'; 
</script>";
        } else {
            echo "Error inserting admin: " . $conn->error;
        }
    } else {
        // Create SQL insert statement for regular users
        $sql = "INSERT INTO users (name, Email, Password, UserType) 
                VALUES ('$name', '$email', '$password', '$userType')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
    alert('User Registration successfully!');
    window.location.href = 'login.php'; 
</script>";


        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
