<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice Details</title>
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
		
		.print-button, .share-to-whatsapp {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .print-button:hover, .share-to-whatsapp {
            background-color: #45a049;
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

        .invoice {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h1>Invoice Details</h1>

        <?php
        // Check if student ID and invoice date are provided
        if (isset($_GET["student_id"]) && isset($_GET["invoice_date"])) {
            // Get student ID and invoice date from the URL parameters
            $student_id = $_GET["student_id"];
            $invoice_date = $_GET["invoice_date"];

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

            // Fetch invoice details from the database based on student ID and invoice date
            $sql = "SELECT * FROM invoices WHERE student_id = '$student_id' AND invoice_date = '$invoice_date'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output invoice details in an invoice format
                while ($row = $result->fetch_assoc()) {
					$invoice_id = $row["invoice_id"];
                    $invoice_date = $row["invoice_date"];
                    $student_name = $row["student_name"];
                    $speech = $row["speech_therapy"];
					$ot = $row["ot"];
					$special_ed = $row["special_ed"];
					$group = $row["group_session"];
                    $total_amount = $row["total_amount"];

                    // Display invoice details in the invoice format
                    echo "<div class='invoice'>";
                    echo "<h2>Invoice</h2>";
                    echo "<p><strong>Invoice Date:</strong> $invoice_date</p>";
                    echo "<p><strong>Invoice Number:</strong> $invoice_id</p>";
					echo "<p><strong>Student Name:</strong> $student_name</p>";
                    echo "<table>";
					echo "<tr><th>Service</th><th>Price</th></tr>";
                    echo "<tr><td>Speech Therapy</td><td>" . "$speech" . " INR</td></tr>";
                    echo "<tr><td>Occupational Therapy</td><td>" . "$ot" . " INR</td></tr>";
					echo "<tr><td>Special Education</td><td>" . "$special_ed" . " INR</td></tr>";
					echo "<tr><td>Group Session</td><td>" . "$group" . " INR</td></tr>";
					echo "<tr><td><strong>Toatl Amount to be paid</strong></td><td>" . "<strong>$total_amount INR</strong>" . "</td></tr>";
                    echo "</table>";
                    echo "</div>";
                }
            } else {
                echo "No invoice found for the selected student and date.";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "Student ID and/or invoice date not provided.";
        }
        ?>
		<button class="print-button" onclick="window.print()">Print</button>
    </div>
	<script>
        function shareToWhatsApp() {
            // Construct the message with invoice details
            const invoiceDetails = "Your invoice details here...";

            // Encode the message for URL
            const encodedMessage = encodeURIComponent(invoiceDetails);

            // WhatsApp URL with pre-filled message
            const whatsappURL = `https://api.whatsapp.com/send?text=${encodedMessage}`;

            // Open WhatsApp in a new window
            window.open(whatsappURL, '_blank');
        }
    </script>

</body>
</html>
