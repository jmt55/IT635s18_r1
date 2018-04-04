<?php

include 'login.inc'; //login credentials for database connection
require_once 'session_head.php'; //provides the navigation menu bar 

//php mysql functions to create connection to mysql server
 
$db_server = mysqli_connect($dbhostname, $dbuser, $dbpassword);

  if (!$db_server) die("Unable to connect to MySQL: " . mysqli_error());

//php mysql function to select database from server 

mysqli_select_db($db_server, $dbdatabase)
    or die("Unable to select database: " . mysqli_error());

/*check variables is not null then feeds input from web form to listed variables

then summons php mysql function query to insert input received from POST method into WKSINV table.
*/
  if (isset($_POST['sn']) &&
      isset($_POST['hostname']) &&
      isset($_POST['model']) &&
      isset($_POST['type']) &&
      isset($_POST['cpu']) &&
      isset($_POST['ram']) &&
      isset($_POST['hdd_type']) &&
      isset($_POST['user']) &&
      isset($_POST['status']) &&
      isset($_POST['po_date']) &&
      isset($_POST['refresh_date']) &&
      isset($_POST['wty_exp']))
  {
    $sn           = $_POST['sn'];
    $hostname     = $_POST['hostname'];
    $model        = $_POST['model'];
    $type         = $_POST['type'];
    $cpu          = $_POST['cpu'];
    $ram          = $_POST['ram'];
    $hdd_type     = $_POST['hdd_type'];
    $user         = $_POST['user'];
    $status       = $_POST['status'];
    $po_date      = $_POST['po_date'];
    $refresh_date = $_POST['refresh_date'];
    $wty_exp      = $_POST['wty_exp'];

    $query = "INSERT INTO wksinv VALUES" . "('$sn','$hostname', '$model', '$type', '$cpu', '$ram', '$hdd_type', '$user', '$status', '$po_date', '$refresh_date', '$wty_exp')";

    if (!mysqli_query($db_server, $query))
	{
      echo "INSERT failed: $query<br>" . mysqli_error() . "<br><br>";
	}
	else
	{
	echo "Asset Added";
	}
  }

//simple asset web form 
echo <<<_END
<h2> Asset Form </h2>
  <form action="testform.php" method="post"><pre>
    sn       <input type="text" name="sn">
    hostname <input type="text" name="hostname">
    model    <input type="text" name="model">
    type     <input type="text" name="type">			
    cpu      <input type="text" name="cpu">
    ram      <input type="text" name="ram">
    hdd_type <input type="text" name="hdd_type">
    user     <input type="text" name="user">
    status   <input type="text" name="status">
    po_date  <input type="date" name="po_date">
refresh_date <input type="date" name="refresh_date">
    wty_exp  <input type="date" name="wty_exp">
          <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

mysqli_close($db_server);
  
  function get_post($db_server,$var)
  {
    return mysqli_real_escape_string($_POST[$var]);
  }



?>



