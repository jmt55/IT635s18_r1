<?php  //header to use

include 'func.php';
include 'pic.html';

$accessType = $_POST['accessType'];
  
session_start();

if (isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
	$loggedin = TRUE;
}

else $loggedin = FALSE;

echo "<html><head><title>King Boo Inventory";
if ($loggedin) echo " ($user)";
			   echo "</title></head><body><font face='calibri' size='4'>";
			   echo "<h4>King Boo Inventory </h4>";
			   
if ($loggedin && $user != "adminuser" ) 
{
	     echo "<b> $user</b>:
	     <a href='logout.php'>Log out</a> |
	     <a href='stduserhome.html'>Home</a>";
}	
else if ($loggedin && $user == "adminuser")
{	     
	     echo "<b>$user</b>:
	     <a href='logout.php'>Log out</a> |
	     <a href='admin_home.html'>home</a>";
}
else
{
	      echo "<a href='home_page.php'>Login</a>";

}

?>	      
	
