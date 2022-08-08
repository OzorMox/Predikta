<?php
//create session
session_start();
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

$hofdata = mysqli_query($connection, "SELECT * FROM halloffame ORDER BY entry");

echo "<center>";
include("title");
echo "<b>Hall Of Fame</b>";
echo "<br>";
echo "<br>";
//table headers
echo "<table border=1 cellpadding=10>";
echo "<tr><th><b>Entry</b></th><th><b>Awarded To</b></th><th><b>Awarded By</b></th></tr>";
if (mysqli_num_rows($hofdata) == 0)
{
	echo "<tr><td colspan=\"4\"><center>No Hall Of Fame Data</center></td></tr>";
}
else
{
	while ($hofrow = mysqli_fetch_array($hofdata))
	{
        if ($_SESSION['admin'] == 1)
        {
            echo "<tr><td>[<a href=\"deletehofentry.php?entry=" . $hofrow['entry_id'] . "\" title=\"Delete this entry\">Del</a>] " . $hofrow['entry'] . "</td><td>" . $hofrow['awardedto'] . "</td><td>" . $hofrow['awardedby'] . "</td></tr>";
        }
        else
        {
            echo "<tr><td>" . $hofrow['entry'] . "</td><td>" . $hofrow['awardedto'] . "</td><td>" . $hofrow['awardedby'] . "</td></tr>";
        }
	}
}
echo "</table>";
echo "<br>";
if ($_SESSION['admin'] == 1)
{
	echo "<br>";
	echo "<form name=\"message\" action=\"addhofentry.php\" method=\"post\">";
	echo "Hall Of Fame Entry: <input type=\"text\" name=\"entry\" size=\"50\" maxlength=\"100\" />";
    echo "&nbsp;Awarded To: <input type=\"text\" name=\"awardedto\" size=\"10\" maxlength=\"100\" />";
	echo "&nbsp;<input type=\"submit\" value=\"Add\">";
	echo "</form>";
}
echo "<br>";
echo "<a href=\"index.php\">Back</a>";
echo "</center>";
	
mysqli_close($connection)

?>

</body>

</html>
