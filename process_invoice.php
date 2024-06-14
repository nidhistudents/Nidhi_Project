<?php include 'session_control.php'; ?>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $invoice_date = $_POST["invoice_date"];
    $student_id = $_POST["student_id"];
    $speech_therapy = $_POST["speech_therapy"];
    $ot = $_POST["ot"];
    $special_ed = $_POST["special_ed"];
    $group_sessions = $_POST["group_sessions"];
	$payment_status = $_POST["payment_status"];
 	 
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

    // Retrieve student name
    $sql_student = "SELECT first_name, last_name FROM students WHERE student_id = $student_id";
    $result_student = $conn->query($sql_student);
    if ($result_student->num_rows > 0) {
        $row_student = $result_student->fetch_assoc();
        $student_name = $row_student["first_name"] . " " . $row_student["last_name"];
    } else {
        die("Invalid student ID");
    }

    // Retrieve therapy prices
    $sql_therapies = "SELECT service_description, unit_price FROM therapies";
    $result_therapies = $conn->query($sql_therapies);

    $speech_therapy_amount = $speech_therapy * 0; // Initialize speech therapy amount
    $ot_amount = $ot * 0; // Initialize OT amount
    $special_ed_amount = $special_ed * 0; // Initialize special ed amount
    $group_sessions_amount = $group_sessions * 0; // Initialize group sessions amount

    // Calculate total amount for each therapy
    if ($result_therapies->num_rows > 0) {
        while ($row_therapy = $result_therapies->fetch_assoc()) {
            switch ($row_therapy["service_description"]) {
                case "Speech Therapy":
                    $speech_therapy_amount = $speech_therapy * $row_therapy["unit_price"];
                    break;
                case "OT":
                    $ot_amount = $ot * $row_therapy["unit_price"];
                    break;
                case "Special Ed":
                    $special_ed_amount = $special_ed * $row_therapy["unit_price"];
                    break;
                case "Group Sessions":
                    $group_sessions_amount = $group_sessions * $row_therapy["unit_price"];
                    break;
                default:
                    // Handle other therapies if necessary
                    break;
            }
        }
    }

    // Calculate grand total
    $grand_total = $speech_therapy_amount + $ot_amount + $special_ed_amount + $group_sessions_amount;

    // Insert invoice details into invoices table
    $sql_insert = "INSERT INTO invoices (invoice_date, student_id, student_name, speech_therapy, ot, special_ed, group_session, total_amount, payment_status) VALUES ";
    $sql_insert .= "('$invoice_date', '$student_id', '$student_name', $speech_therapy_amount, $ot_amount, $special_ed_amount, $group_sessions_amount, $grand_total, '$payment_status')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Invoice generated successfully');</script>";
        echo "<script>window.location.href = 'payment_system.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
