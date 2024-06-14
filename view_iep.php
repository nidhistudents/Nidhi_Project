<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View IEP Goals</title>
    <style>
        /* CSS styles for the page */
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-button, .home-button, .add-iep-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-button:hover, .home-button:hover, .add-iep-button:hover {
            background-color: #0056b3;
        }
        /* Add borders between columns */
        th, td {
            border-right: 1px solid #ddd;
        }
        th:last-child, td:last-child {
            border-right: none;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <!-- Buttons Container -->
        <div class="buttons-container">
            <!-- Edit Goals Button -->
            <button class="edit-button" onclick="window.location.href='edit_goals.php?id=<?php echo $_GET['id']; ?>'">Edit Goals</button>

            <!-- Home Button -->
            <button class="home-button" onclick="window.location.href='main_page_index.php'">Home</button>
			
			<!-- Home Button -->
            <button class="add-iep-button" onclick="window.location.href='add_iep.php?id=<?php echo $_GET['id']; ?>'">Add IEP</button>
        </div>
        <?php
        // Check if the student ID is provided
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Retrieve the student ID
            $studentId = $_GET['id'];

            // Connect to the database (replace with your database credentials)
            $conn = new mysqli("localhost", "root", "", "nidhi_students");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL query to fetch student's name
            $sql = "SELECT first_name, last_name FROM students WHERE student_id = '$studentId'";
            $result = $conn->query($sql);

            // Display IEP Goals heading with student's name
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $studentName = $row["first_name"] . " " . $row["last_name"];
                echo "<h1>IEP Goals for $studentName</h1>";
            } else {
                echo "<h1>IEP Goals</h1>";
            }
            // Prepare and execute SQL query to fetch IEP goals for the student
            $sql = "SELECT * FROM iep_goals WHERE student_id = '$studentId'";
            $result = $conn->query($sql);

            // Display IEP goals in a table
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Goal Name</th><th>Plan_type</th><th>Current Level</th><th>Goal Description</th><th>Goal Status</th><th>Additional Notes</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["goal_name"] . "</td>";
                    echo "<td>" . nl2br($row["plan_type"]) . "</td>";
                    echo "<td>" . nl2br($row["current_level"]) . "</td>";
					echo "<td>" . nl2br($row["goal_description"]) . "</td>";
                    echo "<td>" . $row["goal_status"] . "</td>";
					echo "<td>" . $row["additional_notes"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No IEP goals found for the provided student ID.</p>";?>
				
			<?php	 
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<h1>IEP Goals</h1>";
            echo "<p>No student ID provided.</p>";
        }
        ?>
    </div>
</body>
</html>
