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

		<label for = "comp"><b>Compensation matrix ID</b></label>
		<input type = "text" placeholder = "Unique ID, ex., immunoNKcomp" name = "comp" id = "comp" required>

		<label for="matrix"><b>Matrix file name</b></label>
		<input type="text" placeholder="Ex., comp.mtx" name="matrix" id = "matrix" required>

		<label for="path"><b>Matrix file path</b></label>
		<input type="text" placeholder="Ex., C:\Users\Me\OneDrive..." name="path" id = "path">

		
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

<!-- Left bottom, edit compensation file -->
<button class = "open-button-lb" onclick = "openFormleftbottom()">Edit existing compensation matrix</button>

<!-- Popup bar options: Similar to flow files, the matrix name is currently manual input, further validation is needed for file upload and path parsing -->
<div class = "form-popup-lb" id = "editComp">
	<form class = "form-container-lb" method = "post" id = "editCompform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit compensation matrix </h1>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select compID from comp";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="comp-lb"><b>Compensation matrix ID</b><br></label>
		<select name="comp-lb" id="comp-lb" form="editCompform" required>
			<option></option>
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

		<label for="matrix-lb"><br><br><b>Matrix file name</b></label>
		<input type="text" placeholder="Ex., comp.mtx" name="matrix-lb" id = "matrix-lb">

		<label for="path-lb"><b>Matrix file path</b></label>
		<input type="text" placeholder="Ex., C:\Users\Me\OneDrive..." name="path-lb" id = "path-lb">
		
		<input type="submit" class="btn" name="submitCompEdit" id="submitCompEdit" value="Edit compensation matrix" />
		<button type="button" class="btn cancel" onclick="closeFormleftbottom()">Close</button>
	</form>
</div>

<script>
function openFormleftbottom() {
	document.getElementById("editComp").style.display = "block";
}

