<?php
session_start(); 

// Check if the session variable "user_type" is not set or is null
if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] === null){
    header("Location: login.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Home Page</title>
    <style>
 
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/kcc.jpg');
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo-container img {
            height: 40px; 
            width: 100px;
            margin-left: 20px; 
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }
        nav a:hover {
            background-color: #555;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 120px;
            z-index: 1;
        }
        .dropdown-content a {
            color: #fff;
            padding: 6px 10px;
            display: block;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background-color: #555;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


        main {
            display: flex;
            justify-content: space-between;
            margin: 20 px auto;
            max-width: 1200px;         }

        main img {
            height: 380px;
            width: 50%; 
            margin-bottom: 5px; 
        }

    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="images/Log.jpg" alt="Logo">
        </div>
        <a href="userhome.php">Home</a>
        <a href="Attendees.php">ATTENDEES</a>
        <a href="eventregistration.php">EVENTREGISTRATION</a>
        <a href="booking.php">BOOKING</a>
        <a href="Feedback.php">FEEDBACK</a>
       <a href="logout.php">LOGOUT</a>
    </nav>

    <center><h1> EVENT MANAGEMENT SYSTEM(USER)</h1></center>
    <main>
        <img src="images/event.jpg" alt="Image 1">
        <img src="images/kcc.jpg" alt="Image 2">
    </main>

    <footer>
  <p><marquee>&copy; EVENT MANAGEMENT SYSTEM GISA PATRICK 222008906</marquee></p>
    </footer>
</body>
</html>
