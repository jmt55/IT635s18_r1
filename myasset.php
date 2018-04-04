<?php

require_once 'login.inc'; //db credentials
require_once 'session_head.php'; //provides web header and session start


$user = $_SESSION['user']; //sets variable to logged in session user

$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword); //create connection to mysql server

if (!$db_server) die("unable to connect to MySQL:" . mysqli_error()); //show error if connection fails

mysqli_select_db($db_server, $dbdatabase) or die ("unable to select database: " . mysqli_error()); //selects database

$query = "select * from wksinv where user = '$user'";  //query table matching logged in user session name
$result = mysqli_query($db_server, $query);

if (!$result) die ("database access failed: " . mysqli_error());

 echo "<h1> Below are your assigned workstation asset </h1>";

while($row = mysqli_fetch_assoc($result)) //fetch rows associated with the logged in user session.
 {
   extract($row);
        echo 'sn: ' . "$sn <br />";
        echo 'hostname: ' . "$hostname <br />";
        echo 'model: ' . "$model <br />";
        echo 'type: ' . "$type <br />";
        echo 'cpu: ' . "$cpu <br />";
        echo 'ram: ' . "$ram <br />";
        echo 'hdd_type: ' . "$hdd_type <br />";
        echo 'user: ' . "$user <br />";
        echo 'status: ' . "$status <br />";
        echo 'po_date ' . "$po_date <br />";
        echo 'refresh_date ' . "$refresh_date <br />";
        echo 'wty_exp ' . "$wty_exp <br />";
        echo "<br />";
        echo "<hr>";
 }

mysqli_close($db_server);

?>
