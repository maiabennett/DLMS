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
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li class = "active"><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<div class="header-imm">
</div>

<!-- Left, add lab member -->
<button class = "open-button-l" onclick = "openFormleft()">Add new lab member</button>


<div class = "form-popup-l" id = "addMember">
	<form class = "form-container-l" method = "post" id = "addMemberform" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> New lab member </h1>

		<label for = "name"><b>Member name</b></label>
		<input type = "text" placeholder = "Enter member name" name = "name" id = "name" required>

		<label for="joined"><b>Lab join date</b><br></label>
		<input type = "date" name = "joined" id = "joined">

		<label for="grad"><br><br><b>Lab leave date</b><br></label>
		<input type = "date" name = "grad" id = "grad">

		<label for="project"><br><br><b>Member project(s)</b></label>
		<input list="project" id="project" name="project" required>
		<datalist id="projects">
			<option value="TLR9a treatment"> </option>
			<option value="NK-SADKA"> </option>
			<option value="ILCs"> </option>
			<option value="PD-1 treatment"> </option>
		</datalist>

		<br><br>
		
		<input type="submit" class="btn" name="submitMember" id="submitMember" value="Add lab member" />
		<button type="button" class="btn cancel" onclick="closeFormleft()">Close</button>
	</form>
</div>

<script>
function openFormleft() {
	document.getElementById("addMember").style.display = "block";
}

function closeFormleft() {
	document.getElementById("addMember").style.display = "none";
}

</script>

<!-- Center, edit member -->
<button class = "open-button-r" onclick = "openFormcenter()">Edit existing lab member</button>


<div class = "form-popup-r" id = "editMember">
        <form class = "form-container-r" method = "post" id = "editMemberform"  action="<?php echo $_SERVER['PHP_SELF'];?>">
		<h1> Edit existing lab member </h1>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="name-c"><b>Lab member name</b><br></label>
		<select name="name-c" id="name-c" form="editMemberform">
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

		<label for="joined-c"><br><br><b>Lab join date</b><br></label>
		<input type = "date" name = "joined-c" id = "joined-c">

		<label for="grad-c"><br><br><b>Lab leave date</b><br></label>
		<input type = "date" name = "grad-c" id = "grad-c">

		<label for="project-c"><br><br><b>Member project(s)</b></label>
		<input list="project-c" id="project-c" name="project-c">
		<datalist id="projects-c">
			<option value="TLR9a treatment"> </option>
			<option value="NK-SADKA"> </option>
			<option value="ILCs"> </option>
			<option value="PD-1 treatment"> </option>
		</datalist>

		<br><br>

		<input type="submit" class="btn" name="submitEdit" id="submitEdit" value="Edit member" />
		<button type="button" class="btn cancel" onclick="closeFormcenter()">Close</button>

	</form>
</div>

<script>
function openFormcenter() {
	document.getElementById("editMember").style.display = "block";
}

function closeFormcenter() {	
	document.getElementById("editMember").style.display = "none";
}

</script>

<!-- Right, search members -->
<button class = "open-button-c" onclick = "openFormright()"> Search member information & contributions </button>

<div class = "form-popup-c" id = "printMember">
        <form class = "form-container-c" method = "post" id = "printMemberform" action="printMember.php">
		<h1> Search member for information & contributions </h1>

		<?php
				$server="localhost";
				$username="maiabennett";
				$password="";
				$database="maiabennett";

				$connect = mysqli_connect($server,$username,$password,$database);

				if($connect->connect_error){
					echo "Connection error:" .$connect->connect_error;
				}

				$query = "select name from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="name-r"><b>Member name</b><br></label>
		<select name="name-r" id="name-r" form="printMemberform">
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
				$query = "select project from members";

				$result = mysqli_query($connect,$query)
					or trigger_error("Query Failed! SQL: $query - Error: "
					. mysqli_error($connect), E_USER_ERROR);

		?>

		<label for="project-r"><br><br><b>Member project(s)</b></label>
		<input list="project-r" id="project-r" name="project-r">
		<datalist id="projects-r">
			<option value="TLR9a treatment"> </option>
			<option value="NK-SADKA"> </option>
			<option value="ILCs"> </option>
			<option value="PD-1 treatment"> </option>
		</datalist>

		<br><br>


		<input type="submit" class="btn" name="submitPrint" id="submitPrint" value="Print member information"" />
		<button type="button" class="btn cancel" onclick="closeFormright()">Close</button>

	</form>
</div>

<script>
function openFormright() {
	document.getElementById("printMember").style.display = "block";
}

function closeFormright() {
 	document.getElementById("printMember").style.display = "none";
}

</script>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['submitMember'])) {

	$name=$_POST['name'];
	$joined=$_POST['joined'];
	$grad=$_POST['grad'];
	$project=$_POST['project'];


	if (empty($name)) {
	echo "<br>No member name given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	$query = "insert into members values (\"". $name ."\", \"". $joined ."\", \"". $grad ."\", \"". $project ."\")";

	if (mysqli_query($connect,$query)) {
			echo "Sucess!";
	} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	mysqli_close($connect);

} else if(isset($_POST['submitEdit'])) {

	$name=$_POST['name-c'];
	$joined=$_POST['joined-c'];
	$grad=$_POST['grad-c'];
	$project=$_POST['project-c'];


	if (empty($name)) {
	echo "<br>No member name given<br>";
	} 

	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";

	$connect = mysqli_connect($server,$username,$password,$database);

	if($connect->connect_error){
		echo "Connection error:" .$connect->connect_error;
	}

	if (!empty($joined)) {

		$query = "update members set joined = \"". $joined ."\" where name = \"". $name ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($grad)) {

		$query = "update members set grad = \"". $grad ."\" where name = \"". $name ."\"";

		if (mysqli_query($connect,$query)) {
			echo "Sucess!";
		} else
			trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

	} 

	if (!empty($project)) {

		$query = "update members set project = \"". $project ."\" where name = \"". $name ."\"";

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

