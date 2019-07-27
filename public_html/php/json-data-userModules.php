<?php

/*
 * Following code will list all the modules in the user's module list
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

 // Prepare a select statement
    $sql = "SELECT m.moduleName,m.moduleNo,m.credits,l.firstName,l.lastName
                        FROM user_moduleList u
                        JOIN moduleTable m ON u.moduleNo= m.moduleNo
                        JOIN lecturerTable l ON m.moduleNo=l.moduleNo1 OR m.moduleNo=l.moduleNo2 
                        WHERE u.oauth_uid=? ORDER BY id DESC"  ;
    
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_term);
        

    $param_term =$_REQUEST["userID"];//"2302245200057298" ;
    
    //execute statement
    mysqli_stmt_execute($stmt);
    
    // Query database
    $result = mysqli_stmt_get_result($stmt);


    // check for empty result   
    if (mysqli_num_rows($result) > 0)
     {

            // Create Array for JSON response
            $response = array();

        // Create Array called modules inside response Array
        $response["userModules"] = array();

            // Loop through all results from Database
        while ($row = mysqli_fetch_array($result)) 
         {
                    // Assign results for each database row, to temp module array
                $module = array();
                $module["moduleName"] = $row["moduleName"];
                $module["moduleNo"] = $row["moduleNo"];
                $module["credits"] = $row["credits"];
                $module["firstName"] = $row["firstName"];
                $module["lastName"] = $row["lastName"];

           // push single module into final response array
            array_push($response["userModules"], $module);
        }
        // success
        $response["success"] = 1;

        // print JSON response
        print (json_encode($response));

    }
    else {
        // no modules found
        $response["success"] = 0;
        $response["message"] = "No modules found";
        
      // die(mysql_error());

        // print no modules JSON
        print (json_encode($response));
    }
?>