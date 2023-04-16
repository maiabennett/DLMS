class populateData {
	$server="localhost";
	$username="maiabennett";
	$password="";
	$database="maiabennett";
	$con;

	function __construct() {
		$this->con = $this->connectDB();
	}

	function connectDB() {
		$connect = mysqli_connect($this->server,$this->username,"",$this->database);
		return $connect;
	}

	function getData() {
	$result = mysqli_query($this->connect, $query);
	while($row=mysqli_fetch_assoc($result)) {
		$resultset[] = $row;
	}
	if(!empty($resultset))
		return $resultset;
	}
}

