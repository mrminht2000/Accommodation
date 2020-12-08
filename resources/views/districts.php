<option>--Chọn quận/huyện--</option>
<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'hocphp');
function executeResult($sql) {
    // save database into table
    //open connection to database

    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    //insert, update, delete
    $result = mysqli_query($con, $sql);
    $data = [];
    if($result != null) {
        while ($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
    }

    //close connection
    mysqli_close($con);
    return $data;
}
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $dbname = "rent_house";
	// $conn = new PDO("mysql:host=$servername; dbname=$dbname",$username,$password);
	// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $conn->exec("SET CHARACTER SET utf-8");

	$sql = "SELECT * FROM districts WHERE province_id = ".$_POST["province_id"];
	// $query = $conn->prepare($sql);
	// $query->execute();
	// $result = $query->fetchALL(PDO::FETCH_ASSDC);
    $result = executeResult($sql);
	foreach($result as $row) {
		echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
	}
?>
		