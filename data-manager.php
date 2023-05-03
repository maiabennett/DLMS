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

<!-- Left top, add human donor -->
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
		
		<input type="submit" class="btn" name="submitDonor" id="submitDonor" value="Add donor" />
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


<!-- Left bottom, edit human donor -->
<button class = "open-button-lb" onclick = "openFormleftbottom()">Edit existing human donor</button>

<!-- Popup bar options -->
<div class = "form-popup-lb" id = "editDonor">
	<form class = "form-container-lb" method = "post" id = "editDonorform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit human donor </h1>

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

		<label for="donorID-lb"><b>Donor ID</b><br></label>
		<select name="donorID-lb" id="donorID-lb" form="editDonorform">
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
				mysqli_close($connect);

			?>

		</select>

		<label for="age-lb"><br><br><b>Age</b></label>
		<input type = "text" placeholder = "Enter age" name = "age-lb" id = "age-lb">

		<label for="ethnicity-lb"><b>Race/Ethnicity</b></label>
		<input type = "text" placeholder = "Enter race/ethnicity" name = "ethnicity-lb" id = "ethnicity-lb">

		<label for="sex-lb"><b>Sex<br></b></label>
		<select name="sex-lb" id="sex-lb" form="editDonorform">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select><br>

		<label for="collected-lb"><br><b>Collection date<br></b></label>
		<input type = "date" name = "collected-lb" id = "collected-lb">

		<label for="comments-lb"><br><br><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments-lb" id = "comments-lb">
		
		<input type="submit" class="btn" name="submitDonorEdit" id="submitDonorEdit" value="Edit donor" />
		<button type="button" class="btn cancel" onclick="closeFormleftbottom()">Close</button>
	</form>
</div>

<script>

function openFormleftbottom() {
	document.getElementById("editDonor").style.display = "block";
}

function closeFormleftbottom() {
	document.getElementById("editDonor").style.display = "none";
}

</script>



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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="magnet"><br><br><b>Magnetic enrichment</b><br></label>
		<select name="magnet" id="magnet" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="targets"><br><br><b>Target cell staining</b><br></label>
		<select name="targets" id="targets" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="staining"><br><br><b>Immunophenotype staining</b><br></label>
		<select name="staining" id="staining" form="addAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="flow"><br><br><b>Flow cytometry</b><br></label>
		<select name="flow" id="flow" form="addAssayform">
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

				mysqli_close($connect);
			?>

		</select>

		<label for="comments-c"><br><br><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments-c" id = "comments-c">

		<input type="submit" class="btn" name="submitAssay" id="submitAssay" value="Add assay" />
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


<!-- Center bottom, edit assay -->
<button class = "open-button-rb" onclick = "openFormcenterbottom()">Edit existing assay</button>

<!-- Popup bar options -->
<div class = "form-popup-rb" id = "editAssay">
        <form class = "form-container-rb" method = "post" id = "editAssayform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit assay </h1>
		
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

		<label for="assayID-cb"><b>Assay ID</b><br></label>
		<select name="assayID-cb" id="assayID-cb" form="editAssayform" required>
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
				$query = "select donorID from metadata";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="donorID-cb"><br><br><b>Donor ID</b><br></label>
		<select name="donorID-cb" id="donorID-cb" form="editAssayform">
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

		<label for="run-cb"><br><br><b>Run date<br></b></label>
		<input type = "date" name = "run-cb" id = "run-cb">

		<?php 
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="lead-cb"><br><br><b>Assay lead</b><br></label>
		<select name="lead-cb" id="lead-cb" form="editAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="magnet-cb"><br><br><b>Magnetic enrichment</b><br></label>
		<select name="magnet-cb" id="magnet-cb" form="editAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="targets-cb"><br><br><b>Target cell staining</b><br></label>
		<select name="targets-cb" id="targets-cb" form="editAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="staining-cb"><br><br><b>Immunophenotype staining</b><br></label>
		<select name="staining-cb" id="staining-cb" form="editAssayform">
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
				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="flow-cb"><br><br><b>Flow cytometry</b><br></label>
		<select name="flow-cb" id="flow-cb" form="editAssayform">
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

				mysqli_close($connect);
			?>

		</select>

		<label for="comments-cb"><br><br><b>Comments</b></label>
		<input type = "text" placeholder = "Enter any comments" name = "comments-cb" id = "comments-cb">

		<input type="submit" class="btn" name="submitEditAssay" id="submitEditAssay" value="Edit assay" />
		<button type="button" class="btn cancel" onclick="closeFormcenterbottom()">Close</button>

	</form>
</div>

<script>

function openFormcenterbottom() {
	document.getElementById("editAssay").style.display = "block";
}

function closeFormcenterbottom() {	
	document.getElementById("editAssay").style.display = "none";
}

