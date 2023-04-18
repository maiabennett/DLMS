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
        <li class = "active"><a href="flow-analysis.php">Flow data analysis</a></li>
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>

<!-- Header image -->
<div class="header-imm">
</div>


<!-- Content -->
<div class= "homepage">

	<h2> A simplified FlowSOM analysis </h2>
	<h3> Background </h3>
	<p> To gather useful information from flow cytometry data, individual cells must be identified by type and subtype; 
this is often accomplished using canonical markers (those ubiquitous to a given cell type) as well as less universal subtype markers. 
The process of cell phenotype clustering is made more complicated by the facts that these markers are expressed on a biological spectrum- i.e.,
 not in a binary process- and that cells of unrelated phenotypes often express the same marker. Populations may be manually discriminated 
in a process termed <q>gating</q>, in which bivariate plots are used to drill down on individual cell populations using canonical marker combinations
. This process often introduces human bias into phenotype identification due to gate placement and can miss atypical cells with
 aberrant marker expression. Further, all immune cells exist on a spectrum of maturation and differentiation, 
exhibiting differing marker expression and biological functions as they progress along this spectrum. The relationships between cell 
phenotypes along this progression-known as cellular hierarchy-lends biological relevance to analysis of cytometric data. Graph-based flow cytometry 
analysis algorithms such as <b> FlowSOM </b> were developed to 1) facilitate highly-dimensional and multivariate analysis and 2) minimize human 
error in analysis of multicolor flow cytometry data. </p>
	<p> In brief, the FlowSOM algorithm  uses self-organizing map (SOM) clustering to cluster cells in flow cytometry data 
with similar marker expression. Once all cells have been clustered, weighted edges are assigned between every single cluster
 with high distances indicating low similarity and low distances indicating high similarity. Then, 
another algorithm is used to pick the best edges to connect all clusters across the tree. This algorithm, minimum spanning tree (MST), 
is used to estimate how cells differentiate from common to distinct. A final metaclustering step is used to predict 
distinct subsets of cells from these clusters. </p>

	<h3> The FlowSOM demo </h3>
	<p> This page facilitates a simple example of multicolor flow analysis using four files, two "Untreated.fcs" files and two "Treated.fcs". The data contained 
in these files was collected as a part of <b>AM033c</b> and <b>AM033d</b> and includes untreated and a-CD20-stimulated 8-color NK cell immunophenotyping data. 
Details on the flow cytometry panel used, donor metadata, and assay can be found elsewhere on this site. These files 
have been pre-loaded into this UI environment to facilitate this tutorial. Further analyses should be run using <b><a href="https://premium.cytobank.org/cytobank/">
the CytoBank FlowSOM UI</a></b> according to <b><a href="https://support.cytobank.org/hc/en-us/articles/360018965212-Introduction-to-FlowSOM-in-Cytobank">
these resources</a></b>. CytoBank is capable of extending the capabilities exemplified in this demo to a high extent, facilitating more intuitive 
and interactive analysis of many samples, donors, and conditions. </p>
	<p> For this demo, the results of your queries will be available in the local file system under the "FlowSOM-results" folder. All R code
 used to generate these results can be found in this <b><a href="https://github.com/maiabennett/flowDB">Github repository</a></b>.</p> 

	<h4> Single-sample FlowSOM analysis </h4>
	<p> Examining data from one donor for one condition (a single flow file) is the most simple form of FlowSOM analysis.
 Use the dropdown bar to select one donor file, name your output file, then select 'Run analysis'. In brief, the R code for this analysis 
applies compensation to the file, pre-processes the data (removing margin events and doublets, then setting live and NK cell gates), 
runs the FlowSOM algorithm to construct the FlowSOM tree, and outputs a PDF file containing a summary (FlowSOMmary) of the result. <p>

	<form name="singleAnalysis" id="singleAnalysis">

		<label for="single"><b>Select file: </b></label>
		<select name="single" id="single" form="singleAnalysis" required>
			<option value="AM033c, Untreated.fcs">AM033c, Untreated.fcs</option>
			<option value="AM033d, Untreated.fcs">AM033d, Untreated.fcs</option>
			<option value="AM033c, Treated.fcs">AM033c, Treated.fcs</option>
			<option value="AM033d, Treated.fcs">AM033d, Treated.fcs</option>
		</select>

		<label for="fileout-s"><br><br><b>Output file name: </b></label>
		<input type = "text" placeholder = "ex., yourname-filename-assay" name = "fileout-s" id = "fileout-s" required>

		<br><br>

		<input type="submit" name="submitSingle" id="submitSingle" value="Run analysis" />

	</form>

	<h4> Multi-sample aggregate FlowSOM analysis </h4>
	<p> Examining aggregated data from multiple donors for one (or more) conditions is a more complicated form of FlowSOM analysis. Use the 
