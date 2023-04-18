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

		$FLID=$_POST['FLID-r'];

		$server="localhost";
		$username="maiabennett";
		$password="";
		$database="maiabennett";

		$connect = mysqli_connect($server,$username,$password,$database);

		if($connect->connect_error){
			echo "Connection error:" .$connect->connect_error;
		}

		if (!empty($FLID)) {

			echo "<h2> Panel information </h2>";

			$query = "select * from flowpanel where FLID = \"". $FLID ."\"";

			$result = mysqli_query($connect,$query)
			or trigger_error("Query Failed! SQL: $query - Error: "
			. mysqli_error($connect), E_USER_ERROR);

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

				echo "<p><b> Name: </b>". $row[0] ."<br>
					<b>Compensation used: </b>". $row[9] ."<br>
					<b>Currently used?: </b>". $row[10] ."<br>
					<b>Comments: </b>". $row[11] ."<br></p>";

    				}
    				mysqli_free_result($result);
			}else{
				echo "No results";
			}

			echo "<h2> Marker information </h2>

			<table class='table-flow'> 
      				<tr> 
          			<td> FL# </td>
          			<td> Marker </td>  
          			<td> Fluorophore </td>
          			<td> Catalog information </td>
          			<td> Gene product </td>
      				</tr>";

			$query = "select FL1, FL2, FL3, FL4, FL5, FL6, FL7, FL8 from flowpanel where FLID = \"". $FLID ."\"";

			if ($result = mysqli_query($connect, $query)) {
	    			while ($row = mysqli_fetch_row($result)) {

      					$FL1 = $row[0];
      					$FL2 = $row[1];
      					$FL3 = $row[2];
      					$FL4 = $row[3];
      					$FL5 = $row[4];
      					$FL6 = $row[5];
      					$FL7 = $row[6];
      					$FL8 = $row[7];

					$query2 = "select * from markers where markerID = \"". $FL1 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL1 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);

    					}

					$query2 = "select * from markers where markerID = \"". $FL2 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL2 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL3 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL3 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL4 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL4 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL5 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL5 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL6 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL6 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL7 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL7 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}

					$query2 = "select * from markers where markerID = \"". $FL8 ."\"";

					if ($result2 = mysqli_query($connect, $query2)) {
	    					while ($row2 = mysqli_fetch_row($result2)) {

							$marker = $row2[0];
      							$fluor = $row2[1];
      							$catID = $row2[3];
      							$gene_product = $row2[4];

        					echo "<tr> 
							<td> FL8 </td>
                  					<td>". $marker ."</td> 
                  					<td>". $fluor ."</td> 
                  					<td>". $catID ."</td>
                  					<td>". $gene_product ."</td>
              					</tr>";
						}

					mysqli_free_result($result2);
					}
				}

			mysqli_free_result($result);
			}
	
			echo "</table> <br><br><br><br><br><br><br><br><br><br><br><br>";
		}
    
	} 
			
	?>

</div>

<div class="bottomsig">
	<p style="float:right;">Developed by Maia Bennett, 2023</p>
</div>


</body>
</html>

