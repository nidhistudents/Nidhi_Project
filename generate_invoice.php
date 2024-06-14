<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Invoice</title>
    <style>
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
		
		.home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
		}
		
		.home-button:hover {
            background-color: #0056b3;
			
		}

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        select, input[type="number"], input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
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

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <a href="main_page_index.php" class="home-button"><i class="fas fa-home"></i>Home</a>
        <h1>Generate Invoice</h1>
        <form action="process_invoice.php" method="post">
            <div class="dropdown">
                <label for="student">Select Student:</label>
                <select id="student" name="student_id" required>
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
            </div>

            <label for="invoice_date">Select Invoice Date:</label>
            <input type="date" id="invoice_date" name="invoice_date" required>

            <!-- Text inputs for entering the number of therapies -->
            <label for="speech_therapy">Number of Speech Therapy:</label>
            <input type="number" id="speech_therapy" name="speech_therapy" min="0" required>

            <label for="ot">Number of OT:</label>
            <input type="number" id="ot" name="ot" min="0" required>

            <label for="special_ed">Number of Special Ed:</label>
            <input type="number" id="special_ed" name="special_ed" min="0" required>

            <label for="group_sessions">Number of Group Sessions:</label>
            <input type="number" id="group_sessions" name="group_sessions" min="0" required>
			
			<label for="payment_status">Payment Status:</label>
            <select id="payment_status" name="payment_status">
                <option value="Pending" selected>Pending</option>
                <option value="Paid">Paid</option>
            </select>

            <button type="submit">Generate Invoice</button>
        </form>
    </div>
</body>
</html>
