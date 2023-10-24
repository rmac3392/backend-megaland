<center>	<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get the form data
	$prop_name = $_POST['prop_name'];
	$prop_desc = $_POST['prop_desc'];
	$prop_status = $_POST['prop_status'];
	$prop_category = $_POST['prop_category'];
	$prop_address = $_POST['prop_address'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$mobile_number = $_POST['mobile_number'];
	$email = $_POST['email'];

	// Set the email recipient
	$to = 'megalandrealtycebu@gmail.com';

	// Set the email subject
	$subject = 'Client New Property Listing';

	// Create a boundary string
	$boundary = md5(time());

	// Set the email headers
	$headers = "From: $email\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

	// Set the email message
	$message = "--$boundary\r\n";
	$message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
	$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	$message .= "Client Request A Property List\n\n";
	$message .= "Property Name: $prop_name\n";
	$message .= "Description: $prop_desc\n";
	$message .= "Property Status: $prop_status\n";
	$message .= "Category: $prop_category\n";
	$message .= "Address: $prop_address\n\n";
	$message .= "Contact Information:\n";
	$message .= "Name: $first_name $last_name\n";
	$message .= "Mobile Number: $mobile_number\n";
	$message .= "Email: $email\n\n";

	// Loop through each uploaded file and attach it to the email
	foreach ($_FILES['prop_images']['tmp_name'] as $key => $tmp_name) {
		$file_name = $_FILES['prop_images']['name'][$key];
		$file_size = $_FILES['prop_images']['size'][$key];
		$file_type = $_FILES['prop_images']['type'][$key];
		$file_content = file_get_contents($tmp_name);
		$file_content = chunk_split(base64_encode($file_content));

		$message .= "--$boundary\r\n";
		$message .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
		$message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
		$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
		$message .= "$file_content\r\n";
	}

	$message .= "--$boundary--";

	// Send the email
	if (mail($to, $subject, $message, $headers)) {
		echo '<p>Your property has been listed successfully. We will contact you shortly.</p>';
	} else {
		echo '<p>Sorry, something went wrong. Please try again later.</p>';
	}
}



?>
</center>
<!DOCTYPE html>
<html>
<head>
	<title>List Your Property</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<style>
		body {
			background-color: #fff3e0;
			font-family: Arial, sans-serif;
			color: #424242;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
		}
		form {
			margin: 0 auto;
			width: 50%;
			border: 2px solid #FFA500;
			padding: 20px;
		}
		input[type=text], textarea {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			resize: vertical;
		}
		select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: 2px solid #ccc;
			border-radius: 4px;
			background-color: #f8f8f8;
			resize: vertical;
		}
		input[type=submit],a {
			background-color: #FFA500;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type=submit], a:hover {
			background-color: #FF8C00;
		}

        input[type=email], input[type=tel] {
    border: 2px solid #ccc;
    border-radius: 4px;
    padding: 12px 20px;
    width: 100%;
    margin: 8px 0;
    box-sizing: border-box;
}
	</style>
</head>
<body>
	<div class="container">
		<h1>List Your Property</h1>
		<form action="#" method="post" enctype="multipart/form-data">
		    <a href="https://megalandrealty.com/">Back</a>
			<h3>Property Information</h3>
			<label for="prop_name">Property Name:</label>
			<input type="text" id="prop_name" name="prop_name" required>

			<label for="prop_desc">Description:</label>
			<textarea id="prop_desc" name="prop_desc" rows="4" cols="50" required></textarea>

			<label for="prop_images">Images (Select Images & Limit up to 4 pictures for fast loading):</label><br><br>
<input type="file" name="prop_images[]" multiple><br><br>

			<label for="prop_status">Property Status:</label>
			<select id="prop_status" name="prop_status" required>
				<option value="">--Select Status--</option>
				<option value="rent">For Rent</option>
				<option value="sale">For Sale</option>
			</select>

			<label for="prop_category">Category:</label>
			<select id="prop_category" name="prop_category" required>
				<option value="">--Select Category--</option>
				<option value="commercial">Commercial</option>
				<option value="condo">Condo</option>
				<option value="house">House</option>
				<option value="land">Land</option>
				<option value="townhouse">Townhouse</option>
			</select>

			<label for="prop_address">Address:</label>
			<textarea id="prop_address" name="prop_address" rows="4" cols="50" required></textarea>

			<h3>Personal Information</h3>
			<label for="first_name">First Name:</label>
			<input type="text" id="first_name" name="first_name" required>

			<label for="last_name">Last Name:</label>
			<input type="text" id="last_name" name="last_name" required>

			<label for="mobile_number">Mobile Number:</label>
			<input type="tel" id="mobile_number" name="mobile_number" required>

			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>

			<input type="submit" value="Submit">
		</form>
		
	</div>
	
</body>
</html>