dropdown bar to select two donor files, name your output file, then select 'Run analysis'. In brief, the R code for this analysis 
applies compensation to the files, pre-processes the data (removing margin events and doublets, then setting live and NK cell gates), aggregates 
the indicated files, runs the FlowSOM algorithm to construct the FlowSOM tree, and outputs a PDF file containing a summary (FlowSOMmary) 
of the aggregated result. </p>

	<form name="multAnalysis" id="multAnalysis">

		<label for="mult"><b>Select files: </b></label>
		<select name="single" id="mult" form="multAnalysis" multiple required>
			<option value="AM033c, Untreated.fcs">AM033c, Untreated.fcs</option>
			<option value="AM033d, Untreated.fcs">AM033d, Untreated.fcs</option>
			<option value="AM033c, Treated.fcs">AM033c, Treated.fcs</option>
			<option value="AM033d, Treated.fcs">AM033d, Treated.fcs</option>
		</select>


		<label for="fileout-m"><br><br><b>Output file name: </b></label>
		<input type = "text" placeholder = "ex., yourname-filename-assay" name = "fileout-m" id = "fileout-m" required>

		<br><br>

		<input type="submit" name="submitMult" id="submitMult" value="Run analysis" />

	</form>

	
	<h4> Condition-based FlowSOM analysis </h4>
	<p> The previous analysis can be extended by overlaying individual samples on top of an aggregated FlowSOM result, enabling analysis 
by donor or by condition. Use the first dropdown bar to select two donor files, use the second dropdown bar to indicate the condition you 
are analyzing the aggregate by, name your output file, then select 'Run analysis'. In brief, the R code for this analysis 
applies compensation to the files, pre-processes the data (removing margin events and doublets, then setting live and NK cell gates), aggregates 
the indicated files, runs the FlowSOM algorithm to construct the FlowSOM tree, overlays each individual preprocessed file on top of the aggregate,
computes significant differences in cluster composition between the individual overlays, and outputs two PDF files containing 1) a summary (FlowSOMmary) 
of the aggregated result and 2) a visualization of significant cluster composition differences. Note: for "Treated vs. Untreated" analysis, it is recommended you use the same donor; for "Donor 1 vs. Donor 2" it is 
recommended you use the same condition. </p>

	<form name="condAnalysis" id="condAnalysis">

		<label for="condfiles"><b>Select files: </b></label>
		<select name="condfiles" id="condfiles" form="condAnalysis" multiple required>
			<option value="AM033c, Untreated.fcs">AM033c, Untreated.fcs</option>
			<option value="AM033d, Untreated.fcs">AM033d, Untreated.fcs</option>
			<option value="AM033c, Treated.fcs">AM033c, Treated.fcs</option>
			<option value="AM033d, Treated.fcs">AM033d, Treated.fcs</option>
		</select>

		<label for="cond"><br><br><b>Select condition tested: </b></label>
		<select name="cond" id="cond" form="condAnalysis" required>
			<option value="AM033c, Untreated.fcs">Treated vs. Untreated</option>
			<option value="AM033d, Untreated.fcs">AM033d, Untreated.fcs</option>
		</select>


		<label for="fileout-c"><br><br><b>Output file name: </b></label>
		<input type = "text" placeholder = "ex., yourname-filename-assay" name = "fileout-c" id = "fileout-c" required>

		<br><br>

		<input type="submit" name="submitCond" id="submitCond" value="Run analysis" />

	</form>


</div>

<?php

if(isset($_POST['submitSingle'])) {

	$file=$_POST['single'];
	$fileout=$_POST['fileout-s'];



} else if(isset($_POST['submitMult'])) {

	$files=$_POST['mult'];
	$file1=$files[0];
	$file2=$files[1];
	$fileout=$_POST['fileout-m'];



} else if(isset($_POST['submitCond'])) {

	$files=$_POST['condfiles'];
	$file1=$files[0];
	$file2=$files[1];
	$cond=$_POST['cond'];
	$fileout=$_POST['fileout-c'];



}



?>

<div class="bottomsig">
	<p style="float:right;">Developed by Maia Bennett, 2023</p>
</div>


</body>
</html>

