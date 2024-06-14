<?php include 'session_control.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Therapies</title>
    <!-- Add your CSS styles here -->
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
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .add-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
        <h1>Add Therapies</h1>
        <!-- Check if the student ID is provided -->
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $studentId = $_GET['id'];

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

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_therapy'])) {
                $selectedTherapies = $_POST['therapy'];

                // Insert selected therapies into therapies_taken table
                foreach ($selectedTherapies as $therapyId) {
                    $insertSql = "INSERT INTO therapies_taken (student_id, therapy_id) VALUES ('$studentId', '$therapyId')";
                    if ($conn->query($insertSql) !== TRUE) {
                        echo "<script>alert('Error adding therapy: " . $conn->error . "');</script>";
                        break;
                    }
                }

                // Redirect back to view_therapies page
                header("Location: view_therapies.php?id=$studentId");
                exit();
            }

            // Retrieve all available therapies from the therapies table
            $sql = "SELECT therapy_id, service_description FROM therapies";
            $result = $conn->query($sql);

            // Display available therapies
            if ($result->num_rows > 0) {
                echo "<form method='post'>";
                echo "<input type='hidden' name='student_id' value='$studentId'>";
                echo "<table>";
                echo "<tr><th>Therapy Name</th><th>Action</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["service_description"] . "</td>";
                    echo "<td><input type='checkbox' name='therapy[]' value='{$row['therapy_id']}'></td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<input type='submit' name='add_therapy' class='add-button' value='Add Selected Therapies'>";
                echo "</form>";
            } else {
                echo "<p>No therapies available.</p>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No student ID provided.</p>";
        }
        ?>
    </div>
</body>
</html>
