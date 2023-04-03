<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<?php include 'populateData.php'; ?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>


<ul>
        <li><a href="home.php">Homepage</a></li>
        <li class = "active"><a href="data-manager.php">Flow data manager</a></li>
        <li><a href="flow-analysis.php">Flow data analysis</a></li>
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<div class="header-imm">
</div>

<!-- Left, add human donor -->
<button class = "open-button-l" onclick = "openFormleft()">Add new human donor</button>

<!-- Popup bar options -->
<div class = "form-popup-l" id = "addDonor">
	<form class = "form-container-l" method = "post" id = "addCompform">
		<h1> New human donor </h1>

		<label for = "donorID"><b>Donor ID</b></label>
		<input type = "text" placeholder = "Enter donorID" name = "donorID" id = "donorID" required>

		<label for="age"><b>Age</b></label>
		<input type = "text" placeholder = "Enter age" name = "age" id = "age">

		<label for="ethnicity"><b>Race/Ethnicity</b></label>
		<input type = "text" placeholder = "Enter race/ethnicity" name = "ethnicity" id = "ethnicity">

		<label for="sex"><b>Sex<br></b></label>
		<select name="sex" id="sex" form="addDonorform">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select><br>

		<label for="collected"><b>Collection date</b></label>
		<input type = "date" name = "collected" id = "collected">

		<label for="comments"><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments" id = "comments">
		
		<input type="button" class="btn" id="submitDonor" onclick="SubmitDonorData()" value="Add donor" />
		<button type="button" class="btn cancel" onclick="closeFormleft()">Close</button>
	</form>
</div>

<script>

function openFormleft() {
	document.getElementById("addDonor").style.display = "block";
}

function closeFormleft() {
	document.getElementById("addDonor").style.display = "none";
}

function SubmitDonorData() {
    var donorID = $("#donorID").val();
    var age = $("#age").val();
    var ethnicity = $("#ethnicity").val();
    var sex = $("#sex").val();
    var collected = $("#date").val();
    var comments = $("#comments").val();
    $.post("addDonor.php", { donorID: donorID, age: age, ethnicity: ethnicity, sex: sex, collected: collected, comments: comments },
    function(data) {
	 alert(data);
	 $('#addDonorform')[0].reset();
    });
}

</script>



<!-- not currently working; might have to do with general php malfunctions
function SubmitDonorData() {
    var donorID = $("#donorID").val();
    var age = $("#age").val();
    var ethnicity = $("#ethnicity").val();
    var sex = $("select#sex option:checked").val();
    var collected = $("input[type="date"][name="collected"]").val();
    var comments = $("#comments").val();
    $.post("addDonor.php", { donorID: donorID, age: age, ethnicity: ethnicity, sex: sex, collected: collected, comments: comments },
    function(data) {
	 alert(data);
	 $('#addDonorform')[0].reset();
    });
}
-->


<!-- Center, add assay -->
<button class = "open-button-r" onclick = "openFormright()">Add new flow file</button>

<!-- Popup bar options -->
<div class = "form-popup-r" id = "addAssay">
        <form class = "form-container-r" method = "post" id = "addAssayform">
		<h1> New assay </h1>
		<h2> Make sure you've added the donor first! </h2>

		<label for="assayID"><b>Assay ID</b></label>
		<input type="text" placeholder="Ex., AM033a" name="assayID" id="assayID" required>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select donorID from metadata");
		?>
		<label for="donorID-r"><b>Donor ID</b></label>
		<select name="donorID" id="donorID-r" form="addAssayform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['donorID'] ?> </option>
		<?php  } ?>
		</select>
		
		<label for="run"><b>Run date</b></label>
		<input type="text" name="run" id = "run">

		<?php
			$obj = new populateData();
			$row = $obj->getData("select name from members");
		?>
		<label for="lead"><b>Assay lead</b></label>
		<select name="lead" id="lead" form="addAssayform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['name'] ?> </option>
		<?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="magnet"><b>Magnetic enrichment</b></label>
                <select name="magnet" id="magnet" form="addAssayform">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="targets"><b>Target cell staining</b></label>
                <select name="targets" id="targets" form="addAssayform">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
                </select>

		<?php
			$obj = new populateData();
			$row = $obj->getData("select name from members");
						                ?>
                <label for="staining"><b>Immunophenotype staining</b></label>
                <select name="staining" id="staining" form="addAssayform">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="flow"><b>Flow cytometry</b></label>
                <select name="flow" id="flow" form="addAssayform">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
                </select>

		<label for="comments-r"><b>Comments</b></label>
                <input type="text" placeholder="Assay comments" name="comments" id = "comments-r">

		<input type="button" class="btn" id="submitAssay" onclick="SubmitAssayData()" value="Add assay" />
		<button type="button" class="btn cancel" onclick="closeFormright()">Close</button>

	</form>
</div>

<script>

function openFormright() {
	document.getElementById("addAssay").style.display = "block";
}

