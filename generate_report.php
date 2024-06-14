<?php include 'session_control.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST["student_id"];
    $invoice_date = $_POST["invoice_date"];
    $therapies = $_POST["therapy"];
    $days = $_POST["days"];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nidhi_students";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve student details
    $sql_student = "SELECT first_name, last_name FROM students WHERE student_id = '$student_id'";
    $result_student = $conn->query($sql_student);
    if ($result_student->num_rows > 0) {
        $row_student = $result_student->fetch_assoc();
        $student_name = $row_student["first_name"] . " " . $row_student["last_name"];
    } else {
        $student_name = "Unknown";
    }

    // Generate invoice report
    $report = "<div style='font-family: Arial, sans-serif;'>";
    $report .= "<h2 style='text-align: center; margin-bottom: 20px;'>Invoice</h2>";
    $report .= "<div style='margin-bottom: 20px;'>";
    $report .= "<strong>Student Name:</strong> " . $student_name . "<br>";
    $report .= "<strong>Invoice Date:</strong> " . $invoice_date;
    $report .= "</div>";
    $report .= "<table style='width: 100%; border-collapse: collapse;'>";
    $report .= "<thead><tr style='background-color: #f2f2f2;'><th style='padding: 10px; text-align: left;'>Therapy</th><th style='padding: 10px; text-align: left;'>Price per Day</th><th style='padding: 10px; text-align: left;'>Days</th><th style='padding: 10px; text-align: left;'>Total</th></tr></thead>";
    $report .= "<tbody>";
    $total_amount = 0;
    foreach ($therapies as $key => $therapy) {
        $therapy_parts = explode("|", $therapy);
        $therapy_name = $therapy_parts[0];
        $price_per_day = $therapy_parts[1];
        $day = $days[$key];
        $total = $price_per_day * $day;
        $total_amount += $total;
        $report .= "<tr><td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $therapy_name . "</td>";
        $report .= "<td style='padding: 10px; border-bottom: 1px solid #ddd;'>$" . $price_per_day . "</td>";
        $report .= "<td style='padding: 10px; border-bottom: 1px solid #ddd;'>" . $day . "</td>";
        $report .= "<td style='padding: 10px; border-bottom: 1px solid #ddd;'>$" . number_format($total, 2) . "</td></tr>";
    }
    $report .= "</tbody></table>";
    $report .= "<div style='text-align: right; margin-top: 20px;'><strong>Grand Total:</strong> $" . number_format($total_amount, 2) . "</div>";
    $report .= "</div>";

    // Close database connection
    $conn->close();
} else {
    $report = "<p>No data submitted</p>";
}

// Output the invoice report
echo $report;
?>
