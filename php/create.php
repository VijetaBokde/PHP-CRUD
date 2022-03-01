<?php 

if (isset($_POST['create'])) {
	include "../db_conn.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$phone_no = validate($_POST['phone_no']);

	$user_data = 'name='.$name. '&email='.$email. '&phone_no='.$phone_no;

	if (empty($name)) {
		header("Location: ../index.php?error=Name is required&$user_data");
	}else if (empty($email)) {
		header("Location: ../index.php?error=Email is required&$user_data");
	}else if (empty($phone_no)) {
		header("Location: ../index.php?error=phone-no is required&$user_data");
	}
	else {

       $sql = "INSERT INTO users(name, email, phone_no) 
               VALUES('$name', '$email', '$phone_no')";
       $result = mysqli_query($conn, $sql);
       if ($result) {
       	  header("Location: ../read.php?success=successfully created");
       }else {
          header("Location: ../index.php?error=unknown error occurred&$user_data");
       }
	}

}