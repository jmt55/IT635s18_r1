<?php //request_asset.php

require_once 'login.inc'; //database login credentials
require_once 'session_head.php'; //provides web header and session

$user = $_SESSION['user']; //sets variable to logged on user's name 

$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword); //connectin to mysql server

if (!$db_server) die("unable to connect to MySQL:" . mysqli_error()); //provide hints when connection error occurs

mysqli_select_db($db_server, $dbdatabase) or die ("unable to select database: " . mysqli_error()); //selects database

if (isset($_POST['request']) && isset($_POST['sn'])) //use post method to grab 'click' request and array row for 'sn' both are hidden
{
	$sn = $_POST['sn'];
	$query = "insert into wksrequest (user, sn) values" . "('$user', '$sn')"; //insert query values received from post method into wksrequest table
	
	if (!mysqli_query($db_server, $query)) //provide error for troubleshooting 
		{
		echo ("request unsuccessful: $query <br />" . mysqli_error());
		}
		else 
		{
		echo "request added";
		}
}

/*
segment below queries mysql for 'available' assets and uses mysqli_fetch_row to out matching row arrays 

web form echoed with button to request asset.

*/

$query = "select * from wksinv where status = 'available'"; 
$result = mysqli_query($db_server, $query);

if (!$result) die ("database access failed: " . mysqli_error());
$rownumber = mysqli_num_rows($result);

for ($i = 0; $i < $rownumber; ++$i)
{
	$row = mysqli_fetch_row($result); 
echo <<<_END
	<pre>
	sn:       $row[0]
	model:    $row[2]
	type:     $row[3]
	cpu:	  $row[4]
	ram:      $row[5]
	hdd_type: $row[6]
	status:   $row[8]
    refresh_date: $row[10]
	</pre>
	<form action="request_asset.php" method="post">
	<input type="hidden" name="request" value="yes" />
	<input type="hidden" name="sn" value="$row[0]" />
	<input type="submit" value="Request asset above" /></form>
_END;

}

mysqli_close($db_server); //close connection to mysql server


?>
