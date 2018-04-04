<?php 

require_once 'session_head.php'; //contains web logo and session tracking
echo "<h3> Log in please </h3>";

$loginfail = $user = $password = $accessType = ""; //loginfail variable parameters passed

/*
verify if for is null or not, grabs user input for user, password, accessType -
then escapes string

*/
if (isset($_POST['user']) &&
    isset($_POST['password']) &&
    isset($_POST['accessType']))
{
        $user = washString($_POST['user']);
        $password  = washString($_POST['password']);
        $accessType = washString($_POST['accessType']);

/*
if user and password field is blank loginfail variable display reason
*/
if ($user == "" || $password == "")
{
        $loginfail = "incomplete fields <br />";
}

/*
php sql query below to select and match passed variable data from database members table and return data into variable $result
*/

        $query = "select user,password,accessType from members where user= '$user' and password= '$password' and accessType= '$accessType'";

        $result = mysqli_query($db_server,$query) or die(mysqli_error());
/*
script below is for matching hashed password to db then based on accessType provided proper link to inventory profile is provided.

*/
        if (mysqli_num_rows($result))
	{
		$row = mysqli_fetch_row($result);
		$salt1 = "b0k$";
		$salt2 = "h$1n";
		$hashbrown = md5("$salt1$password$salt2");
		
		if($hashbrown == $row[2])
		{
			echo "Welcome $row[1]";
		}
		else
                {	
                $loginfail = "bad combination of user or password or accessType<br />";
                }
	}	
        else if($accessType == 'admin')
        {
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                die("login as admin is successful.  Please <a href='admin_home.html'>click here</a>.");
        }
        else
        {
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                die("login as standard user is successul.  Please <a href='stduserhome.html'>click here</a>.");
        }

}



//web logon form below
echo <<<_END
<form method='post' action='home_page.php'> $loginfail
 <pre>
 Username   <input type='text' maxlength='16' name='user' value='$user' /><br />
 Password   <input type='password' maxlength='16' name='password' value='$password'  /><br />
 accessType <input type='accessType' maxlength='16' name='accessType' value='$accessType' /><br />
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
 <input type='submit' value='Login'>
</pre>
</form>
_END;


?>
