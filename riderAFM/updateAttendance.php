<?php
$servername = "localhost";
$username = "iberkatm_iberkat";
$password = "shati5620";
$dbname = "iberkatm_iBerkat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$noIC = $_POST['noIC'];
$nama= $_POST['nama'];
$role= $_POST['role'];
$stationCode= $_POST['stationCode'];
$status= $_POST['status'];
$date= $_POST['date'];
$time= $_POST['time'];

$sql = "INSERT INTO attendance (noIC, nama, role, stationCode, status, date, time) VALUES ('$noIC', '$nama', '$role', '$stationCode', '$status', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    echo '<i class="fas fa-check-circle"></i>';
	
} else {
    echo '<i class="fas fa-times-circle"></i>';
}

$conn->close();
?>