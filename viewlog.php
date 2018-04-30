<?php

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

if (isset($_GET["all"]) && $_GET["all"] == "yes")
{
    $logdata = mysqli_query($connection, "SELECT * FROM log ORDER BY datetime DESC");
}
else
{
    $logdata = mysqli_query($connection, "SELECT * FROM log ORDER BY datetime DESC LIMIT 100");
}

echo "<center>";
include("title");
echo "<b>Log</b>";
echo "<br>";
echo "<br>";
//table headers
echo "<table border=1 cellpadding=10>";
echo "<tr><th><b>ID</b></th><th><b>Action</b></th><th><b>User</b></th><th><b>Date/Time</b></th></tr>";
if (mysqli_num_rows($logdata) == 0)
{
	echo "<tr><td colspan=\"4\"><center>No Log Data</center></td></tr>";
}
else
{
	while ($logrow = mysqli_fetch_array($logdata))
	{
		echo "<tr><td>" . $logrow['log_id'] . "</td><td>" . $logrow['action'] . "</td><td>" . $logrow['user'] . "</td><td>" . date("d/m/Y H:i:s", strtotime($logrow['datetime'])) . "</td></tr>";
	}
}
echo "</table>";
echo "<br>";
echo "<a href=\"clearlog.php\" title=\"Clear all log entries\">Clear</a> - <a href=\"viewlog.php?all=yes\" title=\"Show all log entries\">All</a> - <a href=\"index.php\">Back</a>";
echo "</center>";
	
mysqli_close($connection)

?>

</body>

</html>
