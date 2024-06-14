<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoices</title>
    <style>
        /* Add your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
        <h1>View Invoices</h1>
        <form action="view_invoices_details.php" method="get">
            <label for="student_id">Select Student:</label>
            <select id="student_id" name="student_id">
                <option value="">Select Student</option>
                <?php
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

                // Retrieve student names from the database
                $sql = "SELECT student_id, first_name, last_name FROM students";
                $result = $conn->query($sql);

                // Display student names in the dropdown
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["student_id"] . "'>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No students found</option>";
                }

                // Close database connection
                $conn->close();
                ?>
            </select>

            <label for="invoice_date">Select Invoice Date:</label>
            <input type="date" id="invoice_date" name="invoice_date">

            <button type="submit">View Invoices</button>
        </form>
    </div>
</body>
</html>