</script>



<!-- Popup button, right -->
<button class = "open-button-c" onclick = "openFormright()">Add new flow file</button>

<div class = "form-popup-c" id = "addFile">
        <form class = "form-container-c" method = "post" id = "addFileform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New flow cytometry files </h1>
		<h3> Make sure you've added the donor and assay first! </h3>

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
		<select name="assayID-r" id="assayID-r" form="addFileform" required>
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


		<label for="filename"><br><br><b>File name</b></label>
		<input type="text" placeholder="Ex., NK unstim.fcs" name="filename" id = "filename" required>

		<label for="ODpath"><b>Current OneDrive file path</b></label>
		<input type="text" placeholder="Ex., C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\..." name="ODpath" id = "ODpath" required>


		<label for="cond"><b>Condition tested</b></label>
		<input list="cond" id="cond" name="cond" required>
		<datalist id="conds">
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

				mysqli_close($connect);
			?>

		</select>

		<br><br>

		<input type="submit" class="btn" name="submitFile" id="submitFile" value="Add file" />
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

<!-- Popup button, right bottom -->
<button class = "open-button-cb" onclick = "openFormrightbottom()">Edit existing flow file</button>

<div class = "form-popup-cb" id = "editFile">
        <form class = "form-container-cb" method = "post" id = "editFileform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit flow cytometry files </h1>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select assayID, filename from flowfiles";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="filename-rb"><b>File name</b><br></label>
		<select name="filename-rb" id="filename-rb" form="editFileform" required>
			<option></option>
			<?php 
				if ($result = mysqli_query($connect, $query)) {
	    				while ($row = mysqli_fetch_row($result)) { ?>

			<option> <?php echo $row[0], ", ", $row[1] ?> </option>

    			<?php	}
    				mysqli_free_result($result);
				}else{
				echo "No results";
				}
			?>

		</select>


		<label for="newfilename"><br><br><b>New file name</b></label>
		<input type="text" placeholder="Ex., NK unstim.fcs" name="newfilename" id = "newfilename">



		<label for="ODpath-rb"><b>Current OneDrive file path</b></label>
		<input type="text" placeholder="Ex., C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\..." name="ODpath-rb" id = "ODpath-rb">


		<label for="cond-rb"><b>Condition tested</b></label>
		<input list="cond-rb" id="cond-rb" name="cond-rb">
		<datalist id="conds-rb">
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

		<label for="FLID-rb"><br><br><b>Flow panel ID</b><br></label>
		<select name="FLID-rb" id="FLID-rb" form="editFileform">
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

				mysqli_close($connect);
			?>

		</select>

		<br><br>

		<input type="submit" class="btn" name="submitFileEdit" id="submitFileEdit" value="Edit file" />
		<button type="button" class="btn cancel" onclick="closeFormrightbottom()">Close</button>

	</form>
</div>

<script>
function openFormrightbottom() {
	document.getElementById("editFile").style.display = "block";
}

function closeFormrightbottom() {
 	document.getElementById("editFile").style.display = "none";
}

</script>




<!-- Far right, print assay/donor information -->
<button class = "open-button-rr" onclick = "openFormrightright()">Search flow cytometry data</button>

<div class = "form-popup-rr" id = "printFlow">
        <form class = "form-container-rr" method = "post" id = "printFlowform" action="printFlow.php">
		<h1> Search flow cytometry data </h1>
		<h3> Pick one or more of the parameters below. </h3>

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

		<label for="assayID-rr"><b>Assay ID</b><br></label>
		<select name="assayID-rr" id="assayID-rr" form="printFlowform">
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
				$query = "select donorID from metadata";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="donorID-rr"><br><br><b>Donor ID</b><br></label>
		<select name="donorID-rr" id="donorID-rr" form="printFlowform">
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
				$query = "select distinct filename from flowfiles";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="filename-rr"><br><br><b>File name</b><br></label>
		<select name="filename-rr" id="filename-rr" form="printFlowform">
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
				$query = "select cond from flowfiles";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="cond-rr"><br><br><b>Condition tested</b><br></label>
		<select name="cond-rr" id="cond-rr" form="printFlowform">
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
				$query = "select FLID from flowpanel";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="FLID-rr"><br><br><b>Flow panel ID</b><br></label>
		<select name="FLID-rr" id="FLID-rr" form="printFlowform">
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

				mysqli_close($connect);
			?>

		</select>



		<br><br>

		<input type="submit" class="btn" name="submitFile" id="submitFile" value="Search flow cytometry data" />
		<button type="button" class="btn cancel" onclick="closeFormrightright()">Close</button>

	</form>
</div>

<script>
function openFormrightright() {
	document.getElementById("printFlow").style.display = "block";
}

function closeFormrightright() {
 	document.getElementById("printFlow").style.display = "none";
}

