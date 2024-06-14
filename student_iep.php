<?php include 'session_control.php'; ?>

<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "nidhi_students";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch goals from the database
$sql = "SELECT goal_name, status FROM iep_details WHERE student_id = ?"; // Assuming you have a column named 'student_id' in your table
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id); // Assuming $student_id holds the ID of the student
$student_id = 1; // Example student ID, replace with the actual ID
$stmt->execute();
$result = $stmt->get_result();

// Display goals with status icons
while ($row = $result->fetch_assoc()) {
    $goal_name = $row['goal_name'];
    $status = $row['status'];

    // Determine status icon based on the status value
    switch ($status) {
        case 'pending':
            $status_icon = '<i class="fas fa-hourglass-start pending"></i>'; // Pending icon
            break;
        case 'in-progress':
            $status_icon = '<i class="fas fa-spinner in-progress"></i>'; // In progress icon
            break;
        case 'completed':
            $status_icon = '<i class="fas fa-check-circle completed"></i>'; // Completed icon
            break;
        default:
            $status_icon = ''; // Default empty icon
            break;
    }

    // Output the goal with status icon
    echo '<div class="iep-goal">';
    echo '<div class="goal-info">';
    echo '<h3>' . $goal_name . '</h3>';
    // You can add more details here if needed
    echo '</div>';
    echo '<div class="status-icon">' . $status_icon . '</div>';
    echo '</div>';
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
