<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="styles.css">

</head>
<body>


<!-- Navigation -->
<ul>
        <li><a href="home.php">Homepage</a></li>
        <li><a href="data-manager.php">Flow data manager</a></li>
        <li><a href="flow-analysis.php">Flow data analysis</a></li>
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<!-- Header image -->
<div class="header-imm">
</div>


<!-- Content -->
<div class= "homepage">

	<?php

	if ($_POST) {

		$name=$_POST['name-r'];
		$project=$_POST['project-r'];

		$server="localhost";
		$username="maiabennett";
		$password="";
		$database="maiabennett";

		$connect = mysqli_connect($server,$username,$password,$database);

		if($connect->connect_error){
			echo "Connection error:" .$connect->connect_error;
		}

		if (!empty($project)) {

			echo "<h2> Members on project </h2>";

			$query = "select * from members where project like \"%". $project ."%\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p><b> Name: </b>". $row[0] ."<br>
					<b>Start date: </b>". $row[1] ."<br>
					<b>Lab leave date: </b>". $row[2] ."<br>
					<b>Project(s): </b>". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

		}


		if (!empty($name)) {

			echo "<h2> Member information </h2>";

			$query = "select * from members where name = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p><b> Name: </b>". $row[0] ."<br>
					<b>Start date: </b>". $row[1] ."<br>
					<b>Lab leave date: </b>". $row[2] ."<br>
					<b>Project(s): </b>". $row[3] ."<br></p>";


    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			echo "<h2> Member contributions </h2>";
			
			$query = "select assayID, donorID, run, comments from assay where lead = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			echo "<h3> Assay lead </h3>";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {
	
				echo "<p> AssayID: ". $row[0] .", DonorID: ". $row[1] .", Run date: ". $row[2] .", Comments: ". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			$query = "select assayID, donorID, run, comments from assay where magnet = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			echo "<h3> Magnetic enrichment </h3>";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {
	
				echo "<p> AssayID: ". $row[0] .", DonorID: ". $row[1] .", Run date: ". $row[2] .", Comments: ". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			$query = "select assayID, donorID, run, comments from assay where targets = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			echo "<h3> Target cell staining </h3>";	

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p> AssayID: ". $row[0] .", DonorID: ". $row[1] .", Run date: ". $row[2] .", Comments: ". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			$query = "select assayID, donorID, run, comments from assay where staining = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			echo "<h3> Immunophenotype staining </h3>";	

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p> AssayID: ". $row[0] .", DonorID: ". $row[1] .", Run date: ". $row[2] .", Comments: ". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			$query = "select assayID, donorID, run, comments from assay where flow = \"". $name ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			echo "<h3> Flow cytometry </h3>";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {
	
				echo "<p> AssayID: ". $row[0] .", DonorID: ". $row[1] .", Run date: ". $row[2] .", Comments: ". $row[3] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}


		}	

	

	}

	?>

</div>

<div class="bottomsig">
	<p style="float:right;">Developed by Maia Bennett, 2023</p>
</div>


</body>
</html>

