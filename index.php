<?php 
header ("Content-Type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
	
if(isset($_POST['go']))
{
	session_start();
	// must create db and change connections
	error_log("start");

    $conn = mysqli_connect("127.0.0.1:3306", "root","1656");
    if (!$conn) {
        die("Database tp4 connection failed: " . mysqli_error());
    }

    $db_selected = mysqli_select_db($conn,'tp4');
    if (!$db_selected) {
        die("Database tp4 selection failed: " . mysqli_error());
    }

	$sql = "SELECT login FROM user_info WHERE login='".$_POST['login']."' AND pass='".$_POST['pass']."';";
	$result = mysqli_query($conn, $sql);
    if (!$result) {
        die ('Не удалось выполнить запрос "select login from tp4": ' . mysqli_error());
    }
    if (!mysqli_num_rows($result) == 0)
	{
		$_SESSION['user_login'] = $_POST['login'];
		$_SESSION['active'] = true;
		Header("Location: forum.php");
	}
	else
    {
        die("die in else");
        Header("Location: index.php");
    }
}

echo "<!DOCTYPE html> 
<html> 
<head><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"><title>Welcome to chat!</title></head> 
<body> 
<h3>Welcome, dear user!</h3> 
<form method=\"post\">
	LOGIN <input type=\"text\" name=\"login\"><br><br>
	PASSWORD <input type=\"password\" name=\"pass\"><br><br>
	<input type=\"submit\" name=\"go\" value=\"Log in\">
	<input type=\"button\" value=\"Log on\" onclick=\"location.href = 'registr.php/';\">
</form>
</body></html>";
?>