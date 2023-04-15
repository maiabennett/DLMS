<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>

<!-- Navigation -->
<ul>
        <li><a href="home.php">Homepage</a></li>
        <li class = "active"><a href="data-manager.php">Flow data manager</a></li>
        <li><a href="flow-analysis.php">Flow data analysis</a></li>
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<div class="header-imm"> </div>

<!-- Left, add human donor -->
<button class = "open-button-l" onclick = "openFormleft()">Add new human donor</button>

<!-- Popup bar options -->
<div class = "form-popup-l" id = "addDonor">
	<form class = "form-container-l" method = "post" id = "addDonorform" action="<?php echo $_SERVER['PHP_SELF'];?>">
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

		<label for="collected"><br><b>Collection date<br></b></label>
		<input type = "date" name = "collected" id = "collected">

		<label for="comments"><br><br><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments" id = "comments">
		
		<input type="submit" class="btn" id="submitDonor" value="Add donor" />
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

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST['submitDonor']") {
	$donorID=$_POST['donorID'];
	$age=$_POST['age'];
	$ethnicity=$_POST['ethnicity'];
	$sex=$_POST['sex'];
	$collected=$_POST['collected'];
	$comments=$_POST['comments'];


	if (empty($donorID)) {
	echo "<br>No donor ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into metadata values (\"". $donorID ."\", \"". $age ."\", \"". $ethnicity ."\", \"". $sex ."\", \"". $collected ."\", \"". $comments ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}

?>



<!-- Center, add assay -->
<button class = "open-button-r" onclick = "openFormcenter()">Add new assay</button>

<!-- Popup bar options -->
<div class = "form-popup-r" id = "addAssay">
        <form class = "form-container-r" method = "post" id = "addAssayform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New assay </h1>
		<h3> Make sure you've added the donor first! </h3>
		
		<label for="assayID"><b>Assay ID</b></label>
		<input type="text" placeholder="Ex., AM033a" name="assayID" id="assayID" required>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select donorID from metadata";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="donorID-c"><b>Donor ID</b><br></label>
		<select name="donorID-c" id="donorID-c" form="addAssayform">
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

		<label for="run"><br><br><b>Run date<br></b></label>
		<input type = "date" name = "run" id = "run">

		<?php 
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="lead"><br><br><b>Assay lead</b><br></label>
		<select name="lead" id="lead" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="magnet"><br><br><b>Magnetic enrichment</b><br></label>
		<select name="magnet" id="magnet" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="targets"><br><br><b>Target cell staining</b><br></label>
		<select name="targets" id="targets" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="staining"><br><br><b>Immunophenotype staining</b><br></label>
		<select name="staining" id="staining" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="flow"><br><br><b>Flow cytometry</b><br></label>
		<select name="flow" id="flow" form="addAssayform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}

				mysqli_close($connect);
			?>

		</select>

		<label for="comments-c"><br><br><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments-c" id = "comments-c">

		<input type="submit" class="btn" id="submitAssay" value="Add assay" />
		<button type="button" class="btn cancel" onclick="closeFormcenter()">Close</button>

	</form>
</div>

<script>

function openFormcenter() {
	document.getElementById("addAssay").style.display = "block";
}

function closeFormcenter() {	
	document.getElementById("addAssay").style.display = "none";
}

</script>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST['submitAssay']") {
	$assayID=$_POST['assayID'];
	$donorID=$_POST['donorID-c'];
	$run=$_POST['run'];
	$lead=$_POST['lead'];
	$magnet=$_POST['magnet'];
	$donorID=$_POST['donorID'];	
	$staining=$_POST['staining'];
	$flow=$_POST['flow'];
	$comments=$_POST['comments-c'];

	if (empty($assayID)) {
	echo "<br>No assay ID given<br>";
	} 

	if (empty($donorID)) {
	echo "<br>No donor ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into metadata values (\"". $assayID ."\", \"". $donorID ."\", \"". $run ."\", \"". $lead ."\", \"". $magnet ."\", \"". $targets ."\", \"". $staining ."\", \"". $flow ."\", \"". $comments ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}

?>


<!-- Popup button, right -->
<button class = "open-button-c" onclick = "openFormright()">Add new flow file</button>

<div class = "form-popup-c" id = "addFile">
        <form class = "form-container-c" method = "post" id = "addFileform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New flow cytometry files </h1>
		<h2> Make sure you've added the donor and assay first! </h2>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select assayID from assay";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="assayID-r"><b>Assay ID</b><br></label>
		<select name="assayID-r" id="assayID-r" form="addFileform">
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


		<label for="filename"><br><br><b>File name</b></label>
		<input type="text" placeholder="Ex., NK unstim.fcs" name="filename" id = "filename" required>

		<label for="cond"><b>Condition tested</b></label>
		<input list="cond" id="condi" name="cond" required>
		<datalist id="cond">
			<option value="Untreated"> </option>
			<option value="Untreated + aCD20"> </option>
			<option value="TLR9a stimulated"> </option>
			<option value="TLR9a stimulated + aCD20"> </option>
			<option value="Untreated ADCC"> </option>
			<option value="Untreated direct"> </option>
			<option value="TLR9a stimulated ADCC"> </option>
			<option value="TLR9a stimulated direct"> </option>
		</datalist>


		<?php 
				$query = "select FLID from flowpanel";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FLID"><br><br><b>Flow panel ID</b><br></label>
		<select name="FLID" id="FLID" form="addFileform">
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}

				mysqli_close($connect);
			?>

		</select>

		<br><br>

		<input type="submit" class="btn" id="submitFile" value="Add file" />
		<button type="button" class="btn cancel" onclick="closeFormright()">Close</button>

	</form>
</div>

<script>
function openFormright() {
	document.getElementById("addFile").style.display = "block";
}

function closeFormright() {
 	document.getElementById("addFile").style.display = "none";
}

</script>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST['submitFile']") {
	$assayID=$_POST['assayID-r'];
	$filename=$_POST['filename'];
	$cond=$_POST['cond'];
	$FLID=$_POST['FLID'];

	if (empty($assayID-r)) {
	echo "<br>No assay ID given<br>";
	} 

	if (empty($filename)) {
	echo "<br>No donor ID given<br>";
	} 

	if (empty($cond)) {
	echo "<br>No condition given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into metadata values (\"". $assayID ."\", \"". $filename ."\", \"". $cond ."\", \"". $FLID ."\")";

	$result = mysqli_query($connect,$query)
		or trigger_error("Query Failed! SQL: $query - Error: "
		. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
}

?>

</body>
</html>

