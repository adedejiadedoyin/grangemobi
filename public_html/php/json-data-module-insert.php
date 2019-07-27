<?php
/*
 * Following code will insert a module into a user's module list
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
$user_id = $_REQUEST["user_id"]; //"2302245200057298" ;//$_REQUEST["user_id"];
$moduleCode = $_REQUEST["moduleCode"]; //"999002" ;//$_REQUEST["moduleCode"];

// Create Array for JSON response
$response = array();





if (isModuleAlreadyAdded($conn,$user_id, $moduleCode)) {
    // found
    $response["success"] = 0;
    $response["message"] = "This module already exists in your module list";
    print (json_encode($response));
    
    //echo "<p>This module already exists in your module list-----You can't readd it again</p>";
    
}else if (!isModuleCodeValid($conn,$moduleCode)) {
    // found
    $response["success"] = 0;
    $response["message"] = "The code you entered is invalid or does not exist";
    print (json_encode($response));
   // echo "<p>The module code entered is invalid ie it does not exist</p>";
    
}else{
            // Attempt insert query execution
            $sql = "INSERT INTO user_moduleList (oauth_uid, moduleNo) VALUES (?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $_user_id,$_moduleCode);

            // Set parameters
            $_user_id = $user_id;
            $_moduleCode = $moduleCode;

            if(mysqli_stmt_execute($stmt)){
                
                $response["success"] = 1;
                $response["message"] = "Module has been added to your list";
                print (json_encode($response));
                
               // echo "Records inserted successfully.";
            } else{
                
                $response["success"] = 0;
                $response["message"] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                print (json_encode($response));
                
               // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
            // Close statement
            mysqli_stmt_close($stmt);
        
    }






    function isModuleAlreadyAdded($conn, $_user_id, $_module_id) {
        // Prepare a select statement
        $sql = "SELECT * FROM user_moduleList where oauth_uid=? and moduleNo=?";

        $stmt = mysqli_prepare($conn, $sql);

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $user_id,$moduleCode);

        // Set parameters
        $user_id = $_user_id;
        $moduleCode = $_module_id;

        //execute statement
        mysqli_stmt_execute($stmt);

        // Query database
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0){
            return true;
        }else{ 
            return false;
        }    

        
    }
    
    
    
    
    function isModuleCodeValid($conn,$_module_id) {
        // Prepare a select statement
        $sql = "SELECT * FROM moduleTable where moduleNo=?";

        $stmt = mysqli_prepare($conn, $sql);

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i",$moduleCode);

        // Set parameters
        $moduleCode = $_module_id;

        //execute statement
        mysqli_stmt_execute($stmt);

        // Query database
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0){
            return true;
        }else{ 
            return false;
        }    

        
    }
    
    

    





 
// close connection
mysqli_close($conn);
?>