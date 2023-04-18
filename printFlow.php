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

		$assayID=$_POST['assayID-rr'];
		$donorID=$_POST['donorID-rr'];
		$filename=$_POST['filename-rr'];
		$cond=$_POST['cond-rr'];
		$FLID=$_POST['FLID-rr'];

		$server="localhost";
		$username="maiabennett";
		$password="";
		$database="maiabennett";

		$connect = mysqli_connect($server,$username,$password,$database);

		if($connect->connect_error){
			echo "Connection error:" .$connect->connect_error;
		}

		if (!empty($assayID)) {

			echo "<h2> Assay Information </h2>";

			$query = "select * from assay where assayID = \"". $assayID ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p><b> AssayID: </b>". $row[0] ."<br>
					<b>DonorID: </b>". $row[1] ."<br>
					<b>Run date: </b>". $row[2] ."<br>
					<b>Assay lead: </b>". $row[3] ."<br>
					<b>Magnetic enrichment: </b>". $row[4] ."<br>
					<b>Target cell staining: </b>". $row[5] ."<br>
					<b>Immunophenotype staining: </b>". $row[6] ."<br>
					<b>Flow cytometry: </b>". $row[7] ."<br>
					<b>Comments: </b>". $row[8] ."<br>
					<b>Conditions tested: </b> ";

					$query2 = "select cond from flowfiles where assayID = \"". $assayID ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							echo "". $row2[0] .", ";

						}

					echo " </p>";

					mysqli_free_result($result2);

    					}


    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

		}


		if (!empty($donorID)) {

			echo "<h2> Donor Information </h2>";

			$query = "select * from metadata where donorID = \"". $donorID ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p><b> DonorID: </b>". $row[0] ."<br>
					<b>Age: </b>". $row[1] ."<br>
					<b>Race/Ethnicity: </b>". $row[2] ."<br>
					<b>Sex: </b>". $row[3] ."<br>
					<b>Collection date: </b>". $row[4] ."<br>
					<b>Comments: </b>". $row[5] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}


			echo "<h2> Donor Assays </h2>";

			$query = "select assayID, run, comments from assay where donorID = \"". $donorID ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p> AssayID: ". $row[0] .", Run date: ". $row[1] .", Comments: ". $row[2] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

		}

		if (!empty($filename)) {

			echo "<h2> Assays with Files Named: ". $filename ." </h2>";

			$query = "select assayID from flowfiles where filename = \"". $filename ."\"";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

      					$assayID = $row[0];

					$query2 = "select assayID, donorID, run, comments from assay where assayID = \"". $assayID ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							echo "<p> AssayID: ". $row2[0] .", DonorID: ". $row2[1] .", Run date: ". $row2[2] .", Comments: ". $row2[3] ."<br></p>";

						}

					mysqli_free_result($result2);

    					}

				}

			mysqli_free_result($result);
			}


		}


		if (!empty($cond)) {

			echo "<h2> Assays Testing: ". $cond ." </h2>";

			$query = "select assayID from flowfiles where cond = \"". $cond ."\"";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

      					$assayID = $row[0];

					$query2 = "select assayID, donorID, run, comments from assay where assayID = \"". $assayID ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							echo "<p> AssayID: ". $row2[0] .", DonorID: ". $row2[1] .", Run date: ". $row2[2] .", Comments: ". $row2[3] ."<br></p>";

						}

					mysqli_free_result($result2);

    					}

				}

			mysqli_free_result($result);
			}
	
		}


		if (!empty($FLID)) {

			echo "<h2> Assays Using the ". $FLID ." Flow Panel </h2>";

			$query = "select assayID from flowfiles where FLID = \"". $FLID ."\"";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

      					$assayID = $row[0];

					$query2 = "select assayID, donorID, run, comments from assay where assayID = \"". $assayID ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							echo "<p> AssayID: ". $row2[0] .", DonorID: ". $row2[1] .", Run date: ". $row2[2] .", Comments: ". $row2[3] ."<br></p>";

						}

					mysqli_free_result($result2);

    					}

				}

			mysqli_free_result($result);
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

