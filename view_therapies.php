<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Therapies</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .add-button {
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px; /* Added space between buttons */
        }
        .add-button:hover {
            background-color: #218838; /* Darker green color on hover */
        }
		.home-button{
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .home-button:hover{
            background-color: #0056b3;
        }
        .remove-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <div class="container">
		<!-- Buttons Container -->
        <div class="buttons-container">           
            <!-- Home Button -->
            <button class="home-button" onclick="window.location.href='main_page_index.php'">Home</button>			
        </div>
        <h1>View Therapies</h1>
        <!-- Check if the student ID is provided -->
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
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

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_therapy'])) {
                $selectedTherapies = $_POST['therapy'];

                // Remove selected therapies from therapies_taken table
                foreach ($selectedTherapies as $therapyId) {
                    $deleteSql = "DELETE FROM therapies_taken WHERE student_id = '$studentId' AND therapy_id = '$therapyId'";
                    if ($conn->query($deleteSql) !== TRUE) {
                        echo "<script>alert('Error removing therapy: " . $conn->error . "');</script>";
                        break;
                    }
                }

                // Redirect back to view_therapies page
                header("Location: view_therapies.php?id=$studentId");
                exit();
            }

            // Retrieve all therapies taken by the student
            $sql = "SELECT t.service_description, tt.therapy_id FROM therapies_taken tt 
                    INNER JOIN therapies t ON tt.therapy_id = t.therapy_id 
                    WHERE tt.student_id=$studentId";

            $result = $conn->query($sql);

            // Display therapies in a table
            if ($result->num_rows > 0) {
                echo "<form method='post'>";
                echo "<table>";
                echo "<tr><th>Therapy Name</th><th>Action</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["service_description"] . "</td>";
                    echo "<td><input type='checkbox' name='therapy[]' value='{$row['therapy_id']}'></td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<input type='submit' name='remove_therapy' class='remove-button' value='Remove Selected Therapies'>";
				echo "<a href='add_therapies.php?id=$studentId' class='add-button'>Add Therapies</a>";
                echo "</form>";
            } else {
                echo "<p>No therapies selected for this student.</p>";
				echo "<a href='add_therapies.php?id=$studentId' class='add-button'>Add Services</a>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No student ID provided.</p>";
        }
        ?>
    </div>
</body>
</html>
