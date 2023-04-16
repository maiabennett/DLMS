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
$donorID = $_post['donorID'];
$run = $_post['run'];
$lead = $_post['lead'];
$magnet = $_post['magnet'];
$targets = $_post['targets'];
$staining = $_post['staining'];
$flow = $_post['flow'];
$comments = $_post['comments'];

/* Insert values into assay */
$sql = "insert into assay values '". $assayID ."', '". $donorID ."', '". $run ."', '". $lead ."', '". $magnet ."', '". $targets ."', '". $staining ."', '". $flow ."', '". $comments ."'";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>
