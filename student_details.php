<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .profile {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-info {
            flex-grow: 1;
        }
        .profile-info h2 {
            margin-top: 0;
        }
        .profile-info p {
            margin-bottom: 10px;
        }
		.home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
		}
		.edit-button, .view-therapies-button {
            display: block;
            margin-top: 20px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            text-align: center;
        }
        .edit-button:hover, .view-therapies-button:hover {
            background-color: #0056b3;
        }
		.view-iep-button {
            display: block;
            margin-top: 20px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            text-align: center;
        }
		.view-iep-button:hover {
            background-color: #0056b3;
        }
		.tabs {
            display: flex;
            margin-top: 20px;
        }
        .tab-button {
            flex-grow: 1;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px 5px 0 0;
            cursor: pointer;
            text-align: center;
        }
        .tab-button:hover {
            background-color: #0056b3;
        }
        .tab-content {
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 0 0 5px 5px;
        }
        .service-select {
            margin-top: 20px;
        }
        .service-select label {
            font-weight: bold;
        }
        .service-select select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .service-select button {
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .service-select button:hover {
            background-color: #0056b3;
        }		
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	<a href="main_page_index.php" class="home-button"><i class="fas fa-home"></i>Home</a>
        <h1>Student Details</h1>
        		
        <div id="Personal Info" class="tabcontent">
            <!-- Personal details content goes here -->
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

            // Display student details
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='profile'>";
                    echo "<img src='../uploads/{$row['profile_picture']}' alt='Profile Picture'>";
                    echo "<div class='profile-info'>";
                    echo "<h2>" . $row["first_name"] . " " . $row["last_name"] . "</h2>";
                    echo "<p>Gender: " . $row["gender"] . "</p>";
                    echo "<p>Date of Birth: " . $row["dob"] . "</p>";
                    // Add other fields as needed
					echo "<p>Age: " . $row["age"] . "</p>";
					echo "<p>Address: " . $row["address"] . "</p>";
					echo "<p>Contact Number: " . $row["contact_number"] . "</p>";
					echo "<p>Mother: " . $row["mother_name"] . "</p>";
					echo "<p>Father: " . $row["father_name"] . "</p>";
                    echo "</div>";
					// Add Edit Profile button
					echo "<div class='button-container'>";
                    echo "<button class='edit-button' onclick=\"editProfile('" . $row['student_id'] . "')\">Edit Profile</button>";
					// Add View IEP button
					echo "<div class='button-container'>";
                    echo "<button class='view-iep-button' onclick=\"viewIEP('" . $row['student_id'] . "')\">View IEP</button>";
					echo "</div>";
					// Add View Therapies button
					echo "<div class='button-container'>";
                    echo "<button class='view-therapies-button' onclick=\"viewTherapies('" . $row['student_id'] . "')\">Services Taken</button>";
					echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No student found with the provided ID.</p>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No student ID provided.</p>";
        }
        ?>
		<script>
            // Function to redirect to edit profile page
            function editProfile(studentId) {
                window.location.href = "edit_profile.php?id=" + studentId;
            }
					// Function to redirect to view IEP page
            function viewIEP(studentId) {
                window.location.href = "view_iep.php?id=" + studentId;
            }
			function viewTherapies(studentId) {
                window.location.href = "view_therapies.php?id=" + studentId;
            }
        </script>
    </div>
</body>
</html>
