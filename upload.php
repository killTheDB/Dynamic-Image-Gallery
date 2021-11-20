<?php 

if(isset($_POST['my_secret_key'])) {
	$my_key = $_POST['my_secret_key'];
	$key = "nyanpasu";
	if (strcmp($my_key,$key) == 0) {
		if (isset($_POST['submit']) && isset($_FILES['my_image']) && isset($_POST['my_image_name'])) {
			include "db_conn.php";

			echo "<pre>";
			print_r($_FILES['my_image']);
			echo "</pre>";

			$img_name = $_FILES['my_image']['name'];
			$img_size = $_FILES['my_image']['size'];
			$tmp_name = $_FILES['my_image']['tmp_name'];
			$display_img_name = $_POST['my_image_name'];
			// $date = "" . date("Y-m-d");
			// $time = "" . date("h:i:sa");
			// $upload_time = $date." ".$time;
			$error = $_FILES['my_image']['error'];

			if ($error === 0) {
				if ($img_size > 545000) {
					$em = "Sorry, your file is too large.";
					header("Location: index.php?error=$em");
				}else {
					$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
					$img_ex_lc = strtolower($img_ex);

					$allowed_exs = array("jpg", "jpeg", "png"); 

					if (in_array($img_ex_lc, $allowed_exs)) {
						$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
						$img_upload_path = 'uploads/'.$new_img_name;
						move_uploaded_file($tmp_name, $img_upload_path);

						// Insert into Database
						$sql = "INSERT INTO images(image_url, image_name) 
								VALUES('$new_img_name', '$display_img_name')";
						mysqli_query($conn, $sql);
						header("Location: view.php");
					}else {
						$em = "You can't upload files of this type";
						header("Location: index.php?error=$em");
					}
				}
			}else {
				$em = "unknown error occurred!";
				header("Location: index.php?error=$em");
			}

		}
		else {
			header("Location: index.php");
		}
	}
	else {
		$em = "Enter a valid token";
		header("Location: index.php?error=$em");
	}
}
else {
	$em = "Provide token";
	header("Location: index.php?error=$em");
}