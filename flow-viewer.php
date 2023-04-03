<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="styles.css">

</head>
<body>

<?php include 'populateData.php'; ?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>

<!-- Navigation -->	
<ul>
        <li><a href="home.php">Homepage</a></li>
        <li><a href="data-manager.php">Flow data manager</a></li>
        <li><a href="flow-analysis.php">Flow data analysis</a></li>
        <li class = "active"><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<div class="header-imm">
</div>

<!-- Left, add compensation file -->
<button class = "open-button-l" onclick = "openFormleft()">Add new compensation matrix</button>

<!-- Popup bar options: Similar to flow files, the matrix name is currently manual input further validation is needed for file upload and path parsing -->
<div class = "form-popup-l" id = "addComp">
	<form class = "form-container-l" method = "post" id = "addCompform">
		<h1> New compensation matrix </h1>

		<label for = "compID"><b>Compensation matrix ID</b></label>
		<input type = "text" placeholder = "Unique ID, ex., immunoNKcomp" name = "compID" id = "compID" required>

		<label for="matrix"><b>Matrix file name</b></label>
		<input type="text" placeholder="Ex., comp.mtx" name="matrix" id = "matrix" required>

		<!--
		<form action="uploadFile.php" method="post" enctype="multipart/form-data">
		File upload location:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload File" name="submit">
		</form>
		-->
		
		<input type="button" class="btn" id="submitComp" onclick="SubmitCompData()" value="Add compensation matrix" />
		<button type="button" class="btn cancel" onclick="closeFormleft()">Close</button>
	</form>
</div>

<script>
function openFormleft() {
	document.getElementById("addComp").style.display = "block";
}

function closeFormleft() {
	document.getElementById("addComp").style.display = "none";
}

function SubmitCompData() {
    var compID = $("#compID").val();
    var matrix = $("#matrix").val();
    $.post("addComp.php", { donorID: donorID, age: age, ethnicity: ethnicity, sex: sex, collected: collected, comments: comments },
    function(data) {
	 alert(data);
	 $('#addCompform')[0].reset();
    });
}
</script>

<!-- Center, add flow panel and markers -->
<button class = "open-button-rtop" onclick = "openFormMarker()">Add new conjugated fluorophore</button>
<button class = "open-button-rbottom" onclick = "openFormPanel()">Add new flow panel</button>

<!-- Popup panel bar options -->
<div class = "form-popup-r" id = "addMarker">
        <form class = "form-container-r" method = "post" id = "addMarkerform">
		<h1> New conjugated fluorophore </h1>

		<label for="marker"><b>Marker name</b></label>
		<input type="text" placeholder="Ex., CD56" name="marker" id="marker" required>

		<label for="fluor"><b>Fluorophore name</b></label>
		<input type="text" placeholder="Ex., APC" name="fluor" id="fluor" required>

		<label for="catID"><b>Catalogue information</b></label>
		<input type="text" placeholder="Ex., BioLegend cat# or eBioscience clone 1111" name="catID" id="catID" required>

		<input type="button" class="btn" id="submitMarker" onclick="SubmitMarkerData()" value="Add conjugated fluorophore" />
		<button type="button" class="btn cancel" onclick="closeFormMarker()">Close</button>

	</form>
</div>


<!-- // Popup panel bar options -->
<div class = "form-popup-r" id = "addPanel">
        <form class = "form-container-r" method = "post" id = "addPanelform">
		<h1> New flow cytometry panel </h1>
		<h2> Not seeing your conjugated fluorophores? Click on the other button! </h2>

		<label for="FLID"><b>Flow panel ID</b></label>
		<input type="text" placeholder="Ex., immunoNK" name="FLID" id="FLID" required>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL1"><b>FL1</b></label>
		<select name="FL1" id="FL1" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL1'] ?> </option>
		<?php  } ?>
		</select>
		
		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL2"><b>FL2</b></label>
		<select name="FL2" id="FL2" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL2'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL3"><b>FL3</b></label>
		<select name="FL3" id="FL3" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL3'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL4"><b>FL4</b></label>
		<select name="FL4" id="FL4" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL4'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL5"><b>FL5</b></label>
		<select name="FL5" id="FL5" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL5'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL6"><b>FL6</b></label>
		<select name="FL6" id="FL6" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL6'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL7"><b>FL1</b></label>
		<select name="FL7" id="FL7" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL7'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select markerID from markers");
		?>
		<label for="FL8"><b>FL1</b></label>
		<select name="FL8" id="FL8" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['FL8'] ?> </option>
		<?php  } ?>
		</select>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select compID from comp");
		?>
		<label for="compID-r"><b>Compensation matrix ID</b></label>
		<select name="compID" id="compID-r" form="addPanelform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['compID'] ?> </option>
		<?php  } ?>
		</select>

		<label for="iscurrent"><b>Is this panel currently used?</b></label>
		<select name="iscurrent" id="iscurrent" form="addPanelform">
			<option value="Y">Yes</option>
			<option value="N">No</option>
		</select>

		<label for="comments-r"><b>Comments</b></label>
                <input type="text" placeholder="Panel comments" name="comments" id = "comments-r">

		<input type="button" class="btn" id="submitPanel" onclick="SubmitPanelData()" value="Add panel" />
		<button type="button" class="btn cancel" onclick="closeFormPanel()">Close</button>

	</form>
