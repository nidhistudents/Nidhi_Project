<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 10px 20px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
		.home-icon {
            text-align: left;
            margin-bottom: 20px;
        }
		/* Style for the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: #007bff; /* Blue color */
            color: #fff; /* White text color */
            font-family: Calibri, sans-serif; /* Calibri font */
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <a href="main_page_index.php" class="home-button"><i class="fas fa-home"></i>Home</a>
        <h1>Edit Profile</h1>
		<!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'PersonalInfo')">Personal Info</button>
            <button class="tablinks" onclick="openTab(event, 'IEP Details')">IEP Deatils</button>
        </div>

        <!-- Tab content -->
        <div id="PersonalInfo" class="tabcontent">
        <?php
        // Check if the student ID is provided
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Retrieve the student ID
            $studentId = $_GET['id'];

            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "nidhi_students";

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL query to fetch student details
            $sql = "SELECT * FROM students WHERE student_id = '$studentId'";
            $result = $conn->query($sql);

            // Display student details in the form
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>">
					<label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>">
					<label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>">                    
                    <input type="submit" value="Save Changes">
                </form>
                <?php
            } else {
                echo "<p>No student found with the provided ID.</p>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No student ID provided.</p>";
        }
        ?>
    </div>
	<div id="IEP Details" class="tabcontent">
	    <?php
        // Check if the student ID is provided
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Retrieve the student ID
            $studentId = $_GET['id'];

            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test_nidhi";

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL query to fetch student details
            $sql = "SELECT * FROM iep_details WHERE student_id = '$studentId'";
            $result = $conn->query($sql);

            // Display IEP details in the form
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();			
                ?>
				<form action="update_profile.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                    <label for="speech_goals">Speech Goals:</label>
                    <input type="text" id="speech_goals" name="speech_goals" value="<?php echo $row['speech_goals']; ?>">
                    <label for="ot_goals">OT:</label>
                    <input type="text" id="ot_goals" name="ot_goals" value="<?php echo $row['ot_goals']; ?>">
					<label for="special_ed">Education:</label>
                    <input type="text" id="special_ed" name="special_ed" value="<?php echo $row['special_ed']; ?>">
                    <input type="submit" value="Save Changes">
                </form>
                <?php
            } else {
                echo "<p>No IEP found with the provided ID.</p>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No IEP for student ID provided.</p>";
        }
        ?>
    </div>

        <script>
            // Function to open specific tab content
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    </div>
</body>
</html>
