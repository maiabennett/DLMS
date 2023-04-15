<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="styles.css">

</head>
<body>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>

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

<!-- Popup bar options: Similar to flow files, the matrix name is currently manual input, further validation is needed for file upload and path parsing -->
<div class = "form-popup-l" id = "addComp">
	<form class = "form-container-l" method = "post" id = "addCompform" action="<?php echo $_SERVER['PHP_SELF'];?>">
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

		<label for="path"><b>Matrix file path</b></label>
		<input type="text" placeholder="Ex., C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\..." name="path" id = "path" required>

		
		<input type="submit" class="btn" name="submitComp" id="submitComp" value="Add compensation matrix" />
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

</script>


<!-- Center, add flow panel and markers -->
<button class = "open-button-rtop" onclick = "openFormMarker()">Add new fluorophore</button>
<button class = "open-button-rbottom" onclick = "openFormPanel()">Add new flow panel</button>

<!-- Popup panel bar options -->
<div class = "form-popup-r" id = "addMarker">
        <form class = "form-container-r" method = "post" id = "addMarkerform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New conjugated fluorophore </h1>

		<label for="marker"><b>Marker name</b></label>
		<input type="text" placeholder="Ex., CD56" name="marker" id="marker" required>

		<label for="fluor"><b>Fluorophore name</b></label>
		<input type="text" placeholder="Ex., APC" name="fluor" id="fluor" required>

		<label for="catID"><b>Catalogue information</b></label>
		<input type="text" placeholder="Ex., BioLegend cat# or eBioscience clone 1111" name="catID" id="catID" required>

		<label for="gene_product"><b>Marker gene name</b></label>
		<input type="text" placeholder="Ex., NCAM1 for CD56" name="gene_product" id="gene_product" required>

		<input type="submit" class="btn" name="submitMarker" id="submitMarker" value="Add conjugated fluorophore" />
		<button type="button" class="btn cancel" onclick="closeFormMarker()">Close</button>

	</form>
</div>


<!-- // Popup panel bar options -->
<div class = "form-popup-r" id = "addPanel">
        <form class = "form-container-r" method = "post" id = "addPanelform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New flow cytometry panel </h1>
		<h3> Not seeing your conjugated fluorophores? Click on the other button! </h3>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL1"><b>FL1</b><br></label>
		<select name="FL1" id="FL1" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>
		
		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL2"><br><br><b>FL2</b><br></label>
		<select name="FL2" id="FL2" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL3"><br><br><b>FL3</b><br></label>
		<select name="FL3" id="FL3" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL4"><br><br><b>FL4</b><br></label>
		<select name="FL4" id="FL4" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL5"><br><br><b>FL5</b><br></label>
		<select name="FL5" id="FL5" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL6"><br><br><b>FL6</b><br></label>
		<select name="FL6" id="FL6" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL7"><br><br><b>FL7</b><br></label>
		<select name="FL7" id="FL7" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL8"><br><br><b>FL8</b><br></label>
		<select name="FL8" id="FL8" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<?php
				$query = "select compID from comp";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="comp-c"><br><br><b>Compensation matrix ID</b><br></label>
		<select name="comp-c" id="comp-c" form="addPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<label for="iscurrent"><br><br><b>Is this panel currently used?</b><br></label>
		<select name="iscurrent" id="iscurrent" form="addPanelform">
			<option value="Y">Yes</option>
			<option value="N">No</option>
		</select>

		<label for="comments-c"><br><br><b>Comments</b></label>
                <input type="text" placeholder="Panel comments" name="comments-c" id = "comments-c">

		<input type="submit" class="btn" name="submitPanel" id="submitPanel" value="Add panel" />
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
</script>



<!-- Right, print flow panel info -->
<button class = "open-button-c" onclick = "openFormright()">Print flow panel information</button>

<div class = "form-popup-c" id = "printPanel">
        <form class = "form-container-c" method = "post" id = "printPanelform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Select panel for printing </h1>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select FLID from flowpanel";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FLID-r"><b>Flow panel ID</b><br></label>
		<select name="FLID-r" id="FLID-r" form="printPanelform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>

		<br><br>

		<input type="submit" class="btn" name="submitPrint" id="submitPrint" value="Print flow panel information" />
		<button type="button" class="btn cancel" onclick="closeFormright()">Close</button>

	</form>
