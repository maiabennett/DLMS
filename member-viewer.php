<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="styles.css">

</head>
<body>

<?php include "populateData.php"; ?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>

<!-- Navigation -->
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
<button class = "open-button-l" onclick = "openFormleft()">Add new human donor</button>

// Popup bar options
<div class = "form-popup-l" id = "addMember">
	<form class = "form-container-l" method = "post" id = "addMemberform">
		<h1> New lab member </h1>

		<label for = "name"><b>Member name</b></label>
		<input type = "text" placeholder = "Enter member name" name = "name" id = "name" required>

		<label for="joined"><b>Lab join date</b></label>
		<input type = "text" placeholder = "MM-DD-YYYY" name = "joined" id = "joined">

		<label for="grad"><b>Lab leave date</b></label>
		<input type = "text" placeholder = "MM-DD-YYYY" name = "grad" id = "grad">
		
		<input type="button" class="btn" id="submitMember" onclick="SubmitMemberData()" value="Add lab member" />
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

function SubmitMemberData() {
    var name = $("#name").val();
    var joined = $("#joined").val();
    var grad = $("#grad").val();
    $.post("addMember.php", { name: name, joined: joined, grad: grad },
    function(data) {
	 alert(data);
	 $('#addMemberform')[0].reset();
    });
}
</script>

<!-- Center, edit member -->
<button class = "open-button-r" onclick = "openFormright()">Edit existing lab member</button>

// Popup bar options
<div class = "form-popup-r" id = "editMember">
        <form class = "form-container-r" method = "post" id = "addAssayform">
		<h1> Edit existing lab member </h1>

		<?php
	      		$obj = new populateData();
	      		$row = $obj->getData("select name from members");
		?>
		<label for="name-r"><b>Lab member name</b></label>
		<select name="name-r" id="name-r" form="editMemberform">
			<?php foreach($row as $row){ ?>
			<option> <?php echo $row['name'] ?> </option>
		<?php  } ?>
		</select>
		
		<label for="joined-r"><b>Lab join date</b></label>
		<input type = "text" placeholder = "MM-DD-YYYY" name = "joined-r" id = "joined-r">

		<label for="grad-r"><b>Lab leave date</b></label>
		<input type = "text" placeholder = "MM-DD-YYYY" name = "grad-r" id = "grad-r">

		<input type="button" class="btn" id="submitEdit" onclick="SubmitEditData()" value="Edit member" />
		<button type="button" class="btn cancel" onclick="closeFormright()">Close</button>

	</form>
</div>

<script>
function openFormright() {
	document.getElementById("editMember").style.display = "block";
}

function closeFormright() {	
	document.getElementById("editMember").style.display = "none";
}

function SubmitEditData() {
    var name = $("#name-r").val();
    var joined = $("#joined-r").val();
    var grad = $("#grad-r").val();
    $.post("editMember.php", { name: name, joined: joined, grad: grad },
    function(data) {
	 alert(data);
	 $('#editMemberform')[0].reset();
    });
}
</script>

<!-- Right, search members -->
<div class = "search-bar">
	<form class = "search" method = "post" id = "printMember">
		<h1> Search member for information & contributions </h1>

		<?php
			$obj = new populateData();
			$row = $obj->getData("select name from members");
		?>

		<label for="name"><b>Member name</b></label>
		<select name="name" id="name" form="printMember">

			<?php foreach($row as $row){ ?>
				<option> <?php echo $row['name'] ?> </option>
			<?php  } ?>

		</select>

		<input type="button" class="button" id="tst" value="Print member information" onclick="printMember()" />

	</form>
</div>

<script>
<!-- Only need to pass the primary key (name) to PHP function which builds result -->
function printMember() {
    var name = $("#name").val();
    $.post("printMember.php", { name: name });
}
</script>

</body>
</html>