</script>

<div class="bottomsig">
	<p style="float:right;">Developed by Maia Bennett, 2023</p>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['submitDonor'])) {

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

} else if(isset($_POST['submitDonorEdit'])) {

	$donorID=$_POST['donorID-lb'];
	$age=$_POST['age-lb'];
	$ethnicity=$_POST['ethnicity-lb'];
	$sex=$_POST['sex-lb'];
	$collected=$_POST['collected-lb'];
	$comments=$_POST['comments-lb'];


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

	if (!empty($age)) {

		$query = "update metadata set age = \"". $age ."\" where donorID = \"". $donorID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($ethnicity)) {

		$query = "update metadata set ethnicity = \"". $ethnicity ."\" where donorID = \"". $donorID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($sex)) {

		$query = "update metadata set sex = \"". $sex ."\" where donorID = \"". $donorID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($collected)) {

		$query = "update metadata set collected = \"". $collected ."\" where donorID = \"". $donorID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 
	if (!empty($comments)) {

		$query = "update metadata set comments = \"". $comments ."\" where donorID = \"". $donorID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	
	mysqli_close($connect);

} else if(isset($_POST['submitAssay'])) {

	$assayID=$_POST['assayID'];
	$donorID=$_POST['donorID-c'];
	$run=$_POST['run'];
	$lead=$_POST['lead'];
	$magnet=$_POST['magnet'];
	$donorID=$_POST['donorID'];	
	$staining=$_POST['staining'];
	$flow=$_POST['flow'];
	$comments=$_POST['comments-c'];

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into assay values (\"". $assayID ."\", \"". $donorID ."\", \"". $run ."\", \"". $lead ."\", \"". $magnet ."\", \"". $targets ."\", \"". $staining ."\", \"". $flow ."\", \"". $comments ."\")";

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);

}  else if(isset($_POST['submitEditAssay'])) {

	$assayID=$_POST['assayID-cb'];
	$donorID=$_POST['donorID-cb'];
	$run=$_POST['run-cb'];
	$lead=$_POST['lead-cb'];
	$magnet=$_POST['magnet-cb'];
	$donorID=$_POST['donorID-cb'];	
	$staining=$_POST['staining-cb'];
	$flow=$_POST['flow-cb'];
	$comments=$_POST['comments-cb'];


	if (empty($assayID)) {
	echo "<br>No assay ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	if (!empty($donorID)) {

		$query = "update assay set donorID = \"". $donorID ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($lead)) {

		$query = "update assay set lead = \"". $lead ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($magnet)) {

		$query = "update assay set magnet = \"". $magnet ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($targets)) {

		$query = "update assay set targets = \"". $targets ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($staining)) {

		$query = "update assay set staining = \"". $staining ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($flow)) {

		$query = "update assay set flow = \"". $flow ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($comments)) {

		$query = "update assay set comments = \"". $comments ."\" where assayID = \"". $assayID ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	
	mysqli_close($connect);

} elseif(isset($_POST['submitFile'])) {
	$assayID=$_POST['assayID-r'];
	$filename=$_POST['filename'];
	$ODpath=$_POST['ODpath'];
	$cond=$_POST['cond'];
	$FLID=$_POST['FLID'];

	if (empty($assayID)) {
	echo "<br>No assay ID given<br>";
	} 

	if (empty($filename)) {
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

	$query = "insert into flowfiles (assayID, filename, ODpath, cond, FLID) values (\"". $assayID ."\", \"". $filename ."\", \"". $ODpath ."\", \"". $cond ."\", \"". $FLID ."\")";

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);
} else if(isset($_POST['submitFileEdit'])) {

	$assayfile=$_POST['filename-rb'];
	$parsestring=explode(", ", $assayfile);
	$assayID=$parsestring[0];
	$filename=$parsestring[1];
	$filenew=$_POST['newfilename'];
	$ODpath=$_POST['ODpath-rb'];
	$cond=$_POST['cond-rb'];
	$FLID=$_POST['FLID-rb'];


	if (empty($assayID)) {
	echo "<br>No assay ID given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	if (!empty($filenew)) {

		$query = "update flowfiles set filename = \"". $filenew ."\" where assayID = \"". $assayID ."\" and filename = \"". $filename ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 


	if (!empty($ODpath)) {

		$query = "update flowfiles set ODpath = \"". $ODpath ."\" where assayID = \"". $assayID ."\" and filename = \"". $filename ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($cond)) {

		$query = "update flowfiles set cond = \"". $cond ."\" where assayID = \"". $assayID ."\" and filename = \"". $filename ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($FLID)) {

		$query = "update flowfiles set FLID = \"". $FLID ."\" where assayID = \"". $assayID ."\" and filename = \"". $filename ."\"";

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


</body>
</html>

