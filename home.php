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
        <li class = "active"><a href="member-viewer.php">Lab member viewer</a></li>
</ul>


<!-- User agreement popup --> 
<div class = "agree" id = "userAgreement">
	<h1> Terms of Site Use </h1>

	<p> The Denton Immunobiology Lab Management System contains confidential data secured under Material Transfer Agreements. <br>
	Use of this site is limited to permitted Denton Immunology Lab members. <br>
	Data contained and analyzed on this site is to remain confidential by those accessing it. <br>
	In selecting below to close this agreement, you acknowledge that you have read this agreement and accept all of its terms. <br>
	Any violation of these terms is subject to disciplinary actions including the potential of dismissal from the lab. </p>

	<button type="button" class="btn" onclick="agree()">I acknowledge and agree to these terms.</button>

</div>

<script>
function openAgreement() {
	document.getElementById("userAgreement").style.display = "block";
}

window.onload = openAgreement;

function agree() {
	document.getElementById("userAgreement").style.display = "none";
}

</script>


<!-- Header image -->
<div class="header-imm">
</div>


<!-- Content -->
<div class= "homepage">
	
	<h1> Welcome to the Denton Immunobiology Lab Management System! </h1>

	<p> General lab overview here. </p>

</div>

</body>
</html>

