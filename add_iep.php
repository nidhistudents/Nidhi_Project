<?php include 'session_control.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add IEP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        select, textarea, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
        <h1>Add IEP</h1>
		<?php
        // Check if the student ID is provided in the URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // Retrieve the student ID from the URL parameters
            $studentId = $_GET['id'];        
        ?>
        <form action="process_add_iep.php" method="post">
		<?php echo "<input type='hidden' name='student_id' value='$studentId'>";?>
            <label for="goal">Select Goal:</label>
            <select id="goal" name="goal_name">
                <option value="Gross Motor">Gross Motor</option>
                <option value="Fine Motor">Fine Motor</option>
                <option value="Speech and Communication">Speech and Communication</option>
				<option value="Sensory">Sensory</option>
				<option value="Functional Play skills">Functional Play skills</option>
				<option value="Behavioural challenges">Behavioural challenges</option>
				<option value="Self Help">Self Help</option>
				<option value="Academics/Pre-Academics/SR">Academics/Pre-Academics/SR</option>
				<option value="Reading">Reading</option>
				<option value="Numeracy">Numeracy</option>
				<option value="General Awareness">General Awareness</option>
				<option value="Life Skills Training">Life Skills Training</option>
                <!-- Add other available goals here -->
            </select>

            <label for="plan_type">Select Plan Type:</label>
            <select id="plan_type" name="plan_type">
                <option value="Long term plan">Long term plan</option>
                <option value="Short term plan">Short term plan</option>
                <!-- Add other plan types here -->
            </select>
			
			<label for="current_level">Current Level of Goal:</label>
            <textarea id="current_level" name="current_level" rows="4" cols="50" required></textarea>


            <label for="goal_description">Goal Description:</label>
            <textarea id="goal_description" name="goal_description" placeholder="Enter goal description"></textarea>

            <label for="goal_status">Goal Status:</label>
            <select id="goal_status" name="goal_status">
                <option value="Introduced">Introduced</option>
                <option value="In Progress">In Progress</option>
                <option value="Maintained">Maintained</option>
                <!-- Add other goal statuses here -->
            </select>
			
			<label for="additional_notes">Additional Notes:</label>
            <textarea id="additional_notes" name="additional_notes" placeholder="Additional Notes"></textarea>

            <input type="submit" value="Submit">
        </form>
		<!-- Buttons for navigation -->
        <div class="button-container">
            <a href="main_page_index.php" class="button">Home</a>
            <a href="view_iep.php?id=<?php echo $_GET['id']; ?>" class="button">View IEP</a>
        </div>
        <?php
        } else {
            echo "<p>Error: No student ID provided.</p>";
        }
        ?>
    </div>
</body>
</html>