</div>

<script>
function openFormright() {
	document.getElementById("printPanel").style.display = "block";
}

function closeFormright() {
 	document.getElementById("printPanel").style.display = "none";
}

</script>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['submitComp'])) {

	$compID=$_POST['compID'];
	$matrix=$_POST['matrix'];
	$path=$_POST['path'];

	if (empty($compID)) {
	echo "<br>No compensation ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into comp values (\"". $compID ."\", \"". $matrix ."\", \"". $path ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}


	if(isset($_POST['submitMarker'])) {

	$marker=$_POST['marker'];
	$fluor=$_POST['fluor'];
	$markerID=$marker . ' ' . $fluor;
	$catID=$_POST['catID'];
	$gene_product=$_POST['gene_product'];

	if (empty($marker)) {
	echo "<br>No marker given<br>";
	} 

	if (empty($fluor)) {
	echo "<br>No fluorophore given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into markers values (\"". $marker ."\", \"". $fluor ."\", \"". $markerID ."\", \"". $catID ."\", \"". $gene_product ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}


	if(isset($_POST['submitPanel'])) {

	$FLID=$_POST['FLID'];
	$FL1=$_POST['FL1'];
	$FL2=$_POST['FL2'];
	$FL3=$_POST['FL3'];
	$FL4=$_POST['FL4'];
	$FL5=$_POST['FL5'];
	$FL6=$_POST['FL6'];
	$FL7=$_POST['FL7'];
	$FL8=$_POST['FL8'];
	$compID=$_POST['compID'];
	$iscurrent=$_POST['iscurrent'];
	$comments=$_POST['comments'];

	if (empty($FLID)) {
	echo "<br>No flow panel ID given<br>";
	} 

	if (empty($compID)) {
	echo "<br>No compensation matrix ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into flowpanel values (\"". $FLID ."\", \"". $FL1 ."\", \"". $FL2 ."\", \"". $FL3 ."\", \"". $FL4 ."\", \"". $FL5 ."\", \"". $FL6 ."\", \"". $FL7 ."\", \"". $FL8 ."\", \"". $compID ."\", \"". $iscurrent ."\", \"". $comments ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}

	if(isset($_POST['printPanel'])) {

	$FLID=$_POST['FLID-r'];
	$target = "~/maiabennett/flow-panels/\"". $FLID ."\".txt";

	if (empty($FLID)) {
	echo "<br>No flow panel ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}


	/* Open document to write */ 
	$writefile = fopen($target, "w") or die ("Unable to open file!"); 

	$text = "Panel Setup\n";
	fwrite($writefile, $text); 

	/* Print panel */ 
	$query = "select * from flowpanel where FLID = \"". $FLID ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			fwrite($writefile, $row);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}
	

	$text = "\n\nMarker Information\n";
	fwrite($writefile, $text); 

	/* Print markers */
	$query = "select * from flowpanel where FLID = \"". $FLID ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$FL1 = $row[1];
			$FL2 = $row[2];
			$FL3 = $row[3];
			$FL4 = $row[4];
			$FL5 = $row[5];
			$FL6 = $row[6];
			$FL7 = $row[7];
			$FL8 = $row[8];

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL1 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL1: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}
	
	$query = "select * from markers where markerID = \"". $FL2 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL2: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL3 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL3: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}
	
	$query = "select * from markers where markerID = \"". $FL4 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL4: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL5 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL5: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL6 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL6: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL7 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL7: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	$query = "select * from markers where markerID = \"". $FL8 ."\"";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	if ($result = mysqli_query($connect, $query)) {
	    	while ($row = mysqli_fetch_row($result)) { 

			$text = "FL8: \n \"". $row ."\"";
			fwrite($writefile, $text);

    		}
    		mysqli_free_result($result);
	}else{
		echo "No results";
	}

	/* Close file */
	fclose($writefile);
	 
	mysqli_close($connect);
}
}
	 
?>


</body>
</html>

