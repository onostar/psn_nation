<?php
include "connections.php";
$pcn = "031363";
// Initiate curl session in a variable (resource)
$curl_handle = curl_init();
// endpoint to the api that has the data you want to retrieve

$url = "https://pharmagateway.com.ng/settlements/api_get_nationaldue_status/Nat_psn_capitation/1/".$pcn."/2023";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable. you data is in this variable $curl_data
$curl_data = curl_exec($curl_handle);
// print_r($curl_data);

curl_close($curl_handle);
// Decode JSON into PHP array
$response_data = json_decode($curl_data, true);
print_r($response_data);
// print_r(gettype($response_data['success']));
//check of object returned pharmacist data
if($response_data['success'] != 1){
	echo $pcn;
}else{


	//UNCOMMENT HERE TO SEE DATA
	// Print all data if needed
	// print_r($response_data);
	// die();

	// All user data exists in 'data' object
	// $user_data = $response_data->data;

	$email = $response_data['data']['memberemail'];
	//get other details from the object
	$details = json_decode($response_data['data']['memberdetails']);
	$reg_number =  $details->regno;
	$full_details = $details->fullname;
	// echo $full_name;
	//convert full details string to array
	$details_array = explode(" ", $full_details);
	$last_name = $details_array[0];
	$last_name = trim($last_name, ",");
	// echo $last_name;
	$first_name = $details_array[1];
	//insert into paid members
	$data = $connectdb->prepare("INSERT INTO paid_members(pcn_number, user_email, last_name, first_name) VALUES (:pcn_number, :user_email, :last_name, :first_name)");
	$data->bindvalue("pcn_number", $pcn);
	$data->bindvalue("user_email", $email);
	$data->bindvalue("last_name", $last_name);
	$data->bindvalue("first_name", $first_name);
	$data->execute();
	//YOU CAN CHECK IF INSERT IS SUCCESSFUL;
}