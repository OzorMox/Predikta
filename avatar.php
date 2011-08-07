<?php

session_start();

if ($_GET["player"] == "")
{
	header('Location: error.php?error=No+player+ID+found');
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

//connect to the database
include("connect.php");

$playerdata = mysql_query("SELECT * FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysql_fetch_array($playerdata);

echo "<center>";
include("title");
echo "<b>Player Avatar</b> for <b>" . $playerrow['name'] . "</b>";
echo "<br>";
echo "<br>";
if ($playerrow['avatar'] != "")
	echo "<img src=\"" . $playerrow['avatar'] . "\">";
else
	echo "Not Set";
echo "<br>";
//only display form if player is an admin
if ($_SESSION['admin'] == 1)
{
	echo "<br>";
	echo "<form name=\"avatar\" action=\"setavatar.php?player=" . $_GET["player"] . "\" method=\"post\">";
	echo "Avatar URL: <input type=\"text\" name=\"avatar\" size=\"50\" maxlength=\"500\" />&nbsp;<input type=\"submit\" value=\"Set\">";
	echo "</form>";
	echo "<br>";
	echo "<form name=\"changename\" action=\"changename.php?player=" . $_GET["player"] . "\" method=\"post\">";
	echo "Change Name: <input type=\"text\" name=\"name\" maxlength=\"50\" />&nbsp;<input type=\"submit\" value=\"Change\">";
	echo "</form>";
	echo "<br>";
	echo "<form name=\"resetpassword\" action=\"resetpassword.php?player=" . $_GET["player"] . "\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Reset Password\">";
	echo "</form>";
}
echo "<br>";
echo "<a href=\"index.php\">Back</a>";
echo "</center>";
	
mysql_close($connection)

?>

</body>

</html>
