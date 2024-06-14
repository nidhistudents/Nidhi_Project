<?php session_start(); ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nidhi_students";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, first_name, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
	$stmt->store_result();	
   
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $username, $db_password, $role);
        $stmt->fetch();
		
        if ($password ==  $db_password) {  
            $_SESSION['user_id'] = $id;
			$_SESSION['first_name'] = $first_name;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header('Location: main_page_index.php');
            exit;
        } else {
            $error = "Invalid password.";
        }
	} else {
        $error = "Invalid username.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'logo.php'; ?> <!-- Include the logo -->
    <div class="container">
	    <h2>Welcome to Student management System of Nidhi Foundation for Early Intervention</h2>
        <h4>Sign in with your account</h4>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
		<div class="register-link">
            <p>Not registered faculty?</p>
            <a href="register.php" class="button">Create account</a>
        </div>
    </div>
</body>
</html>
