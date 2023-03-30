<?php
include "populateData.php"; 

/* Target output directory */
$target-dir = "./members"
$name = $_post['name'];

/* Open document to write */
$writefile = fopen($target-dir . $name.'.txt', "w") or die ("Unable to open file!");

$text = "Member Information\n"
fwrite($writefile, $text);

/* Format, run, and print member info */
$obj = new populateData();
$row = $obj->getData("select * from members where name = '". $name ."'");

fwrite($writefile, $row);


/* Format, run, and print member contributions */
$text = "Member Contributions\n";

/* Get lead roles */
$text = "Assay lead\n";
$leads = $obj->getData("select assayID, donorID, run, lead, comments from flowpanel where lead = '". $name ."'");
foreach($leads as $row){ 
	fwrite($writefile, $row);
}

/* Get magnet roles */
$text = "Magnetic enrichment\n";
$magnets = $obj->getData("select assayID, donorID, run, magnet, comments from flowpanel where magnet = '". $name ."'");
foreach($magnets as $row){ 
	fwrite($writefile, $row);
}

/* Get target roles */
$text = "Target Staining\n";
$targets = $obj->getData("select assayID, donorID, run, targets, comments from flowpanel where target = '". $name ."'");
foreach($targets as $row){ 
	fwrite($writefile, $row);
}

/* Get staining roles */
$text = "Immunophenotype staining\n";
$stains = $obj->getData("select assayID, donorID, run, staining, comments from flowpanel where staining = '". $name ."'");
foreach($stains as $row){ 
	fwrite($writefile, $row);
}

/* Get flow roles */
$text = "Flow cytometry\n";
$flows = $obj->getData("select assayID, donorID, run, flow, comments from flowpanel where flow = '". $name ."'");
foreach($flows as $row){ 
	fwrite($writefile, $row);
}

fclose($writefile);

?>