<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_GET["month"] == "")
{
	header('Location: error.php?error=No+month+found');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	//read player points from session variables and add them to existing points totals for the selected month in the database
	foreach($_SESSION['playerpoints'] as $id => $total)
	{
		$playerdata = mysql_query("SELECT * FROM players WHERE player_id = " . $id);
		$playerrow = mysql_fetch_array($playerdata);
		if ($_GET["month"] == july)
			$selectedmonth = $playerrow['july'];
		if ($_GET["month"] == august)
			$selectedmonth = $playerrow['august'];
		if ($_GET["month"] == september)
			$selectedmonth = $playerrow['september'];
		if ($_GET["month"] == october)
			$selectedmonth = $playerrow['october'];
		if ($_GET["month"] == november)
			$selectedmonth = $playerrow['november'];
		if ($_GET["month"] == december)
			$selectedmonth = $playerrow['december'];
		if ($_GET["month"] == january)
			$selectedmonth = $playerrow['january'];
		if ($_GET["month"] == february)
			$selectedmonth = $playerrow['february'];
		if ($_GET["month"] == march)
			$selectedmonth = $playerrow['march'];
		if ($_GET["month"] == april)
			$selectedmonth = $playerrow['april'];
		if ($_GET["month"] == may)
			$selectedmonth = $playerrow['may'];
		if ($_GET["month"] == june)
			$selectedmonth = $playerrow['june'];
		$newtotal = $selectedmonth + $total;

		if (!mysql_query("UPDATE players SET " . $_GET["month"] . " = " . $newtotal . " WHERE player_id = " . $id))
		{
			header('Location: error.php?error=Database+query+failed+to+complete');
			exit();
		}
	}
	//delete all current games, results and messages
	mysql_query("DELETE FROM games");
	mysql_query("DELETE FROM results");
	//don't delete messages anymore
	//mysql_query("DELETE FROM messages");
	include("log.php");
	$action = "Updated month: " . $_GET["month"];
	writelog($action);
	header('Location: index.php');
	exit();
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}
	
mysql_close($connection)

?>
