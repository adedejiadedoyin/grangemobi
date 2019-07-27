<?php
/*
 * Following code will list a selected (ie a single) article from the news table
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
    $sql = "SELECT * FROM news where id=?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_term);
        
    // Set parameters
    $param_term = $_REQUEST["id"];
    
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
    
    // Create Array called article inside response Array
    $response["article"] = array();
        
    
    $article = array();
    $article["title"] = $row["title"];
    $article["content"] = $row["content"];
    $article["has_video"] = $row["has_video"];
    $article["img_link"] = $row["img_link"];
    $article["video_link"] = $row["video_link"];
    
    // push single article into final response array
    array_push($response["article"], $article);
    

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