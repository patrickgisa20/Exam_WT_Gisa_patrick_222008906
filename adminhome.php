<?php
session_start(); 

// Check if the session variable "user_type" is not set or is null
if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] === null){
    header("Location: login.php");
    exit; // Always exit after a header redirect to prevent further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Home Page</title>
    <style>
 
        body {
            background-image: url('images/kcc.jpg');
            font-family: Arial, sans-serif;
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
    <a href="adminhome.php">Home</a>
    <a href="Events.php">EVENTS</a>
    <a href="sponsors.php">SPONSOR</a>
    <a href="venue.php">VENUS</a>
    <a href="organizer.php">ORGANIZER</a>

    <!-- Dropdown menu for "View" links -->
    <div class="dropdown">
        <a href="#" class="dropbtn">VIEW</a>
        <div class="dropdown-content">
            <a href="viewattendees.php">ATTENDEES</a>
            <a href="viewbooking.php">BOOKING</a>
            <a href="viewevents.php">EVENTS</a>
            <a href="viewfeedback.php">FEEDBACK</a>
            <a href="vieworganizer.php">ORGANIZERS</a>
            <a href="viewregistration.php">REGISTRATION</a>
            <a href="viewsponsor.php">SPONSOR</a>
            <a href="viewvenue.php">VENUE</a>
            <a href="viewuserandadmin.php">View User</a>
            
        </div>
    </div>

    <a href="logout.php">Logout</a>
</nav>


    <center><h1> EVENT MANAGEMENT SYSTEM(ADMIN)</h1></center>
    <main>
        <img src="images/kcc.jpg" alt="Image 1">
        <img src="images/venues.jpg" alt="Image 2">
    </main>

    <footer>
  <p><marquee>&copy; EVENT MANAGEMENT SYSTEM GISA PATRICK 222008906</marquee></p>
    </footer>
</body>
</html>
