<?php

/*
 * Following code is for authentication of the user
 */
//Enable cross domain Communication - Beware, this can be a security risk 
header('Access-Control-Allow-Origin: http://localhost:8383');

//include db connect class
require_once 'db_connect.php';

// Get access to datbase instance 
$db = Database::getInstance();

// Get database connection from database
$conn = $db->getConnection(); 

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Convert JSON data into PHP variable
$userData = json_decode($_POST['userData']);
if(!empty($userData)){
    $oauth_provider = $_POST['oauth_provider'];
    //Check whether user data already exists in database
    $prevQuery = "SELECT * FROM users WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$userData->id."'";

    $prevResult = $conn->query($prevQuery);
    if($prevResult->num_rows > 0){ 
        //Update user data if already exists
        $query = "UPDATE users SET first_name = '".$userData->first_name."', last_name = '".$userData->last_name."', email = '".$userData->email."', gender = '".$userData->gender."', locale = '".$userData->locale."', picture = '".$userData->picture->data->url."', link = '".$userData->link."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$userData->id."'";
        $update = $conn->query($query);
    }else{
        //Insert user data
        $query = "INSERT INTO users SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$userData->id."', first_name = '".$userData->first_name."', last_name = '".$userData->last_name."', email = '".$userData->email."', gender = '".$userData->gender."', locale = '".$userData->locale."', picture = '".$userData->picture->data->url."', link = '".$userData->link."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
        $insert = $conn->query($query);
    }
}
?>
