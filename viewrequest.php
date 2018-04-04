<?php //view_request.php -provides user a receipt of their requested asset

require_once 'login.inc'; //contains database credentials
require_once 'session_head.php'; //provides web header and session

$user = $_SESSION['user']; //set variable to specified logged on user's name

$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword); //connection to mysql server

if (!$db_server) die("unable to connect to MySQL:" . mysqli_error()); //output error if any

mysqli_select_db($db_server, $dbdatabase) or die ("unable to select database: " . mysqli_error()); //select database

$query = "select * from wksrequest where user = '$user'"; //grabs from wksrequest table assets in which the variable user is a match
$result = mysqli_query($db_server, $query); //holds queried data

if (!$result) die ("database access failed: " . mysqli_error());

 echo "<h3> Requested Asset are below: </h3>";

while($row = mysqli_fetch_assoc($result)) //outputs data array
 {
   extract($row);
        echo 'req_no: '       . "$req_no <br />";
        echo 'user: '         . "$user <br />";
        echo 'sn: '           . "$sn <br />";
        echo 'request_time: ' . "$request_time <br />";
        echo "<br />";
        echo "<hr>";
 }

mysqli_close($db_server); //close connection to mysql server

?>

