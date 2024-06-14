<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit IEP Goals</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
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
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .button-container {
            text-align: center;
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <h1>Edit IEP Goals</h1>
    <div class="container">
        <form id="goalForm" action="update_goal.php?id=<?php echo $_GET['id']; ?>" method="post">
            <?php
            // Retrieve the student ID from the URL parameters
            $studentId = $_GET['id'];

            // Connect to the database (replace with your database credentials)
            $conn = new mysqli("localhost", "root", "", "nidhi_students");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL query to fetch IEP goals for the student
            $sql = "SELECT * FROM iep_goals WHERE student_id = '$studentId'";
            $result = $conn->query($sql);

            // Display editable fields for each goal
            if ($result->num_rows > 0) {
                $goals = $result->fetch_all(MYSQLI_ASSOC);
                $numGoals = count($goals);
                $currentGoalIndex = 0;

                foreach($goals as $goal) {
                    echo "<div class='goal' id='goal_" . $goal['goal_id'] . "' style='" . ($currentGoalIndex == 0 ? '' : 'display: none;') . "'>";
                    echo "<input type='hidden' name='goal_id[]' value='" . $goal['goal_id'] . "'>";
                    echo "<label for='goal_" . $goal['goal_id'] . "'>Goal:</label><br>";
                    echo "<input type='text' id='goal_" . $goal['goal_id'] . "' name='goal_name[]' value='" . $goal['goal_name'] . "' readonly><br>";
                    echo "<label for='plan_type_" . $goal['goal_id'] . "'>Plan Type:</label><br>";
                    echo "<input type='text' id='plan_type_" . $goal['goal_id'] . "' name='plan_type[]' value='" . $goal['plan_type'] . "' readonly><br>";
                    echo "<label for='current_level_" . $goal['goal_id'] . "'>Current Level of Goal:</label><br>";
                    echo "<textarea id='current_level_" . $goal['goal_id'] . "' name='current_level[]' rows='4' cols='50'>" . $goal['current_level'] . "</textarea><br>";
                    echo "<label for='goal_description_" . $goal['goal_id'] . "'>Goal Description:</label><br>";
                    echo "<textarea id='goal_description_" . $goal['goal_id'] . "' name='goal_description[]' rows='5' cols='50'>" . $goal['goal_description'] . "</textarea><br>";
					echo "<label for='goal_status_" . $goal['goal_id'] . "'>Goal Status:</label><br>";
                    echo "<select id='goal_status_" . $goal['goal_id'] . "' name='goal_status[]'>";
                    echo "<option value='pending' " . ($goal['goal_status'] == 'pending' ? 'selected' : '') . ">Pending</option>";
                    echo "<option value='in_progress' " . ($goal['goal_status'] == 'in_progress' ? 'selected' : '') . ">In Progress</option>";
                    echo "<option value='achieved' " . ($goal['goal_status'] == 'achieved' ? 'selected' : '') . ">Achieved</option>";
					echo "<label for='additional_notes_" . $goal['goal_id'] . "'>Additional Notes:</label><br>";
                    echo "<textarea id='additional_notes_" . $goal['goal_id'] . "' name='additional_notes[]' rows='5' cols='50'>" . $goal['additional_notes'] . "</textarea><br>";
                    echo "</select><br>";
                    echo "<input type='button' value='Back' onclick='previousGoal()' />";
                    echo "<input type='button' value='" . ($currentGoalIndex == $numGoals - 1 ? 'Save' : 'Next') . "' onclick='nextGoal()'>";
                    echo "</div>";
                    $currentGoalIndex++;
                }
            } else {
                echo "<p>No IEP goals found for the provided student ID.</p>";
            }

            // Close database connection
            $conn->close();
            ?>

        </form>

        <!-- Buttons for navigation -->
        <div class="button-container">
            <a href="main_page_index.php" class="button">Home</a>
            <a href="view_iep.php?id=<?php echo $_GET['id']; ?>" class="button">View IEP</a>
			<a href="add_iep.php?id=<?php echo $_GET['id']; ?>" class="button">ADD Goals</a>
        </div>
    </div>

    <!-- Add your JavaScript here -->
    <script>
        let currentGoalIndex = 0;
        let goals = document.querySelectorAll('.goal');

        function nextGoal() {
            if (currentGoalIndex < goals.length - 1) {
                goals[currentGoalIndex].style.display = 'none';
                currentGoalIndex++;
                goals[currentGoalIndex].style.display = 'block';
            } else {
                document.getElementById('goalForm').submit();
            }
        }

        function previousGoal() {
            if (currentGoalIndex > 0) {
                goals[currentGoalIndex].style.display = 'none';
                currentGoalIndex--;
                goals[currentGoalIndex].style.display = 'block';
            }
        }
    </script>
</body>
</html>
