<?php
//create session
session_start();

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

//redirect to player administration if logged in as the Admin user
if ($_SESSION['username'] == "Admin")
{
	header('Location: admin.php');
}
?>

<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>

<?php

include("title");

include("log.php");

//automatically lock games if they have not been manually unlocked and the game date has been reached
$opengamedata = mysql_query("SELECT * FROM games WHERE status = 'open'");

while ($opengamerow = mysql_fetch_array($opengamedata))
{
	$curdate = strtotime(date("Y/m/d"));
	$gamedate = strtotime($opengamerow['date']);
	$gametype = $opengamerow['type'];

	//if the game is today
	if ($curdate == $gamedate)
	{
		//check game type to determine when it should be locked
		if ($gametype == "weekend")
		{
			//if it has gone noon
			if (date("H") >= 12)
			{
				mysql_query("UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
				$action = "Automatically locked game: " . $opengamerow["game_id"];
				writelog($action);
			}
		}
		if ($gametype == "weekday")
		{
			//if it has gone 7pm
			if (date("H") >= 19)
			{
				mysql_query("UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
				$action = "Automatically locked game: " . $opengamerow["game_id"];
				writelog($action);
			}
		}
	}
	
	//if the game date has passed
	if ($curdate > $gamedate)
	{
		mysql_query("UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
		$action = "Automatically locked game: " . $opengamerow["game_id"];
		writelog($action);
	}
}

$gamedata = mysql_query("SELECT * FROM games ORDER BY date, game_1");

$playerdata = mysql_query("SELECT * FROM players ORDER BY name");

//store a running total of player points
$playerpoints = array();

if ($_GET["brucie"] == "yes")
{
	echo "<img src=\"brucie.jpg\"/>";
	echo "<br>";
	echo "We Love You Brucie!";
	echo "<br>";
	echo "<br>";
}

if ($_GET["scott"] == "yes")
{
	echo "<img src=\"scott.gif\"/>";
	echo "<br>";
	echo "Helloooooo!";
	echo "<br>";
	echo "<br>";
}

if ($_GET["sixnil"] == "yes")
{
	echo "6-0?! This isn't <a href=\"http://news.bbc.co.uk/sport1/hi/football/eng_prem/6205803.stm\">Reading v West Ham</a>!";
	echo "<br>";
	echo "You probably shouldn't click this Dave!";
	echo "<br>";
	echo "<br>";
}

if (date("m") == 2)
{
	if (date("d") >= 20 && date("d") <= 24)
	{
		echo "<img src=\"brucie.jpg\"/>";
		echo "<br>";
		echo "Happy Birthday Brucie!";
		echo "<br>";
		echo "<br>";
	}
}

if (isset($_GET["message"]))
{
	echo $_GET["message"];
	echo "<br>";
	echo "<br>";
}

echo "<b>Fixtures</b>";
echo "<br>";
echo "<br>";

//-----------------
//  TABLE COLOURS
//-----------------

//Headers and Footers: Grey (#dddddd)

//Current Player: Green (#ccffcc)

//Game Status
//    Open: Green  (#ccffcc)
//  Locked: Yellow (#ffffcc)
//     Set: Red    (#ffcccc)

//Points Acquired (OLD)
// 0: Red    (#ffcccc)
// 1: Yellow (#ffffcc)
// 3: Blue   (#ccccff)
// 5: Green  (#ccffcc)

//Points Acquired
// 0: Red    (#ffcccc)
// 1: Yellow (#ffffcc)
// 3: Green  (#ccffcc)

//------------------
//  FIXTURES TABLE
//------------------

//build constant area of the table
echo "<table border=1 cellpadding=10>";
echo "<tr>";
if ($_SESSION['admin'] == 1)
	echo "<th><b>[<a href=\"addgame.php\" title=\"Add a new game\">Add</a>] Game</b></th><th><b>Date</b></th><th><b>Result</b></th>";
else
	echo "<th><b>Game</b></th><th><b>Date</b></th><th><b>Result</b></th>";

//build individual player columns
while ($playerrow = mysql_fetch_array($playerdata))
{
	if ($playerrow['name'] != "Admin")
	{
		if ($playerrow['name'] == $_SESSION['username'])
			echo "<th style=\"background-color:#ccffcc\">" . $playerrow['name'] . "</th>";
		else
			echo "<th>" . $playerrow['name'] . "</th>";
	}
}

echo "</tr>";

//populate table with each game
while($gamerow = mysql_fetch_array($gamedata))
{
	echo "<tr>";
	//set alt text for the date cell
	if ($gamerow['type'] == "weekend")
	{
		$typetext = "Weekend";
		$typealttext = "12pm lock";
	}
	if ($gamerow['type'] == "weekday")
	{
		$typetext = "Weekday";
		$typealttext = "7pm lock";
	}
	//determine what to show based on status and if the user is an admin
	switch ($gamerow['status'])
	{
		case "open":
			if ($_SESSION['admin'] == 1)
			{
				echo "<td style=\"background-color:#ccffcc\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ccffcc\"><a href=\"changedate.php?game=" . $gamerow['game_id'] . "&game1=" . urlencode($gamerow['game_1']) . "&game2=" . urlencode($gamerow['game_2']) . "\" title=\"Change the date of this game\">" . formatdate($gamerow["date"]) . "</a></td>";
				echo "<td style=\"background-color:#ccffcc\" title=\"" . $typealttext . "\">" . $typetext . "</td>";
			}
			else
			{
				echo "<td style=\"background-color:#ccffcc\">" . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ccffcc\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#ccffcc\" title=\"" . $typealttext . "\">" . $typetext . "</td>";
			}
			break;
		case "locked":
			if ($_SESSION['admin'] == 1)
			{
				echo "<td style=\"background-color:#ffffcc\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ffffcc\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#ffffcc\">[<a href=\"activate.php?game=" . $gamerow["game_id"] . "&game1=" . urlencode($gamerow['game_1']) . "&game2=" . urlencode($gamerow['game_2']) . "\" title=\"Activate this game and set the actual score\">Set</a>]</td>";
			}
			else
			{
				echo "<td style=\"background-color:#ffffcc\">" . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ffffcc\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#ffffcc\">Locked</td>";
			}
			break;
		case "set":
			if ($_SESSION['admin'] == 1)
			{
				echo "<td style=\"background-color:#ffcccc\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ffcccc\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#ffcccc\"><a href=\"deleteactual.php?game=" . $gamerow['game_id'] . "&game1=" . urlencode($gamerow['game_1']) . "&game2=" . urlencode($gamerow['game_2']) . "\" title=\"Delete the actual score for this game\">" . $gamerow['actual_1'] . "-" . $gamerow['actual_2'] . "</a></td>";
			}
			else
			{
				echo "<td style=\"background-color:#ffcccc\">" . $gamerow['game_1'] . " v " . $gamerow['game_2'] . "</td>";
				echo "<td style=\"background-color:#ffcccc\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#ffcccc\">" . $gamerow['actual_1'] . "-" . $gamerow['actual_2'] . "</td>";
			}
			break;
	}
	$playerdata = mysql_query("SELECT * FROM players ORDER BY name");
	//read each player's predictions for the current game
	while ($playerrow = mysql_fetch_array($playerdata))
	{
		if ($playerrow['name'] != "Admin")
		{
			$resultdata = mysql_query("SELECT * FROM results WHERE game_id = " . $gamerow['game_id'] . " AND player_id = " . $playerrow['player_id']);
			if (mysql_num_rows($resultdata) == 0)
			{
				if ($playerrow['name'] == $_SESSION['username'])
				{
					if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
						echo "<td>[<a href=\"set.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&game1=" . urlencode($gamerow['game_1']) . "&game2=" . urlencode($gamerow['game_2']) . "\" title=\"Set your prediction for this game\">Set</a>]</td>";
					else
						echo "<td>--</td>";
				}
				else
					echo "<td>--</td>";
			}
			else
			{
				//call function to calculate points as each cell is processed
				//nuke cellcolour variable first
				$cellcolour = null;
				//get results
				$resultrow = mysql_fetch_array($resultdata);
				//check if game is active
				if ($gamerow['status'] == "set")
					{
					$playerscore1 = $resultrow['score_1'];
					$playerscore2 = $resultrow['score_2'];
					$brucie = $resultrow['brucie'];
					$actualscore1 = $gamerow['actual_1'];
					$actualscore2 = $gamerow['actual_2'];
					$playerid = $playerrow['player_id'];
					$cellpoints = pointscalc($playerscore1, $playerscore2, $brucie, $actualscore1, $actualscore2, $playerid);
					$playerpoints[$playerid] = $playerpoints[$playerid] + $cellpoints;
					//determine which colour is needed for this cell
					switch ($cellpoints)
					{
						case 0:
							$cellcolour = "#ffcccc";
							$legend = $cellpoints . " point(s)";
							break;
						case ($cellpoints == 1 || $cellpoints == 2):
							$cellcolour = "#ffffcc";
							$legend = $cellpoints . " point(s)";
							break;
						case ($cellpoints == 3 || $cellpoints == 6):
							$cellcolour = "#ccffcc";
							$legend = $cellpoints . " point(s)";
							break;
						//implementation of new scoring system
						//case ($cellpoints == 5 || $cellpoints == 10):
							//$cellcolour = "#ccffcc";
							//$legend = $cellpoints . " point(s)";
							//break;
					}
				}
				//white cell colour if the calculation has not been done yet
				if (!isset($cellcolour))
					$cellcolour = "#dddddd";
				switch ($gamerow['status'])
				{
					case "set":
						//if the actual score has been set, show all predictions and do not allow them to delete
						//show legend (which colours correspond to how many points)
						if ($resultrow['brucie'] == 0)
							echo "<td style=\"background-color:" . $cellcolour . "\" title=\"" . $legend . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</td>";
						else
							echo "<td style=\"background-color:" . $cellcolour . "\" title=\"" . $legend . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . " (B)</td>";
						break;
					case "locked":
						//if the game has been locked, show only this player's predictions and do not allow them to delete
						if ($playerrow['name'] == $_SESSION["username"])
							{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . " (B)</td>";
							}
						else
							echo "<td style=\"background-color:#dddddd\">--</td>";
						break;
					case "unlocked":
						//if the actual score has not been set, show only this player's predictions and allow them to delete
						if ($playerrow['name'] == $_SESSION["username"])
						{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a></td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a> (B)</td>";
						}
						else
							echo "<td style=\"background-color:#dddddd\">--</td>";
						break;
					case "open":
						//if the actual score has not been set, show only this player's predictions and allow them to delete
						if ($playerrow['name'] == $_SESSION["username"])
						{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a></td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a> (B)</td>";
						}
						else
							echo "<td style=\"background-color:#dddddd\">--</td>";
						break;
				}
			}
		}
	}
	echo "</tr>";
}

//display No Games if there are none
if (mysql_num_rows($gamedata) == 0)
{
	//get the correct value for colspan
	$spanlength = mysql_num_rows($playerdata) + 2;
	echo "<tr><td colspan=\"" . $spanlength . "\"><center>No Games</center></td></tr>";
}

echo "<th colspan=\"3\"><div align=\"right\"><b>Points:</b></div></th>";
//display player points totals
if (mysql_num_rows($gamedata) == 0)
{
	echo "<th colspan=\"" . (mysql_num_rows($playerdata) - 1) . "\">--</th>";
}
else
{
	$playerdata = mysql_query("SELECT * FROM players ORDER BY name");
	while ($playerrow = mysql_fetch_array($playerdata))
	{
		if ($playerrow['name'] != "Admin")
		{
			$playerid = $playerrow['player_id'];
			if (!isset($playerpoints[$playerid]))
			{
				if ($playerrow['name'] == $_SESSION['username'])
					echo "<th style=\"background-color:#ccffcc\" title=\"" . $playerrow['name'] . "\">0</th>";
				else
					echo "<th title=\"" . $playerrow['name'] . "\">0</th>";
			}
			else
			{
				if ($playerrow['name'] == $_SESSION['username'])
					echo "<th style=\"background-color:#ccffcc\" title=\"" . $playerrow['name'] . "\">" . $playerpoints[$playerid] . "</th>";
				else
					echo "<th title=\"" . $playerrow['name'] . "\">" . $playerpoints[$playerid] . "</th>";
			}
		}
	}
}

echo "</tr>";
echo "</table>";

//------------
//  MESSAGES
//------------

echo "<br>";
echo "<b>Messages</b>";
echo "<br>";
echo "<br>";
echo "<table border=\"1\" cellpadding=\"10\">";
echo "<tr><th><b>[<a href=\"index.php?all=yes\" title=\"Show all messages\">All</a>] Message</b></th><th>User</th><th>Date/Time</th></tr>";

if ($_GET["all"] == "yes")
{
	$messagedata = mysql_query("SELECT * FROM messages ORDER BY datetime");
}
else
{
	//get total number of messages first so that the correct values for LIMIT can be calculated
	$nummessages = mysql_query("SELECT message_id FROM messages");
	$upper_limit = mysql_num_rows($nummessages);
	$lower_limit = $upper_limit - 10;
	if ($lower_limit < 0)
		$lower_limit = 0;
	$messagedata = mysql_query("SELECT * FROM messages ORDER BY datetime LIMIT " . $lower_limit . ", " . $upper_limit);
}

while ($messagerow = mysql_fetch_array($messagedata))
{
	if ($messagerow['user'] == $_SESSION['username'] && $_SESSION['username'] != "")
	{
		echo "<tr style=\"background-color: #ccffcc\"><td>" . $messagerow['message'] . "</td><td>" . $messagerow['user'] . "</td><td>" . formatdatetime($messagerow['datetime']) . "</td></tr>";
	}
	else
	{
		echo "<tr><td>" . $messagerow['message'] . "</td><td>" . $messagerow['user'] . "</td><td>" . formatdatetime($messagerow['datetime']) . "</td></tr>";
	}
}

if (mysql_num_rows($messagedata) == 0)
{
	echo "<tr><td colspan=\"3\"><center>No Messages</center></td></tr>";
}

echo "</table>";

//only display message form if a user is logged in
if ($_SESSION['username'] != null)
{
	echo "<br>";
	echo "<form name=\"message\" action=\"addmessage.php\" method=\"post\">";
	echo "Message: <input type=\"text\" name=\"message\" size=\"50\" maxlength=\"100\" />";
	echo "&nbsp;<input type=\"submit\" value=\"Add\">";
	echo "</form>";
}

//--------------------
//    POINTS TABLE
//--------------------

echo "<br>";
echo "<b>Points</b>";
echo "<br>";
echo "<br>";
echo "<table border=\"1\" cellpadding=\"10\">";
if ($_SESSION['admin'] == 1)
	echo "<tr><th><b>[<a href=\"addplayer.php\" title=\"Add a new player\">Add</a>] Player</b></th><th><b>Avatar</b></th><th><a href=\"addbrucies.php\" title=\"Add/reset Brucie Bonuses for all players\"><b>Brucies</b></a></th><th><a href=\"update.php?month=july\" title=\"Update points for this month\">Jul</a></th><th><a href=\"update.php?month=august\" title=\"Update points for this month\">Aug</a></th><th><a href=\"update.php?month=september\" title=\"Update points for this month\">Sep</a></th><th><a href=\"update.php?month=october\" title=\"Update points for this month\">Oct</a></th><th><a href=\"update.php?month=november\" title=\"Update points for this month\">Nov</a></th><th><a href=\"update.php?month=december\" title=\"Update points for this month\">Dec</a></th><th><a href=\"update.php?month=january\" title=\"Update points for this month\">Jan</a></th><th><a href=\"update.php?month=february\" title=\"Update points for this month\">Feb</a></th><th><a href=\"update.php?month=march\" title=\"Update points for this month\">Mar</a></th><th><a href=\"update.php?month=april\" title=\"Update points for this month\">Apr</a></th><th><a href=\"update.php?month=may\" title=\"Update points for this month\">May</a></th><th><a href=\"update.php?month=june\" title=\"Update points for this month\">Jun</a></th><th><b>Total [<a href=\"index.php\" title=\"Sort alphabetically\">a</a>|<a href=\"index.php?sort=points\" title=\"Sort by points\">p</a>]</b></th></tr>";
else
	echo "<tr><th><b>Player</b></th><th><b>Avatar</b></th><th><b>Brucies</b></th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th><b>Total [<a href=\"index.php\" title=\"Sort alphabetically\">a</a>|<a href=\"index.php?sort=points\" title=\"Sort by points\">p</a>]</b></th></tr>";

$playerdata = mysql_query("SELECT * FROM players ORDER BY name");

$totals = array();

//get all players and their totals
while ($playerrow = mysql_fetch_array($playerdata))
{
	$totals[$playerrow['name']] = $playerrow['july'] + $playerrow['august'] + $playerrow['september'] + $playerrow['october'] + $playerrow['november'] + $playerrow['december'] + $playerrow['january'] + $playerrow['february'] + $playerrow['march'] + $playerrow['april'] + $playerrow['may'] + $playerrow['june'];
}

$noplayers = false;
if (mysql_num_rows($playerdata) == 0 || mysql_num_rows($playerdata) == 1)
{
	$noplayers = true;
}

$playerrow = null;
$playerdata = null;

//sort by name or totals
if ($_GET["sort"] == "points")
{
	arsort($totals);
}
else
{
	ksort($totals);
}

foreach ($totals as $name => $totalpoints)
{
	//calculate total points
	//$totalpoints = $playerrow['july'] + $playerrow['august'] + $playerrow['september'] + $playerrow['october'] + $playerrow['november'] + $playerrow['december'] + $playerrow['january'] + $playerrow['february'] + $playerrow['march'] + $playerrow['april'] + $playerrow['may'] + $playerrow['june'];
	//if ($_SESSION['username'] != "Admin")
	//{
	//echo $name;
	//echo "<br>";
	//echo $totalpoints;
	//echo "<br>";

	$playerdata = mysql_query("SELECT * FROM players WHERE name = '" . $name . "'");

	while ($playerrow = mysql_fetch_array($playerdata))
	{
		if ($playerrow['name'] != "Admin")
		{
			//highlight the row if it belongs to the logged in player
			if ($playerrow['name'] == $_SESSION['username'])
			{
				$rowbg = "#ccffcc";
				$headbg = "#ccffcc";
			}
			else
			{
				$rowbg = "#ffffff";
				$headbg = "#dddddd";
			}
			if ($_SESSION['admin'] == 1)
			{
				//what to show if user is a game admin
				echo "<tr>";
				echo "<td style=\"background-color:" . $rowbg . "\">[<a href=deleteplayer.php?player=" . $playerrow['player_id'] . " title=\"Delete this player\">Del</a>] <a href=\"avatar.php?player=" . $playerrow['player_id'] . "\" title=\"View or edit this player's settings\">" . $playerrow['name'] . "</a></td>";
			}
			else
			{
				//what to show if user is not a game admin
				echo "<tr>";
				echo "<td style=\"background-color:" . $rowbg . "\"><a href=\"avatar.php?player=" . $playerrow['player_id'] . "\" title=\"View this player's avatar\">" . $playerrow['name'] . "</a></td>";
			}
			if ($playerrow['avatar'] != "")
				echo "<td style=\"background-color:" . $rowbg . "\"><img src=\"" . $playerrow['avatar'] . "\" height=\"100\" width=\"100\"></td>";
			else
				echo "<td style=\"background-color:" . $rowbg . "\">Not Set</td>";				
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['brucies'] . "B</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['july'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['august'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['september'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['october'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['november'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['december'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['january'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['february'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['march'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['april'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['may'] . "</td>";
			echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['june'] . "</td>";
			echo "<td style=\"background-color:" . $headbg . "\"><b>" . $totalpoints . "</b></td>";
			echo "</tr>";
		}
	}
}

//display No Players if there are none
if ($noplayers)
{
	echo "<tr><td colspan=\"16\"><center>No Players</center></td></tr>";
}

echo "</table>";

//store player points as session variable
$_SESSION['playerpoints'] = $playerpoints;

//display who is logged in
echo "<br>";
if (!isset($_SESSION['username']))
{
	echo "Not Logged In";
	echo "<br>";
}
else
{
	echo "User: " . $_SESSION['username'];
	echo "<br>";
}

if (!isset($_SESSION['username']))
{
	echo "<br>";
	echo "<table cellpadding=\"2\" style=\"border-style: hidden;\">";
	echo "<form name=\"login\" action=\"login.php\" method=\"post\">";
	echo "<tr><td style=\"border-style: hidden;\">Username:</td><td style=\"border-style: hidden;\"><input type=\"text\" name=\"username\" /></td></tr>";
	echo "<tr><td style=\"border-style: hidden;\">Password:</td><td style=\"border-style: hidden;\"><input type=\"password\" name=\"password\" /></td></tr>";
	echo "<tr><td></td><td style=\"border-style: hidden;\"><input type=\"submit\" value=\"Login\"></td></tr>";
	echo "</form>";
	echo "</table>";
}

echo "<br>";
echo "<a href=\"password.php\" title=\"Change your password\">Change Password</a> - <a href=\"logout.php\" title=\"Clear your current session\">Logout</a> - <a href=\"reset.php\" title=\"Delete all fixtures and reset all points\">Reset</a> - <a href=\"viewlog.php\" title=\"View the log\">Log</a> - <a href=\"about.php\" title=\"About Predikta\">About</a>";

//functions to format MySQL dates and times
function formatdate($date)
{
	return date("d/m/Y", strtotime($date));
}

function formatdatetime($datetime)
{
	return date("d/m/Y H:i:s", strtotime($datetime));
}

//function to calculate points and keep a running total
function pointscalc($playerscore1, $playerscore2, $brucie, $actualscore1, $actualscore2, $playerid)
{
	//commented out second line to implement the changes to the scoring system
	//the first line was also changed from 5 points to 3 points
	$points = 0;
	if (($playerscore1 == $actualscore1) && ($playerscore2 == $actualscore2))
		$points = 3;
	//elseif (($playerscore1 - $actualscore1) == ($playerscore2 - $actualscore2))
		//$points = 3;
	elseif (($playerscore1 > $playerscore2) && ($actualscore1 > $actualscore2))
		$points = 1;
	elseif (($playerscore1 < $playerscore2) && ($actualscore1 < $actualscore2))
		$points = 1;
	elseif (($playerscore1 == $playerscore2) && ($actualscore1 == $actualscore2))
		$points = 1;
	if ($brucie == 1)
		$points = $points * 2;
	return $points;
}

?>

</center>
</body>

</html>
