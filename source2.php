<?php 
// include database connection 
$host = "localhost";
$db_name = "group11_db";
$username = "root";
$password = "";

try{
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
 
catch(PDOException $exception){
    //to handle connection error
    echo "Connection error: " . $exception->getMessage();
}
 
// select the image 
$query = "select * from announcement WHERE AnnounceID = ?"; 
$stmt = $con->prepare( $query );
 
// bind the id of the image you want to select
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
 
// to verify if a record is found
$num = $stmt->rowCount();
 
if( $num ){
    // if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // specify header with content type,
    // you can do header("Content-type: image/jpg"); for jpg,
    // header("Content-type: image/gif"); for gif, etc.
    header("Content-type: image/png");
    
    //display the image data
    print $row['AnnounceMedia'];
    exit;
}else{
    //if no image found with the given id,
    //load/query your default image here
}
?>