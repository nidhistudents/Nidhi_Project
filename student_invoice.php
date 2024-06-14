<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Invoices</title>
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

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
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
		.home-button{
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .home-button:hover{
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <!-- Buttons Container -->
        <div class="buttons-container">
            <!-- Home Button -->
            <button class="home-button" onclick="window.location.href='main_page_index.php'">Home</button>
        </div>
        <h1>Student Invoices</h1>

        <form action="" method="post">
            <label for="student">Select Student:</label>
            <select id="student" name="student_id" onchange="this.form.submit()">
                <option value="">Select Student</option>
                <?php
                // Connect to the database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nidhi_students";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                // Retrieve student names from the database
                $sql = "SELECT student_id, first_name, last_name FROM students";
                $result = $conn->query($sql);

                // Display student names in the dropdown
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $selected = isset($_POST['student_id']) && $_POST['student_id'] == $row['student_id'] ? 'selected' : '';
                        echo "<option value='" . $row["student_id"] . "' $selected>" . $row["first_name"] . " " . $row["last_name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No students found</option>";
                }

                // Close database connection
                $conn->close();
                ?>
            </select>
			 <label for="payment_status">Filter by Payment Status:</label>
            <select id="payment_status" name="payment_status" onchange="this.form.submit()">
                <option value="Pending" <?php echo isset($_POST['payment_status']) && $_POST['payment_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Paid" <?php echo isset($_POST['payment_status']) && $_POST['payment_status'] == 'Paid' ? 'selected' : ''; ?>>Paid</option>
            </select>
        </form>
        
        <?php
		
        // Check if student is selected
        if (isset($_POST["student_id"]) && !empty($_POST["student_id"])) {
            // Include database connection code
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nidhi_students";

                    $conn = new mysqli($servername, $username, $password, $dbname);
            // Retrieve invoices for the selected student
            $student_id = $_POST["student_id"];
			$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : ''; // Get selected payment status
            $sql = "SELECT * FROM invoices WHERE student_id = '$student_id' and payment_status = '$payment_status'";
		
            $result = $conn->query($sql);

            // Display invoices in a table
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Student Name</th><th>Total Amount</th><th>Invoice Date</th><th>Payment Status</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["student_name"] . "</td>";
                    echo "<td>" . $row["total_amount"] . "</td>";
                    echo "<td>" . $row["invoice_date"] . "</td>";
                    echo "<td>" . $row["payment_status"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No invoices found for the selected student.</p>";
            }

            // Close database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