function closeFormleftbottom() {
	document.getElementById("editComp").style.display = "none";
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

		<label for="FLID"><b>Flow panel ID</b></label>
		<input type="text" placeholder="Ex., immunoNK" name="FLID" id="FLID" required>

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
		<select name="FL1" id="FL1" form="addPanelform" required>
			<option></option>
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
		<select name="FL2" id="FL2" form="addPanelform" required>
			<option></option>
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
		<select name="FL3" id="FL3" form="addPanelform" required>
			<option></option>
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
			<option></option>
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
			<option></option>
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
			<option></option>
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
			<option></option>
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
			<option></option>
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
		<select name="comp-c" id="comp-c" form="addPanelform" required>
			<option></option>
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
			<option value="Y">Y</option>
			<option value="N">N</option>
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



<!-- Center bottom, edit flow panel and markers -->
<button class = "open-button-rtopb" onclick = "openFormMarkerbottom()">Edit existing fluorophore</button>
<button class = "open-button-rbottomb" onclick = "openFormPanelbottom()">Edit existing flow panel</button>

<!-- Popup panel bar options -->
<div class = "form-popup-rb" id = "editMarker">
        <form class = "form-container-rb" method = "post" id = "editMarkerform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit conjugated fluorophore </h1>

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

		<label for="markerID-cb"><b>Conjugated fluorophore</b><br></label>
		<select name="markerID-cb" id="markerID-cb" form="editMarkerform" required>
			<option></option>
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

		<label for="catID-cb"><br><br><b>Catalogue information</b></label>
		<input type="text" placeholder="Ex., BioLegend cat# or eBioscience clone 1111" name="catID-cb" id="catID-cb">

		<label for="gene_product-cb"><b>Marker gene name</b></label>
		<input type="text" placeholder="Ex., NCAM1 for CD56" name="gene_product-cb" id="gene_product-cb">

		<input type="submit" class="btn" name="submitMarkerEdit" id="submitMarkerEdit" value="Edit conjugated fluorophore" />
		<button type="button" class="btn cancel" onclick="closeFormMarkerbottom()">Close</button>

	</form>
</div>


<!-- // Popup panel bar options -->
<div class = "form-popup-rb" id = "editPanel">
        <form class = "form-container-rb" method = "post" id = "editPanelform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit flow cytometry panel </h1>

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

		<label for="FLID-cb"><b>Flow panel ID</b><br></label>
		<select name="FLID-cb" id="FLID-cb" form="editPanelform" required>
			<option></option>
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

		<?php
				$query = "select markerID from markers";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FL1-cb"><b>FL1</b><br></label>
		<select name="FL1-cb" id="FL1-cb" form="editPanelform">
			<option></option>
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

		<label for="FL2-cb"><br><br><b>FL2</b><br></label>
		<select name="FL2-cb" id="FL2-cb" form="editPanelform">
			<option></option>
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

		<label for="FL3-cb"><br><br><b>FL3</b><br></label>
		<select name="FL3-cb" id="FL3-cb" form="editPanelform">
			<option></option>
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

		<label for="FL4-cb"><br><br><b>FL4</b><br></label>
		<select name="FL4-cb" id="FL4-cb" form="editPanelform">
			<option></option>
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

		<label for="FL5-cb"><br><br><b>FL5</b><br></label>
		<select name="FL5-cb" id="FL5-cb" form="editPanelform">
			<option></option>
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

		<label for="FL6-cb"><br><br><b>FL6</b><br></label>
		<select name="FL6-cb" id="FL6-cb" form="editPanelform">
			<option></option>
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

		<label for="FL7-cb"><br><br><b>FL7</b><br></label>
		<select name="FL7-cb" id="FL7-cb" form="editPanelform">
			<option></option>
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

		<label for="FL8-cb"><br><br><b>FL8</b><br></label>
		<select name="FL8-cb" id="FL8-cb" form="editPanelform">
			<option></option>
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

		<label for="comp-cb"><br><br><b>Compensation matrix ID</b><br></label>
		<select name="comp-cb" id="comp-cb" form="editPanelform">
			<option></option>
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

		<label for="iscurrent-cb"><br><br><b>Is this panel currently used?</b><br></label>
		<select name="iscurrent-cb" id="iscurrent-cb" form="editPanelform">
			<option value="Y">Y</option>
			<option value="N">N</option>
		</select>

		<label for="comments-cb"><br><br><b>Comments</b></label>
                <input type="text" placeholder="Panel comments" name="comments-cb" id = "comments-cb">

		<input type="submit" class="btn" name="submitPanelEdit" id="submitPanelEdit" value="Edit panel" />
		<button type="button" class="btn cancel" onclick="closeFormPanelbottom()">Close</button>

	</form>
</div>

<script>
function openFormMarkerbottom() {
	document.getElementById("editMarker").style.display = "block";
}

function closeFormMarkerbottom() {	
	document.getElementById("editMarker").style.display = "none";
}

function openFormPanelbottom() {
	document.getElementById("editPanel").style.display = "block";
}

function closeFormPanelbottom() {	
	document.getElementById("editPanel").style.display = "none";
}
</script>




<!-- Right, print flow panel info -->
<button class = "open-button-c" onclick = "openFormright()">Print flow panel information</button>

<div class = "form-popup-c" id = "printPanel">
        <form class = "form-container-c" method = "post" id = "printPanelform" action="printPanel.php">
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
		<select name="FLID-r" id="FLID-r" form="printPanelform" required>
			<option></option>
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

if (isset($_POST['submitComp'])) {

	$compID=$_POST['comp'];
	$matrix=$_POST['matrix'];
	$path=$_POST['path'];

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into comp values (\"". $compID ."\", \"". $matrix ."\", \"". $path ."\")";

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);

} else if(isset($_POST['submitCompEdit'])) {

	$compID=$_POST['comp-lb'];
	$matrix=$_POST['matrix-lb'];
	$path=$_POST['path-lb'];


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

	if (!empty($matrix)) {

		$query = "update comp set matrix = \"". $matrix ."\" where compID = \"". $compID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($path)) {

		$query = "update comp set path = \"". $path ."\" where compID = \"". $compID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 
	
	mysqli_close($connect);

} else if(isset($_POST['submitMarker'])) {

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

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);

} else if(isset($_POST['submitMarkerEdit'])) {

	$markerID=$_POST['markerID-cb'];
	$catID=$_POST['catID-cb'];
	$gene_product=$_POST['gene_product-cb'];


	if (empty($markerID)) {
	echo "<br>No conjugated fluorophore given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	if (!empty($catID)) {

		$query = "update markers set catID = \"". $catID ."\" where markerID = \"". $markerID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($gene_product)) {

		$query = "update markers set gene_product = \"". $gene_product ."\" where markerID = \"". $markerID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 
	
	mysqli_close($connect);

} else if(isset($_POST['submitPanel'])) {

	$FLID=$_POST['FLID'];
	$FL1=$_POST['FL1'];
	$FL2=$_POST['FL2'];
	$FL3=$_POST['FL3'];
	$FL4=$_POST['FL4'];
	$FL5=$_POST['FL5'];
	$FL6=$_POST['FL6'];
	$FL7=$_POST['FL7'];
	$FL8=$_POST['FL8'];
	$compID=$_POST['comp-c'];
	$iscurrent=$_POST['iscurrent'];
	$comments=$_POST['comments'];

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

	$query = "insert into flowpanel values (\"". $FLID ."\", \"". $FL1 ."\", \"". $FL2 ."\", \"". $FL3 ."\", \"". $FL4 ."\", \"". $FL5 ."\", \"". $FL6 ."\", \"". $FL7 ."\", \"". $FL8 ."\", \"". $compID ."\", \"". $iscurrent ."\", \"". $comments ."\")";

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
} else if(isset($_POST['submitPanelEdit'])) {

	$FLID=$_POST['FLID-cb'];
	$FL1=$_POST['FL1-cb'];
	$FL2=$_POST['FL2-cb'];
	$FL3=$_POST['FL3-cb'];
	$FL4=$_POST['FL4-cb'];
	$FL5=$_POST['FL5-cb'];
	$FL6=$_POST['FL6-cb'];
	$FL7=$_POST['FL7-cb'];
	$FL8=$_POST['FL8-cb'];
	$compID=$_POST['comp-c-cb'];
	$iscurrent=$_POST['iscurrent-cb'];
	$comments=$_POST['comments-cb'];


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

	if (!empty($FL1)) {

		$query = "update flowpanel set FL1 = \"". $FL1 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL2)) {

		$query = "update flowpanel set FL2 = \"". $FL2 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL3)) {

		$query = "update flowpanel set FL3 = \"". $FL3 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL4)) {

		$query = "update flowpanel set FL4 = \"". $FL4 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL5)) {

		$query = "update flowpanel set FL5 = \"". $FL5 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL6)) {

		$query = "update flowpanel set FL6 = \"". $FL6 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL7)) {

		$query = "update flowpanel set FL7 = \"". $FL7 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FL8)) {

		$query = "update flowpanel set FL8 = \"". $FL8 ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($compID)) {

		$query = "update flowpanel set compID = \"". $compID ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($iscurrent)) {

		$query = "update flowpanel set iscurrent = \"". $iscurrent ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 


	if (!empty($comments)) {

		$query = "update flowpanel set comments = \"". $comments ."\" where FLID = \"". $FLID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 
	
	mysqli_close($connect);

}

}
	 
?>

<div class="bottomsig">
	<p style="float:right;">Developed by Maia Bennett, 2023</p>
</div>

</body>
</html>

