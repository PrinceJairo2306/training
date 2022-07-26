<?php
session_start();
header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
include('connection.php');

if (isset($_GET['email']) && $_GET['email']!="") {

	$email = $_GET['email'];
	$query = "SELECT * FROM `tbl_registration` WHERE email='$email'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	
	if($row['password'] != $_GET['password']){
		$response["status"] = "false";
		$response["message"] = "Invalid Login Credentials";
		echo json_encode($response); exit;
	}


	$personData['person_id'] = $row['id'];
	$personData['person_first_name'] = $row['first_name'];
	$personData['person_last_name'] = $row['last_name'];
	$personData['email'] = $row['email'];
	$personData['password'] = $row['password'];
	

	$response["status"] = "true";
	$response["message"] = "Person Details";
	$response["customer"] = $personData;



} else {
	$response["status"] = "false";
	$response["message"] = "No customer(s) found!";
}
echo json_encode($response); exit;


?>