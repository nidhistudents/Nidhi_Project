<?php include 'session_control.php'; ?>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentId = $_POST['studentId'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    // Add other fields here based on your database schema

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

    // Prepare SQL statement to update student details
    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name' WHERE student_id='$studentId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to student details page with updated student ID
        header("Location: student_details.php?id=$studentId");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // If the form was not submitted via POST method, redirect to homepage or display an error message
    header("Location: index.php");
    exit;
}
?>
