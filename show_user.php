<?php
require_once 'include/DB_Connect.php';
$conn = new DB_Connect();
$conn = $conn->connect();
 
// json response array
$response = array("error" => 1);
$sql = "SELECT * FROM tbl_user";
$result = mysqli_query($conn, $sql);

$response = array("error" => FALSE);

if($result){
    while($row = mysqli_fetch_array($result)){
        $response["error"] = FALSE;
        $response["uid"] = $row["unique_id"];
        $response["user"]["noktp"] = $row["noktp"];
        $response["user"]["nama"] = $row["nama"];
        $response["user"]["email"] = $row["email"];
        $response["user"]["nohp"] = $row["nohp"];
        $response["user"]["alamat"] = $row["alamat"];
        echo json_encode($response);
    }
}