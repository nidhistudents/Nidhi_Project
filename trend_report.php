<?php
// Connect to the database (replace these values with your database credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a trend analysis report
function generateTrendAnalysisReport() {
    global $conn;
    $sql = "SELECT * FROM iep_details ORDER BY date_created DESC LIMIT 12"; // Selecting data for the last 12 months
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Trend Analysis Report</h2>";
        echo "<p>This report shows trends in IEP details over the last 12 months.</p>";
        echo "<table>";
        echo "<tr><th>Month</th><th>Speech Goals</th><th>OT Goals</th><th>Special Ed</th></tr>";
        while($row = $result->fetch_assoc()) {
            // Extract month and year from the date_created field
            $date = date_create($row["date_created"]);
            $monthYear = date_format($date, "M Y");

            echo "<tr>";
            echo "<td>" . $monthYear . "</td>";
            echo "<td>" . $row["speech_goals"] . "</td>";
            echo "<td>" . $row["ot_goals"] . "</td>";
            echo "<td>" . $row["special_ed"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data available for trend analysis report.";
    }
}

// Call function to generate trend analysis report
generateTrendAnalysisReport();

// Close database connection
$conn->close();
?>
