<?php include 'session_control.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff; /* Set background color to a whitish blue */
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
        h1 {
            text-align: center;
            color: #333;
        }
        .student-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .student {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .student h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	<a href="main_page_index.php" class="home-button"><i class="fas fa-home"></i>Home</a>
        <h1>Search Results</h1>

        <?php
        // Check if the search query is provided
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            // Retrieve the search query
            $searchQuery = $_GET['query'];

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

            // Prepare and execute SQL query
            $sql = "SELECT * FROM students WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%'";
            $result = $conn->query($sql);

            // Display search results
            if ($result->num_rows > 0) {
                echo "<ul class='student-list'>";
                while($row = $result->fetch_assoc()) {
                    echo "<li class='student' onclick=\"viewStudentDetails('" . $row['student_id'] . "')\">";
                    echo "<h2>" . $row["first_name"] . " " . $row["last_name"] . "</h2>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No results found.</p>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<p>No search query provided.</p>";
        }
        ?>

        <script>
            // Function to redirect to student details page
            function viewStudentDetails(studentId) {
                window.location.href = "student_details.php?id=" + studentId;
            }
        </script>
    </div>
</body>
</html>
