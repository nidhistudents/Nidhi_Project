<?php include 'session_control.php'; ?>
<?php
// Check if the form is submitted
    // Retrieve form 	data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
	$doa = $_POST['doa'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
	$profile_picture = $_POST['profile_picture'];
    $mother_name = $_POST['mother_name'];
    $father_name = $_POST['father_name'];
    $marital_status = $_POST['marital_status'];
    $education = $_POST['education'];
    $occupation = $_POST['occupation'];
    $other_languages = $_POST['other_languages'];
    $dominant_language = $_POST['dominant_language'];
    $understands_language = $_POST['understands_language'];
    $speaks_language = $_POST['speaks_language'];
    $who_speaks_language = $_POST['who_speaks_language'];
    $preferred_language = $_POST['preferred_language'];
    $adopted = $_POST['adopted'];
    $adoption_age = $_POST['adoption_age'];
    $knows_child = $_POST['knows_child'];
    $services = $_POST['services'];
    $service_details = $_POST['service_details'];
    $reason_for_referral = $_POST['reason_for_referral'];
    $current_difficulties = $_POST['current_difficulties'];
    $spends_time_with = $_POST['spends_time_with'];
    $sleep_well = $_POST['sleep_well'];
    $eat_well = $_POST['eat_well'];
    $get_along_with_children = $_POST['get_along_with_children'];
    $get_along_with_adults = $_POST['get_along_with_adults'];
    $understand_instructions = $_POST['understand_instructions'];
    $communicate_with_others = $_POST['communicate_with_others'];
    $play_with_others = $_POST['play_with_others'];
    $play_alone = $_POST['play_alone'];
	
	//Handle upload picture
	
	if($_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK)
	{
		$target_dir = "../uploads/"; // Directory to upload the profile pictures
		$target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["profile_pic"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
				$profile_pic_path = $target_file;
				echo "path pf photo is",$profile_pic_path;
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}

    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nidhi_students";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die('connection failed : '.$conn->connect_error);
    }else{
             // Prepare SQL statement
		//$ins = "INSERT INTO students (first_name, last_name, gender, dob, doa, age, address, contact_number, mother_name, father_name, marital_status, education, occupation, other_languages, dominant_language, understands_language, speaks_language, who_speaks_language, preferred_language, adopted, adoption_age, knows_child, services, service_details, reason_for_referral, current_difficulties, spends_time_with, sleep_well, eat_well, get_along_with_children, get_along_with_adults, understand_instructions, communicate_with_others, play_with_others, play_alone) 
          //  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?. ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
  
        $ins="INSERT INTO students (first_name, last_name, gender, dob, doa, age, address, contact_number, mother_name, father_name, marital_status, education, occupation, other_languages, dominant_language, understands_language, speaks_language, who_speaks_language, preferred_language, adopted, adoption_age, knows_child, services, service_details, reason_for_referral, current_difficulties, spends_time_with, sleep_well, eat_well, get_along_with_children, get_along_with_adults, understand_instructions, communicate_with_others, play_with_others, play_alone,profile_picture) 
            VALUES ('$first_name', '$last_name', '$gender', '$dob', '$doa', '$age', '$address', '$contact_number', '$mother_name', '$father_name', '$marital_status', '$education', '$occupation', '$other_languages', '$dominant_language', '$understands_language', '$speaks_language', '$who_speaks_language', '$preferred_language', '$adopted', '$adoption_age', '$knows_child', '$services', '$service_details', '$reason_for_referral', '$current_difficulties', '$spends_time_with', '$sleep_well', '$eat_well', '$get_along_with_children', '$get_along_with_adults', '$understand_instructions', '$communicate_with_others', '$play_with_others', '$play_alone', '$profile_pic_path')";

		$stmt = $conn->prepare($ins);
		
		$stmt->execute();
        echo "<script>alert('Registration Successful'); window.location.href = 'main_page_index.php';</script>";
    // Close database connection
	    $stmt->close();	
        $conn->close();
}
?>
