<?php

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



    // Prepare a select statement
    $sql = "SELECT moduleNo,moduleName,credits,website,dueDate,location,room,lat,m.long,firstName,lastName,email
                                FROM moduleTable m
                                JOIN lecturerTable l  ON m.moduleNo= l.moduleNo1 OR m.moduleNo=l.moduleNo2 
                                WHERE m.moduleNo=?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_term);
        
    // Set parameters
    $param_term = $_REQUEST["module_id"];
    
    //execute statement
    mysqli_stmt_execute($stmt);
    
    // Query database
    $result = mysqli_stmt_get_result($stmt);



// check for empty result
if (mysqli_num_rows($result) > 0)
 {
    
    $row = mysqli_fetch_array($result);
	
    
    // Create Array for JSON response
    $response = array();
    
    // Create Array called module inside response Array
    $response["module"] = array();
        
    
    $module = array();
    $module ["moduleNo"] = $row["moduleNo"];
    $module ["moduleName"] = $row["moduleName"];
    $module ["credits"] = $row["credits"];
    $module ["website"] = $row["website"];
    $module ["dueDate"] = $row["dueDate"];
    $module ["location"] = $row["location"];
    $module ["room"] = $row["room"];
    $module ["lat"] = $row["lat"];
    $module ["long"] = $row["long"];
    $module["firstName"] = $row["firstName"];
    $module["lastName"] = $row["lastName"];
    $module["email"] = $row["email"];
    
    // push single article into final response array
    array_push($response["module"], $module);
    

    // success
    $response["success"] = 1;

    print (json_encode($response));

}
else {
    // no articles found
    $response["success"] = 0;
    $response["message"] = "No article found";

    // print no articles JSON
    print (json_encode($response));
}

?>