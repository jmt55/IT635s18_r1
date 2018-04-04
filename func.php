<?php //func.php - list of functions used via "session_head.php"

$dbhostname = 'localhost';
$dbuser = 'root';
$dbpassword = 'Ryder9uit';
$dbdatabase = 'ComputerInventory';

$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword);

if (!$db_server) die("unable to connect to MySQL:" . mysqli_error());

mysqli_select_db($db_server, $dbdatabase) or die ("unable to select database: " . mysqli_error());


function logOFF()
{
	$_SESSION=array();
	if (session_id() !="" || isset($_COOKIE[session_name90]))
		setcookie(session_name(), "",time()-2592000, '/');
		
		session_destroy();
}

function queryDB($query)
{
	 $result = mysqli_query($db_server, $query) or die (mysqli_error());
	 return $result;
}

function washString($var)
{
        $var = stripslashes ($var);
        $var = htmlentities ($var);
        $var = strip_tags ($var);
        return $var;
}

function cleanSQL($var)
{
        $var = mysql_real_escape_string($var);
        $var = washString($var);
        return $var;
}


?>


