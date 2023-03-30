<?php

/* Database connection setup */
$server="localhost";
$username="maiabennett";
$password="";
$database="maiabennett";

$connect = mysqli_connect($server,$username,"",$database);

if($connect->connect_error){
	echo "Something has gone terribly wrong";
	echo "Connection error:" .$connect->connect_error;
}

/* Get variables from POST */
$assayID = $_post['assayID'];
$filename = $_post['filename'];
$cond = $_post['cond'];
$FLID = $_post['FLID'];

/* Insert values into assay */
$sql = "insert into flowfiles (assayID, filename, cond, FLID) values ('". $assayID ."', '". $filename ."', '". $cond ."', '". $FLID ."')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
