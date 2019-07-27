<?php
/*
 * Following code will list all lecture timetable based on the modules in the user's module list
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
    $sql = "SELECT u.moduleNo,moduleName,day,TIME_FORMAT(start_at, '%h:%i %p')start_at,TIME_FORMAT(end_at, '%h:%i %p')end_at,location,room
                        FROM user_moduleList u
                        JOIN lectureTimetable l ON u.moduleNo= l.moduleNo
                        JOIN moduleTable m ON m.moduleNo=u.moduleNo
                        WHERE u.oauth_uid=?
                        ORDER BY day ASC, start_at DESC"  ;
    
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
        $response["lectureTimetable"] = array();

            // Loop through all results from Database
        while ($row = mysqli_fetch_array($result)) 
         {
                    // Assign results for each database row, to temp module array
                $module = array();
                $module["module_id"] = $row["moduleNo"];
                $module["moduleName"] = $row["moduleName"];
                $module["day"] = $row["day"];
                $module["start_at"] = $row["start_at"];
                $module["end_at"] = $row["end_at"];
                $module["location"] = $row["location"];
                $module["room"] = $row["room"];

           // push single module into final response array
            array_push($response["lectureTimetable"], $module);
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