<?php include 'session_control.php'; ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
	$contact_number = $_POST['contact_number'];
	
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

    // Prepare and execute SQL query to update student details
    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', contact_number='$contact_number' WHERE student_id='$student_id'";
    // Add other fields to the update query as needed

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student details updated successfully'); window.location.href = 'student_details.php?id=$student_id';</script>";
    } else {
        echo "<script>alert('Error updating student details: " . $conn->error . "'); window.location.href = 'student_details.php?id=$student_id';</script>";
    }

    // Close database connection
    $conn->close();
} else {
    // If the form is not submitted via POST method, redirect to the edit profile page
    header("Location: edit_profile.php");
    exit;
}
?>
