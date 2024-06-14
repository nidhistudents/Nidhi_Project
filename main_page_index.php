<?php 
include 'session_control.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff; /* Set background color to a whitish blue */
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .search-bar {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .nidhi-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .menu {
            display: none; /* Hide menu by default */
            padding: 10px;
            background-color: #f0f0f0; /* Menu background color */
            border-radius: 5px;
            position: absolute;
            top: 60px; /* Adjust the top position as needed */
            left: 20px; /* Adjust the left position as needed */
            z-index: 1000; /* Ensure the menu is above other elements */
        }
        .menu button {
            display: block;
            margin-bottom: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
            padding: 10px;
        }
        .menu button:hover {
            background-color: #0056b3;
        }
		.logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #e60000;
        }
        .hamburger {
            display: block;
            position: fixed;
            top: 20px;
            left: 20px;
            cursor: pointer;
            z-index: 1000;
        }
        .hamburger .line {
            width: 30px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
        }
		.user-details {
            text-align: right;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- User details -->
        <div class="user-details">
           <h1> <?php echo "Welcome, " . $_SESSION['first_name'] . "!"; ?></h1>
        </div>
    <div class="container">
        <!-- Nidhi logo -->
        <div class="nidhi-logo">
            <img src="../images/Logo.png" alt="Nidhi Logo" width="200">
        </div>
		<button class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
        <h1>Welcome to Student management System Nidhi Foundation for Early Intervention</h1>
        <p>Our goals are to impact the scenario of early intervention in India, by providing services, awareness,
and capacity building. Our vision is to provide quality special education and allied early intervention
services for young children with</p>
        
        <!-- Search bar -->
        <input type="text" class="search-bar" id="searchInput" placeholder="Search Student...">

        <!-- Hamburger button -->
        <div class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

        <!-- Menu with buttons -->
        <div class="menu" id="menu">
            <button onclick="registerStudent()">Register Student</button>
			<button onclick="generateInvoice()">Payment System</button>
			<button onclick="myCalendar()">My Calendar</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Function to toggle menu visibility
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        // Function to handle registering a student
        function registerStudent() {
            // Redirect to the student registration page
            window.location.href = "../register_student.html";
        }
		function generateInvoice() {
            // Redirect to the generate invoice page
            window.location.href = "payment_system.php";
        }
		function myCalendar() {
            // Redirect to the generate invoice page
            window.location.href = "my_calendar.php";
        }
		

        // Function to handle searching for a student
        document.getElementById("searchInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                // Retrieve the search query
                var searchQuery = document.getElementById("searchInput").value;

                // Redirect to the search results page with the search query
                window.location.href = "search_results.php?query=" + searchQuery;
            }
        });
    </script>
</body>
</html>
