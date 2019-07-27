<?php
/*
 * Following code will delete a module from the user's module list
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
 
// Set parameters
$user_id = $_REQUEST["userID"]; //"2302245200057298" ;//$_REQUEST["user_id"];
$moduleCode = $_REQUEST["moduleCode"]; //"999002" ;//$_REQUEST["moduleCode"];


// Create Array for JSON response
$response = array();





     // Attempt insert query execution
            $sql = "DELETE FROM user_moduleList where oauth_uid=? and moduleNo=?";
            $stmt = mysqli_prepare($conn, $sql);
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $_user_id,$_moduleCode);

            // Set parameters
            $_user_id = $user_id;
            $_moduleCode = $moduleCode;

            if(mysqli_stmt_execute($stmt)){
                
                $response["success"] = 1;
                $response["message"] = "Module has been removed from your list";
                print (json_encode($response));
                
            } else{
                
                $response["success"] = 0;
                $response["message"] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                print (json_encode($response));
                
               // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            // Close statement
            mysqli_stmt_close($stmt);
   

// close connection
mysqli_close($conn);
?>