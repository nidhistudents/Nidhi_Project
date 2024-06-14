<?php include 'session_control.php'; ?>

<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $goal_name = $_POST['goal_name'];
	$plan_type = $_POST['plan_type'];
    $current_level = $_POST['current_level'];
	$goal_description = $_POST['goal_description'];
	$goal_status = $_POST["goal_status"];
	$additional_notes = $_POST["additional_notes"];

    // Validate form data if needed
	echo $student_id;

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nidhi_students";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to insert data into "IEP" table
    $sql = "INSERT INTO iep_goals (student_id, goal_name, plan_type, current_level, goal_description,  goal_status, additional_notes) 
            VALUES ('$student_id', '$goal_name', '$plan_type', '$current_level', '$goal_description', '$goal_status', '$additional_notes')";

	$stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "<script>alert('IEP added successfully'); window.location.href = 'view_iep.php?id=$student_id';</script>";
    
    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Form data not submitted";
}
?>