function closeFormright() {	
	document.getElementById("addAssay").style.display = "none";
}

function SubmitAssayData() {
    var assayID = $("#assayID").val();
    var donorID = $("#donorID-r").val();
    var run = $("#run").val();
    var lead = $("#lead").val();
    var magnet = $("#magnet").val();
    var targets = $("#targets").val();
    var staining = $("#staining").val();
    var flow = $("#flow").val();
    var comments = $("#comments-r").val();
    $.post("addAssay.php", { assayID: assayID, donorID: donorID, run: run, lead: lead, magnet: magnet, targets: targets, staining: staining, flow: flow, comments: comments },
    function(data) {
	 alert(data);
	 $('#addAssayform')[0].reset();
    });
}

<!-- not currently working; might have to do with general php malfunctions
function SubmitAssayData() {
    var assayID = $("#assayID").val();
    var donorID = $("select#donorID-r option:checked").val();
    var run = $("input[type="date"] [name="run"]").val();
    var lead = $("select#lead option:checked").val();
    var magnet = $("select#magnet option:checked").val();
    var targets = $("select#targets option:checked").val();
    var staining = $("select#staining option:checked").val();
    var flow = $("select#flow option:checked").val();
    var comments = $("#comments").val();
    $.post("addAssay.php", { assayID: assayID, donorID: donorID, run: run, lead: lead, magnet: magnet, targets: targets, staining: staining, flow: flow, comments: comments },
    function(data) {
	 alert(data);
	 $('#addAssayform')[0].reset();
    });
} -->
</script>

<!-- Right, add files -->
<button class = "open-button-c" onclick = "openFormcenter()">Add new flow file</button>

<!-- Popup bar options: currently, file paths are not included and names are manually entered 
// File upload code is commented out but does have an associated file uploadFile.php 
// NEEDS UPDATING to work with file browser 
// to select input file, parse path and filename, 
// assign new path to assay name folder,
// and upload file + new path -->
<div class = "form-popup-c" id = "addFiles">
        <form class = "form-container-c" method = "post" id = "addFilesform">
		<h1> New flow cytometry files </h1>
		<h2> Make sure you've added the donor and assay first! </h2>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select assayID from assay");
		?>

		<label for="assayID-c"><b>Assay ID</b></label>
		<select name="assayID" id="assayID-c" form = "addFilesform">
		<?php foreach($row as $row){ ?>
			<option> <?php echo $row['assayID'] ?> </option>
		<?php  } ?>
		</select>

		<label for="filename"><b>File name</b></label>
		<input type="text" placeholder="Ex., NK unstim.fcs" name="filename" id = "filename" required>

		<!--
		<form action="uploadFile.php" method="post" enctype="multipart/form-data">
		File upload location:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload File" name="submit">
		</form>
		-->

		<label for="cond"><b></b>Condition tested</label>
		<input list="cond" id="cond" name="cond" required>
		<datalist id="cond">
			<option value="Untreated">
			<option value="Untreated + aCD20">
			<option value="TLR9a stimulated">
			<option value="TLR9a stimulated + aCD20">
			<option value="Untreated ADCC">
			<option value="Untreated direct">
			<option value="TLR9a stimulated ADCC">
			<option value="TLR9a stimulated direct">
		</datalist>

		<?php
			$obj = new populateData();
			$row = $obj->getData("select FLID from flowpanel");
		?>

                <label for="FLID"><b>Flow panel ID</b></label>
                <select name="FLID" id="FLID" form = "addFilesform">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['FLID'] ?> </option>
                <?php  } ?>
                </select>

		<input type="button" class="btn" id="submitFiles" onclick="SubmitFileData()" value="Add file" />
		<button type="button" class="btn cancel" onclick="closeFormcenter()">Close</button>

	</form>
</div>

<script>
function openFormcenter() {
	document.getElementById("addFiles").style.display = "block";
}

function closeFormcenter() {
 	document.getElementById("addFiles").style.display = "none";
}

function SubmitFileData() {
    var assayID = $("#assayID-c").val();
    var filename = $("#filename").val();
    var cond = $("#cond").val();
    var FLID = $("#FLID").val();
    $.post("addFiles.php", { assayID: assayID, filename: filename, connd: cond, FLID: FLID },
    function(data) {
	 alert(data);
	 $('#addFilesform')[0].reset();
    });
}
</script>
<!-- not currently working; might have to do with general php malfunctions
function SubmitFileData() {
    var assayID = $("select#assayID-c option:checked").val();
    var filename = $("#filename").val();
    var cond = $("input[type="list"] [name="cond"] option:checked").val();
    var FLID = $("select#FLID option:checked").val();
    $.post("addFiles.php", { assayID: assayID, filename: filename, connd: cond, FLID: FLID },
    function(data) {
	 alert(data);
	 $('#addFilesform')[0].reset();
    });
}
-->

</body>
</html>

