<?php
/*
 * Following code will list all the articles (ie News)
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
    $sql_query = "SELECT * FROM news ORDER BY date_published DESC";
    
    // Query database using connection
    $result = $conn->query($sql_query);


// check for empty result
if (mysqli_num_rows($result) > 0)
 {
    
    
    
    	// Create Array for JSON response
	$response = array();
    
    // Create Array called lecturers inside response Array
    $response["headlines"] = array();
	
	// Loop through all results from Database
    while ($row = mysqli_fetch_array($result)) 
     {
        	// Assign results for each database row, to temp headline array
            $headline = array();
            $headline["id"] = $row["id"];
            $headline["title"] = $row["title"];
            $headline["category"] = $row["category"];
            $headline["img_link"] = $row["img_link"];
            $headline["date_published"] = $row["date_published"];
            
       // push single headline into final response array
        array_push($response["headlines"], $headline);
    }
    // success
    $response["success"] = 1;


    // print JSON response: the JSON_HEX_QUOT | JSON_HEX_TAG is important for html tags encoding (I stored plain HTML in the database)
    print (json_encode($response,JSON_HEX_QUOT | JSON_HEX_TAG));
   // print (json_encode($response));
}
else {
    // no lecturers found
    $response["success"] = 0;
    $response["message"] = "No article found";

    // print no lecturers JSON
    print (json_encode($response));
}

?>