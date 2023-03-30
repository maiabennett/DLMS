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
$donorID = $_post['donorID'];
$age = $_post['age'];
$ethnicity = $_post['ethnicity'];
$sex = $_post['sex'];
$collected = $_post['collected'];
$comments = $_post['comments'];

/* Insert values into metadata */
$sql = "insert into metadata values '" . $donorID ."', ". $age .", '". $ethnicity ."', '". $sex ."', '". $collected ."', '". $comments ."'";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>