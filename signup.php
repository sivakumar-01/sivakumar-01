<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$psw1 = $_POST['psw1'];
$psw2 = $_POST['psw2'];

if(!empty($firstname)||!empty($lastname)||!empty($email)||!empty($psw1)||!empty($psw2))
{
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="project";

$conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);

if(mysqli_connect_error()){
	die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
	$SELECT = "SELECT email FROM signup WHERE email =? LIMIT 1";

	$INSERT = "INSERT Into signup(firstname,lastname,email,psw1,psw2) values(?,?,?,?,?)";

	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$stmt = $stmt->num_rows;

	if($firstname==0)
	{
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("sssss",$firstname,$lastname,$email,$psw1,$psw2);
		$stmt->execute();
		echo "New record inserted sucessfully";
	}
	else{
		echo "Already registered using this email";
	}

	$stmt->close();
	$conn->close();
	}
}
else{
	echo "All field are required";
	die();
}
?>
