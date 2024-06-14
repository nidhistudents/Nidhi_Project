<?php include 'session_control.php'; ?>

<?php
// Check if goal name is provided
if (isset($_GET['goal_name']) && !empty($_GET['goal_name'])) {
    // Retrieve goal name from the URL parameter
    $goalName = $_GET['goal_name'];

    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "root", "", "nidhi_students");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to fetch goal details based on goal name
    $sql = "SELECT * FROM iep_goals WHERE goal_name = '$goalName'";
    $result = $conn->query($sql);

    // Check if goal details are found
    if ($result->num_rows > 0) {
        // Fetch the first row (assuming unique goal names)
        $row = $result->fetch_assoc();

        // Create an array to hold goal details
        $goalDetails = array(
            'current_level' => $row['current_level'],
            'long_term_plan' => $row['long_term_plan'],
            'goal_status' => $row['goal_status']
        );

        // Output goal details as JSON
        echo json_encode($goalDetails);
    } else {
        // No goal details found for the provided goal name
        echo json_encode(array('error' => 'No goal details found'));
    }

    // Close database connection
    $conn->close();
} else {
    // Goal name not provided in the request
    echo json_encode(array('error' => 'Goal name not provided'));
}
?>