</div>

<script>
function openFormMarker() {
	document.getElementById("addMarker").style.display = "block";
}

function closeFormMarker() {	
	document.getElementById("addMarker").style.display = "none";
}

function openFormPanel() {
	document.getElementById("addPanel").style.display = "block";
}

function closeFormPanel() {	
	document.getElementById("addPanel").style.display = "none";
}

function SubmitMarkerData() {
    var marker = $("#marker").val();
    var fluor = $("#fluor").val();
    var catID = $("#catID").val();
    $.post("addMarker.php", { marker: marker, fluor: fluor, catID: catID },
    function(data) {
	 alert(data);
	 $('#addMarkerform')[0].reset();
    });
}

function SubmitPanelData() {
    var FLID = $("#FLID").val();
    var FL1 = $("#FL1").val();
    var FL2 = $("#FL2").val();
    var FL3 = $("#FL3").val();
    var FL4 = $("#FL4").val();
    var FL5 = $("#FL5").val();
    var FL6 = $("#FL6").val();
    var FL7 = $("#FL7").val();
    var FL8 = $("#FL8").val();
    var compID = $("#compID-r").val();
    var iscurrent = $("#iscurrent").val();
    var comments = $("#comments").val();
    $.post("addAssay.php", { FLID: FLID, FL1: FL1, FL2: FL2, FL3: FL3, FL4: FL4, FL5: FL5, FL6: FL6, FL7: FL7, FL8: FL8, compID: compID, iscurrent: iscurrent, comments: comments },
    function(data) {
	 alert(data);
	 $('#addAssayform')[0].reset();
    });
}
</script>

<!-- not currently working, possibly due to php malfunctions
function SubmitPanelData() {
    var FLID = $("#FLID").val();
    var FL1 = $("select#FL1 option:checked").val();
    var FL2 = $("select#FL2 option:checked").val();
    var FL3 = $("select#FL3 option:checked").val();
    var FL4 = $("select#FL4 option:checked").val();
    var FL5 = $("select#FL5 option:checked").val();
    var FL6 = $("select#FL6 option:checked").val();
    var FL7 = $("select#FL7 option:checked").val();
    var FL8 = $("select#FL8 option:checked").val();
    var compID = $("select#compID-r option:checked").val();
    var iscurrent = $("#iscurrent").val();
    var comments = $("#comments").val();
    $.post("addAssay.php", { FLID: FLID, FL1: FL1, FL2: FL2, FL3: FL3, FL4: FL4, FL5: FL5, FL6: FL6, FL7: FL7, FL8: FL8, compID: compID, iscurrent: iscurrent, comments: comments },
    function(data) {
	 alert(data);
	 $('#addAssayform')[0].reset();
    });
}
-->

<!-- Right, print flowpanel -->
// Table viewer
<div style= "overflow-x:auto;" class = "table-flow">
	<table class = "result" name = "result" id = "result">
         	<tr>
		<th>FLow panel ID</th>
		<th>FL1</th>
		<th>FL2</th>
		<th>FL3</th>
		<th>FL4</th>
		<th>FL5</th>
		<th>FL6</th>
		<th>FL7</th>
		<th>FL8</th>
		<th>Associated comp matrix</th>
		<th>Current?</th>
		<th>Comments</th>
		</tr>

		<?php
	      	$obj = new populateData();
	      	$row = $obj->getData("select * from flowpanel");

			foreach($row as $row){ 
		?>
		<tr>
		<td> <?php echo $row['FLID'] ?> </td>
		<td> <?php echo $row['FL1'] ?> </td>
		<td> <?php echo $row['FL2'] ?> </td>
		<td> <?php echo $row['FL3'] ?> </td>
		<td> <?php echo $row['FL4'] ?> </td>
		<td> <?php echo $row['FL5'] ?> </td>
		<td> <?php echo $row['FL6'] ?> </td>
		<td> <?php echo $row['FL7'] ?> </td>
		<td> <?php echo $row['FL8'] ?> </td>
		<td> <?php echo $row['compID'] ?> </td>
		<td> <?php echo $row['iscurrent'] ?> </td>
		<td> <?php echo $row['comments'] ?> </td>
		</tr>

		<?php  } ?>

	</table>

	<input type="button" class="button" id="tst" value="Print flow panel" onclick="fnselect()" />
</div>

<script>
<!-- Only need to pass the primary key (FLID) to PHP function which builds result -->
function highlight(e) {
    if (selected[0]) selected[0].className = '';
    e.target.parentNode.className = 'selected';
}

var table = document.getElementById('result'),
selected = table.getElementsByClassName('selected');
table.onclick = highlight;

function fnselect(){
    var FLID = $("tr.selected td:first").val();
    $.post("printPanel.php", { FLID: FLID });
}
</script>

</body>
</html>

