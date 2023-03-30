<?php
include "populateData.php"; 

/* Target output directory */
$target-dir = "./flow-panels"
$FLID = $_post['FLID'];

/* Open document to write */
$writefile = fopen($target-dir . $FLID.'.txt', "w") or die ("Unable to open file!");

$text = "Panel Setup\n"
fwrite($writefile, $text);

/* Format, run, and print panel query */
$obj = new populateData();
$row = $obj->getData("select * from flowpanel where FLID = '". $FLID ."'");

fwrite($writefile, $row);


/* Format, run, and print marker info */
$text = "Marker Information\n";

/* Get markerID from panel */
$FL1 = $obj->getData("select FL1 from flowpanel where FLID = '". $FLID ."'");
$FL2 = $obj->getData("select FL2 from flowpanel where FLID = '". $FLID ."'");
$FL3 = $obj->getData("select FL3 from flowpanel where FLID = '". $FLID ."'");
$FL4 = $obj->getData("select FL4 from flowpanel where FLID = '". $FLID ."'");
$FL5 = $obj->getData("select FL5 from flowpanel where FLID = '". $FLID ."'");
$FL6 = $obj->getData("select FL6 from flowpanel where FLID = '". $FLID ."'");
$FL7 = $obj->getData("select FL7 from flowpanel where FLID = '". $FLID ."'");
$FL8 = $obj->getData("select FL8 from flowpanel where FLID = '". $FLID ."'");

/* Get marker info from markers */
$FL1m = $obj->getData("select * from markers where markerID = '". $FL1 ."'");
$FL2m = $obj->getData("select * from markers where markerID = '". $FL2 ."'");
$FL3m = $obj->getData("select * from markers where markerID = '". $FL3 ."'");
$FL4m = $obj->getData("select * from markers where markerID = '". $FL4 ."'");
$FL5m = $obj->getData("select * from markers where markerID = '". $FL5 ."'");
$FL6m = $obj->getData("select * from markers where markerID = '". $FL6 ."'");
$FL7m = $obj->getData("select * from markers where markerID = '". $FL7 ."'");
$FL8m = $obj->getData("select * from markers where markerID = '". $FL8 ."'");

fwrite($writefile, $FL1m);
fwrite($writefile, $FL2m);
fwrite($writefile, $FL3m);
fwrite($writefile, $FL4m);
fwrite($writefile, $FL5m);
fwrite($writefile, $FL6m);
fwrite($writefile, $FL7m);
fwrite($writefile, $FL8m);

fclose($writefile);

?>