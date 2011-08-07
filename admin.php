<?php session_start();

if ($_SESSION['username'] != "Admin")
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

//connect to the database
include("connect.php");

//check for admin user - redirect if missing
$admindata = mysql_query("SELECT * FROM players WHERE name = 'Admin'");

$adminrow = mysql_fetch_array($admindata);

$adminnumcheck = mysql_num_rows($admindata);
$admintypecheck = $adminrow['admin'];

if ($adminnumcheck != 1 || $admintypecheck != 1)
{
	header('Location: error.php?error=Bad+admin+configuration:+Brucie+is+not+happy!');
	exit();
}

?>

<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php

//Admin user page: this is only for switching on and off admin status of all other users

if ($_SESSION['username'] == "Admin")
{
	echo "<center>";
	include("title");
	echo "<b>Player Administration</b>";
	echo "<br>";
	echo "<br>";
	echo "<table border=\"1\" cellpadding=\"10\">";
	echo "<tr><th><b>ID</b></th><th><b>Player</b></th><th><b>Admin</b></th></tr>";

	$playerdata = mysql_query("SELECT * FROM players ORDER BY name");
	while ($playerrow = mysql_fetch_array($playerdata))
	{
		//show player table and ignore Admin user as they should not ever be modified
		if ($playerrow['name'] != "Admin")
		{
			echo "<tr>";
			echo "<td>" . $playerrow['player_id'] . "</td>";
			echo "<td>" . $playerrow['name'] . "</td>";
			echo "<td><a href=\"toggleadmin.php?player=" . $playerrow['player_id'] . "&admin=" . $playerrow['admin'] . "\" title=\"Toggle admin status of this player\">" . $playerrow['admin'] . "</td>";
			echo "</tr>";
		}

	}

	//display No Players if there are none
	if (mysql_num_rows($playerdata) == 0 || mysql_num_rows($playerdata) == 1)
		echo "<tr><td colspan=\"15\"><center>No Players</center></td></tr>";

	echo "</table>";
	echo "<br>";
	echo "<a href=\"password.php\" title=\"Change your password\">Change Password</a> - <a href=\"logout.php\" title=\"Clear your current session\">Logout</a>";
	echo "</center>";
}
	
mysql_close($connection)

?>

</body>

</html>
