<?php include 'session_control.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Styles for Dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
		.home-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .home-button:hover {
            background-color: #0056b3;
        }

        #dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #dashboard-content {
            max-width: 800px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            border-radius: 5px;
            overflow: hidden;
        }

        #sidebar {
            width: 25%;
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-radius: 5px 0 0 5px;
        }

        #sidebar h2 {
            margin-bottom: 20px;
        }

        #sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li {
            margin-bottom: 10px;
        }

        #sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        #content {
            width: 75%;
            background-color: #fff;
            padding: 20px;
            border-radius: 0 5px 5px 0;
        }

        /* Centered Message */
        #centered-message {
            text-align: center;
            margin-bottom: 20px;
            color: #777;
        }

        /* Styles for Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
	<div class="buttons-container">
            <!-- Home Button -->
        <button class="home-button" onclick="window.location.href='main_page_index.php'">Home</button>
    </div>
    <div id="dashboard">
        <div id="dashboard-content">
            <!-- Sidebar -->
            <div id="sidebar">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="#" onclick="loadTherapiesAndFees()">Therapies and Fees</a></li>
                    <li><a href="student_invoice.php">Student Invoices</a></li>
					<li><a href="generate_invoice.php">Generate Invoices</a></li>
					<li><a href="view_invoices.php">View Invoices</a></li>
                </ul>
            </div>
            
            <!-- Content -->
            <div id="content">
                <div id="centered-message">
                    <h2>Welcome to the Nidhi Foundation invoice management</h2>
                    <p>Select an option from the sidebar to get started.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadTherapiesAndFees() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "therapies_and_fees.php", true);
            xhttp.send();
        }
		
    </script>
</body>
</html>
