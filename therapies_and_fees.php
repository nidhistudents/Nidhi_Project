<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapies and Fees</title>
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
    <div class="container">
        <h1>Therapies and Fees</h1>
        <table>
            <thead>
                <tr>
                    <th>Therapy</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
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

                // Retrieve therapy details from the database
                $sql = "SELECT service_description, unit_price FROM therapies";
                $result = $conn->query($sql);

                // Display therapy details in the table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["service_description"] . "</td>";
                        echo "<td>INR " . $row["unit_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No therapies found</td></tr>";
                }

                // Close database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
