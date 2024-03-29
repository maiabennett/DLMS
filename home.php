<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="styles.css">

</head>
<body>


<!-- Navigation -->
<ul>
        <li class = "active"><a href="home.php">Homepage</a></li>
        <li><a href="data-manager.php">Flow data manager</a></li>
        <li><a href="flow-analysis.php">Flow data analysis</a></li>
        <li><a href="flow-viewer.php">Flow panel viewer</a></li>
        <li><a href="member-viewer.php">Lab member viewer</a></li>
</ul>


<!-- User agreement popup --> 
<div class = "agree" id = "userAgreement">
	<h1> Terms of Site Use </h1>

	<p> The Denton Immunobiology Lab Management System contains <b> confidential data secured under Material Transfer Agreements. </b><br><br>
	Use of this site is limited to permitted Denton Immunology Lab members. <br>
	Data contained and analyzed on this site is to remain confidential by those accessing it. <br><br>
	In selecting below to close this agreement, <b>you acknowledge that you have read this agreement and accept all of its terms. </b><br><br></p>
	<h2> Any violation of these terms is subject to disciplinary actions including the potential of dismissal from the lab. </h2>

	<button type="button" class="btn" onclick="agree()"><b>I acknowledge and agree to these terms.</b></button>

</div>

<script>
function openAgreement() {
	document.getElementById("userAgreement").style.display = "block";
}

window.onload = openAgreement;

function agree() {
	document.getElementById("userAgreement").style.display = "none";
	document.getElementById("home").style.display = "block";
}

</script>


<!-- Header image -->
<div class="header-imm">
</div>


<!-- Content -->
<div class= "home" id="home">
	
	<h1> Welcome to the Denton Immunobiology Lab Management System! </h1>

	<h3> Background </h3>
	<p> Cancer treatment outcomes have radically improved in recent years. The incorporation of immunotherapies into oncology 
treatments is a major contributing factor in these improved outcomes. Immunotherapy is treatment intended to modulate immune system activity
 in response to disease. The benefits of cancer immunotherapy were notably recognized with the awarding of the 2018 Nobel Prize in Physiology 
or Medicine to Drs. Honjo and Allison. Yet, there remain critical barriers to achieving successful immunotherapies for the majority of cancer 
patients. To help overcome these barriers, this research group is focused on improving immunotherapies to treat malignancies. Our approach is to 
develop and validate novel combination immunotherapy strategies to functionally improve natural killer (NK) cells capacity for destroying 
cancer cells either directly or via antibody dependent cellular cytotoxicity. Furthermore, responses to immunotherapies are not universal in 
patients as some individuals have great clinical responses and outcomes while others may experience hyper-progression and rapid clinical
 decline. Therefore, our research group is also striving to provide important mechanistic insights that to help explain these differential
 responses to immunotherapy between individuals.<b> - Dr. Paul W. Denton </b></p>

	<h3> Current foci </h3>
	<p> With the recent development of the <b>Natural Killer cell Simultaneous ADCC and Direct Killing Assay (NK-SADKA)</b>, 
our lab has become increasingly focused on multimodal data generation and analysis. These datum include donor and assay metadata, flow cytometry data 
for killing assays and immunophenotyping, reagent information, and lab member contributions to gathering these data. </p>

	<h3> The lab management system </h3>
	<p> This lab management system was developed in preparation for increasing data analysis, reagent ordering, and data distribution 
(publications, conferences, etc.) by the Denton Lab. It encompasses three main functionalities: <br></p>
	<blockquote><b> 1. Storage, revision, and retrieval of assay data. </b> This includes donor metadata, and detailed information 
on assays and flow cytometry files generated by assays. <br>
	<b> 2. Storage, revision, and retrieval of flow cytometry panel data. </b> This includes compensation and 
flow cytometry panel information as well as product specifications for the conjugated fluorophores they utilize. <br>
	<b> 3. Storage, revision, and retrieval of lab member data. </b> This includes basic lab member information 
as well as a retrieval system for member contributions. <br></blockquote>
	<p> The underlying code and documentation for the Denton Lab Management System can be found on <b><a href="https://github.com/maiabennett/flowDB">
Github</a></b>. The repository includes all relevant MySQL schema, a data dictionary, and instructions for use. </p>

	<p style="float:right;color:#dcdcdc">Developed by Maia Bennett, 2023</p>

</div>

</body>
</html>

