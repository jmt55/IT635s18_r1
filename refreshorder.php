<?php //refreshorder.php 

require_once 'login.inc'; //holds database credentials
require_once 'session_head.php'; //provides web header and session

$user = $_SESSION['user'];

$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword); //connect to mysql server

if (!$db_server) die("unable to connect to MySQL:" . mysqli_error()); //provide error output if any

mysqli_select_db($db_server, $dbdatabase) or die ("unable to select database: " . mysqli_error()); //selects database and provides error if any

$query = "select * from wksrequest"; //php mysql command to query all asset from wksrequest table
$result = mysqli_query($db_server, $query); //holds retrieved data 

if (!$result) die ("database access failed: " . mysqli_error());

 echo "<h3> Requested Asset are below: </h3>";

while($row = mysqli_fetch_assoc($result)) //outputs retrieved data array from table
 {
   extract($row);
        echo 'req_no: '       . "$req_no <br />";
        echo 'user: '         . "$user <br />";
        echo 'sn: '           . "$sn <br />";
        echo 'request_time: ' . "$request_time <br />";
        echo "<br />";
        echo "<hr>";
 }

mysqli_close($db_server); //close connectoin to database

?>

