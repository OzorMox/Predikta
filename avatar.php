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

$playerdata = mysqli_query($connection, "SELECT * FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysqli_fetch_array($playerdata);

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
    echo "<b>Player Administration</b>";
    echo "<br>";
	echo "<br>";
	echo "<form name=\"changename\" action=\"changename.php?player=" . $_GET["player"] . "\" method=\"post\">";
	echo "Change Name: <input type=\"text\" name=\"name\" maxlength=\"50\" />&nbsp;<input type=\"submit\" value=\"Change\">";
	echo "</form>";
	echo "<br>";
	echo "<form name=\"resetpassword\" action=\"resetpassword.php?player=" . $_GET["player"] . "\" method=\"post\">";
	echo "Reset Password: <input type=\"submit\" value=\"This Player Is Forgetful!\">";
	echo "</form>";
}
echo "<br>";
echo "<a href=\"index.php\">Back</a>";
echo "</center>";
	
mysqli_close($connection)

?>

</body>

</html>
