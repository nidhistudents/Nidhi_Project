<?php include 'session_control.php'; ?>
<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Retrieve the student ID from the URL parameters
    $studentId = $_GET['id'];

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

    // Prepare and execute SQL query to update each goal
    foreach ($_POST['goal_id'] as $key => $goalId) {
        // Retrieve data for each goal
        $currentLevel = $_POST['current_level'][$key];
        $goalDescription = $_POST['goal_description'][$key];
        $goalStatus = $_POST['goal_status'][$key];
		$additionalNotes = $_POST['additional_notes'][$key];

        // Update the goal in the database
        $sql = "UPDATE iep_goals SET current_level=?, goal_description=?, goal_status=?, additional_notes=? WHERE goal_id=? AND student_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $currentLevel, $goalDescription, $goalStatus, $additionalNotes, $goalId, $studentId);
        $stmt->execute();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect back to view-iep.php
    header("Location: view_iep.php?id=$studentId");
    exit();
} else {
    // Invalid request
    die("Invalid request.");
}
?>
