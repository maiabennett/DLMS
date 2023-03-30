<?php 
	include "populateData.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

<ul>
	<li><a href=""></a>Homepage</a></li>
	<li class = "active"><a href="data-manager.php"></a>Flow data manager</a></li>
	<li><a href=""></a>Flow data analysis</a></li>
	<li><a href=""></a>Flow panel viewer</a></li>
	<li><a href=""></a>Lab member viewer</a></li>
</ul>

<div class="header-imm">
</div>

<!-- Left, add human donor -->
<button class = "open-button-l" onclick = "openFormleft()">Add new human donor</button>

// Popup bar options
<div class = "form-popup-l" id = "addDonor">
	<form action = "./addDonor.php" class = "form-container-l">
		<h1> New human donor </h1>

		<label for = "donorID"><b>DonorID</b></label>
		<input type = "text" placeholder = "Enter donorID" name = "donorID" required>

		<label for="age"><b>Age</b></label>
		<input type = "text" placeholder = "Enter age" name = "age">

		<label for="ethnicity"><b>Race/Ethnicity</b></label>
		<input type = "text" placeholder = "Enter race/ethnicity" name = "ethnicity">

		<label for="sex"><b>Sex</b></label>
		<select name="sex" id="sex">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>

		<label for="collected"><b>Collection date</b></label>
		<input type = "date" name = "collected">

		<label for="comments"><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments">

		<button type="submit" class="btn">Add donor</button>
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
</script>

<!-- Right, add assay -->
<button class = "open-button-r" onclick = "openFormright()">Add new flow file</button>

// Popup bar options
<div class = "form-popup-r" id = "addAssay">
        <form action = "./addAssay.php" class = "form-container-r">
		<h1> New assay </h1>
		<h2> Make sure you've added the donor first! </h2>

		<label for="assayID"><b>Assay ID</b></label>
		<input type="text" placeholder="Ex., AM033a" name="assayID" required>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select donorID from metadata");
		?>
		<label for="donorID"><b>Donor ID</b></label>
		<select name="donorID" id="donorID">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['donorID'] ?> </option>
		<?php  } ?>
		</select>
		
		<label for="run"><b>Run date</b></label>
		<input type="text" name="run">

		<?php
			$obj = new populateData();
			$row = $obj->getData("select name from members");
		?>
		<label for="lead"><b>Assay lead</b></label>
		<select name="lead" id="lead">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['name'] ?> </option>
		<?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="magnet"><b>Magnetic enrichment</b></label>
                <select name="magnet" id="magnet">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="targets"><b>Target cell staining</b></label>
                <select name="targets" id="targets">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
                </select>

		<?php
			$obj = new populateData();
			$row = $obj->getData("select name from members");
						                ?>
                <label for="staining"><b>Immunophenotype staining</b></label>
                <select name="staining" id="staining">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
		</select>

		<?php
                        $obj = new populateData();
                        $row = $obj->getData("select name from members");
                ?>
                <label for="flow"><b>Flow cytometry</b></label>
                <select name="flow" id="flow">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['name'] ?> </option>
                <?php  } ?>
                </select>

		<label for="comments"><b>Comments</b></label>
                <input type="text" placeholder="Assay comments" name="comments" required>

	</form>
</div>

<script>
function openFormright() {
	document.getElementById("addAssay").style.display = "block";
}

function closeFormright() {	
	document.getElementById("addAssay").style.display = "none";
}
			</script>

<!-- Center, add files -->
<button class = "open-button-c" onclick = "openForm()">Add new flow file</button>

// Popup bar options: currently, file paths are not included and names are manually entered 
// File upload code is commented out but does have an associated file uploadFile.php 
// NEEDS UPDATING to work with file browser 
// to select input file, parse path and filename, 
// assign new path to assay name folder,
// and upload file + new path
<div class = "form-popup-c" id = "addFiles">
        <form action = "./addFiles.php" class = "form-container-c">
		<h1> New flow cytometry files </h1>
		<h2> Make sure you've added the donor and assay first! </h2>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select assayID from assay");
		?>

		<label for="assayID"><b>Assay ID</b></label>
		<select name="assayID" id="assayID">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['assayID'] ?> </option>
		<?php  } ?>
		</select>

		<label for="filename"><b>File name</b></label>
		<input type="text" placeholder="Ex., NK unstim.fcs" name="filename" required>

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
                <select name="FLID" id="FLID">
                        <?php foreach($row as $row){ ?>
                        <option> <?php echo $row['FLID'] ?> </option>
                <?php  } ?>
                </select>

	</form>
</div>

<script>
function openFormcenter() {
	document.getElementById("addFiles").style.display = "block";
}

function closeFormcenter() {
 	document.getElementById("addFiles").style.display = "none";
}
</script>

</body>
</html>

