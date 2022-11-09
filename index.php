<?php
//create session
session_start();

if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
}
else
{
	$username = "";
}

if (isset($_SESSION['admin']))
{
	$admin = $_SESSION['admin'];
}
else
{
	$admin = 0;
}

//connect to the database
include("connect.php");

//check for admin user - redirect if missing
$admindata = mysqli_query($connection, "SELECT * FROM players WHERE name = 'Admin'");

$adminrow = mysqli_fetch_array($admindata);

$adminnumcheck = mysqli_num_rows($admindata);
$admintypecheck = $adminrow['admin'];

//set competition type
$competition = $adminrow['competition'];

if ($adminnumcheck != 1 || $admintypecheck != 1)
{
	header('Location: error.php?error=Bad+admin+configuration,+Brucie+is+not+happy!');
	exit();
}

if ($competition != "league" && $competition != "cup")
{
	header('Location: error.php?error=Competition+type+not+set,+Brucie+is+not+happy!');
	exit();
}

//redirect to player administration if logged in as the Admin user
if (isset($username) && $username == "Admin")
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
$opengamedata = mysqli_query($connection, "SELECT * FROM games WHERE status = 'open'");

while ($opengamerow = mysqli_fetch_array($opengamedata))
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
				mysqli_query($connection, "UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
				$action = "Automatically locked game: " . $opengamerow["game_id"];
				writelog($action);
			}
		}
		if ($gametype == "weekday")
		{
			//if it has gone 7pm
			if (date("H") >= 19)
			{
				mysqli_query($connection, "UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
				$action = "Automatically locked game: " . $opengamerow["game_id"];
				writelog($action);
			}
		}
	}
	
	//if the game date has passed
	if ($curdate > $gamedate)
	{
		mysqli_query($connection, "UPDATE games SET status = 'locked' WHERE game_id = " . $opengamerow['game_id']);
		$action = "Automatically locked game: " . $opengamerow["game_id"];
		writelog($action);
	}
}

$gamedata = mysqli_query($connection, "SELECT * FROM games ORDER BY date, team_1");

$playerdata = mysqli_query($connection, "SELECT * FROM players ORDER BY (name = '" . $username . "') desc, name");

//store a running total of player points
$playerpoints = array();

if (isset($_GET["brucie"]) && $_GET["brucie"] == "yes")
{
	echo "<img src=\"brucie.jpg\"/>";
	echo "<br>";
	echo "We Love You Brucie!";
	echo "<br>";
	echo "<br>";
}

if (isset($_GET["scott"]) && $_GET["scott"] == "yes")
{
	echo "<img src=\"scott.gif\"/>";
	echo "<br>";
	echo "Helloooooo!";
	echo "<br>";
	echo "<br>";
}

if (isset($_GET["sixnil"]) && $_GET["sixnil"] == "yes")
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

//------------------
//  FIXTURES TABLE
//------------------

//build constant area of the table
echo "<table border=1 cellpadding=10>";
echo "<tr>";
if (isset($_SESSION['username']))
{
	echo "<th><b>[<a href=\"addgame.php\" title=\"Add a new game\">Add</a>] Game</b></th><th><b>Date</b></th><th><b>Result</b></th>";
}
else
{
	echo "<th><b>Game</b></th><th><b>Date</b></th><th><b>Result</b></th>";
}

//build individual player columns
while ($playerrow = mysqli_fetch_array($playerdata))
{
	if ($playerrow['name'] != "Admin")
	{
		if ($playerrow['name'] == $username)
			echo "<th style=\"background-color:#006600\">" . $playerrow['name'] . "</th>";
		else
			echo "<th>" . $playerrow['name'] . "</th>";
	}
}

echo "</tr>";

//populate table with each game
while($gamerow = mysqli_fetch_array($gamedata))
{
    //check if Brucie has predicted on this game
    bruciepredicts($gamerow['game_id'], $gamerow['team_1'], $gamerow['team_2']);
    
	echo "<tr>";
	//set alt text for the date cell
	if ($gamerow['type'] == "weekend")
	{
		$typetext = "12pm Lock";
		$typealttext = "12pm Lock";
	}
	if ($gamerow['type'] == "weekday")
	{
		$typetext = "7pm Lock";
		$typealttext = "7pm Lock";
	}
	//determine what to show based on status and if the user is an admin
	switch ($gamerow['status'])
	{
		case "open":
			if ($admin == 1)
			{
				echo "<td style=\"background-color:#006600\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#006600\"><a href=\"changedate.php?game=" . $gamerow['game_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Change the date of this game\">" . formatdate($gamerow["date"]) . "</a></td>";
				echo "<td style=\"background-color:#006600\" title=\"" . $typealttext . "\">" . $typetext . "</td>";
			}
			else
			{
				echo "<td style=\"background-color:#006600\">" . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#006600\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#006600\" title=\"" . $typealttext . "\">" . $typetext . "</td>";
			}
			break;
		case "locked":
			if ($admin == 1)
			{
				echo "<td style=\"background-color:#994d00\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#994d00\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#994d00\">[<a href=\"activate.php?game=" . $gamerow["game_id"] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Activate this game and set the actual score\">Set</a>]</td>";
			}
			else
			{
				echo "<td style=\"background-color:#994d00\">" . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#994d00\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#994d00\">Locked</td>";
			}
			break;
		case "set":
			if ($admin == 1)
			{
				echo "<td style=\"background-color:#660000\">[<a href=\"deletegame.php?game=" . $gamerow['game_id'] . "\" title=\"Delete this game\">Del</a>] " . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#660000\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#660000\"><a href=\"deleteactual.php?game=" . $gamerow['game_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Delete the actual score for this game\">" . $gamerow['actual_1'] . "-" . $gamerow['actual_2'] . "</a></td>";
			}
			else
			{
				echo "<td style=\"background-color:#660000\">" . $gamerow['team_1'] . " v " . $gamerow['team_2'] . "</td>";
				echo "<td style=\"background-color:#660000\">" . formatdate($gamerow["date"]) . "</td>";
				echo "<td style=\"background-color:#660000\">" . $gamerow['actual_1'] . "-" . $gamerow['actual_2'] . "</td>";
			}
			break;
	}
	$playerdata = mysqli_query($connection, "SELECT * FROM players ORDER BY (name = '" . $username . "') desc, name");
	//read each player's predictions for the current game
	while ($playerrow = mysqli_fetch_array($playerdata))
	{
		if ($playerrow['name'] != "Admin")
		{
			$resultdata = mysqli_query($connection, "SELECT * FROM results WHERE game_id = " . $gamerow['game_id'] . " AND player_id = " . $playerrow['player_id']);
			if (mysqli_num_rows($resultdata) == 0)
			{
				if ($playerrow['name'] == $username)
				{
					if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
                    {
						echo "<td>[<a href=\"set.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Set your prediction for this game\">Set</a>]</td>";
                    }
					else
                    {
						echo "<td>--</td>";
                    }
				}
				else
                {
					echo "<td>--</td>";
                }
			}
			else
			{
				//call function to calculate points as each cell is processed
				//nuke cellcolour variable first
				$cellcolour = null;
				//get results
				$resultrow = mysqli_fetch_array($resultdata);
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
					if (!isset($playerpoints[$playerid]))
					{
						$playerpoints[$playerid] = $cellpoints;
					}
					else
					{
						$playerpoints[$playerid] = $playerpoints[$playerid] + $cellpoints;
					}
					//determine which colour is needed for this cell
					switch ($cellpoints)
					{
						case 0:
							$cellcolour = "#660000";
							$legend = $cellpoints . " point(s)";
							break;
						case ($cellpoints == 1 || $cellpoints == 2):
							$cellcolour = "#994d00";
							$legend = $cellpoints . " point(s)";
							break;
						case ($cellpoints == 3 || $cellpoints == 6):
							$cellcolour = "#006600";
							$legend = $cellpoints . " point(s)";
							break;
					}
				}
				
				//blank cell colour if the calculation has not been done yet
				if (!isset($cellcolour))
				{
					$cellcolour = "#222222";
				}
				
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
						if ($playerrow['name'] == $username)
							{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . " (B)</td>";
							}
						else
							echo "<td style=\"background-color:#666666\">--</td>";
						break;
					case "unlocked":
						//if the actual score has not been set, show only this player's predictions and allow them to delete
						if ($playerrow['name'] == $_SESSION["username"])
						{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a></td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a> (B)</td>";
						}
						else
							echo "<td style=\"background-color:#666666\">--</td>";
						break;
					case "open":
						//if the actual score has not been set, show only this player's predictions and allow them to delete
						if ($playerrow['name'] == $username)
						{
							if ($resultrow['brucie'] == 0)
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a></td>";
							else
								echo "<td style=\"background-color:" . $cellcolour . "\"><a href=\"deleteprediction.php?game=" . $gamerow["game_id"] . "&player=" . $playerrow['player_id'] . "&team1=" . urlencode($gamerow['team_1']) . "&team2=" . urlencode($gamerow['team_2']) . "\" title=\"Delete your prediction for this game\">" . $resultrow['score_1'] . "-" . $resultrow['score_2'] . "</a> (B)</td>";
						}
						else
							echo "<td style=\"background-color:#666666\">--</td>";
						break;
				}
			}
		}
	}
	echo "</tr>";
}

//display No Games if there are none
if (mysqli_num_rows($gamedata) == 0)
{
	//get the correct value for colspan
	$spanlength = mysqli_num_rows($playerdata) + 3;
	echo "<tr><td colspan=\"" . $spanlength . "\"><center>No Games</center></td></tr>";
}

echo "<th colspan=\"3\"><div align=\"right\"><b>Points:</b></div></th>";
//display player points totals
if (mysqli_num_rows($gamedata) == 0)
{
	echo "<th colspan=\"" . (mysqli_num_rows($playerdata) - 1) . "\">--</th>";
}
else
{
	$playerdata = mysqli_query($connection, "SELECT * FROM players ORDER BY (name = '" . $username . "') desc, name");
	while ($playerrow = mysqli_fetch_array($playerdata))
	{
		if ($playerrow['name'] != "Admin")
		{
			$playerid = $playerrow['player_id'];
			if (!isset($playerpoints[$playerid]))
			{
				if ($playerrow['name'] == $username)
					echo "<th style=\"background-color:#006600\" title=\"" . $playerrow['name'] . "\">0</th>";
				else
					echo "<th title=\"" . $playerrow['name'] . "\">0</th>";
			}
			else
			{
				if ($playerrow['name'] == $username)
					echo "<th style=\"background-color:#006600\" title=\"" . $playerrow['name'] . "\">" . $playerpoints[$playerid] . "</th>";
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

if (isset($_GET['all']) && $_GET["all"] == "yes")
{
	$messagedata = mysqli_query($connection, "SELECT * FROM messages ORDER BY datetime");
}
else
{
	//get total number of messages first so that the correct values for LIMIT can be calculated
	$nummessages = mysqli_query($connection, "SELECT message_id FROM messages");
	$upper_limit = mysqli_num_rows($nummessages);
	$lower_limit = $upper_limit - 10;
	if ($lower_limit < 0)
		$lower_limit = 0;
	$messagedata = mysqli_query($connection, "SELECT * FROM messages ORDER BY datetime LIMIT " . $lower_limit . ", " . $upper_limit);
}

while ($messagerow = mysqli_fetch_array($messagedata))
{
	if ($messagerow['user'] == $username && $username != "")
	{
		echo "<tr style=\"background-color: #ccffcc\"><td>" . $messagerow['message'] . "</td><td>" . $messagerow['user'] . "</td><td>" . formatdatetime($messagerow['datetime']) . "</td></tr>";
	}
	else
	{
		echo "<tr><td>" . $messagerow['message'] . "</td><td>" . $messagerow['user'] . "</td><td>" . formatdatetime($messagerow['datetime']) . "</td></tr>";
	}
}

if (mysqli_num_rows($messagedata) == 0)
{
	echo "<tr><td colspan=\"3\"><center>No Messages</center></td></tr>";
}

echo "</table>";

//only display message form if a user is logged in
if ($username != null)
{
	echo "<br>";
	echo "<form name=\"message\" action=\"addmessage.php\" method=\"post\">";
	echo "Message: <input type=\"text\" name=\"message\" size=\"50\" maxlength=\"100\" />";
	echo "&nbsp;<input type=\"submit\" value=\"Add\">";
	echo "</form>";
}

if ($username != null)
{
    echo "Or give Brucie something to say while people are predicting!";
    echo "<br>";
    echo "<br>";
	echo "<form name=\"message\" action=\"addbruciesays.php\" method=\"post\">";
	echo "Brucie Says: <input type=\"text\" name=\"bruciesays\" size=\"50\" maxlength=\"200\" />";
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
if ($admin == 1)
{
	if ($competition == "league")
	{
		echo "<tr><th><b>Rank</b></th><th><b>[<a href=\"addplayer.php\" title=\"Add a new player\">Add</a>] Player</b></th><th><b>Avatar</b></th><th><a href=\"addbrucies.php\" title=\"Add/reset Brucie Bonuses for all players\"><b>Brucies</b></a></th><th><a href=\"update.php?month=july\" title=\"Update points for this month\">Jul</a></th><th><a href=\"update.php?month=august\" title=\"Update points for this month\">Aug</a></th><th><a href=\"update.php?month=september\" title=\"Update points for this month\">Sep</a></th><th><a href=\"update.php?month=october\" title=\"Update points for this month\">Oct</a></th><th><a href=\"update.php?month=november\" title=\"Update points for this month\">Nov</a></th><th><a href=\"update.php?month=december\" title=\"Update points for this month\">Dec</a></th><th><a href=\"update.php?month=january\" title=\"Update points for this month\">Jan</a></th><th><a href=\"update.php?month=february\" title=\"Update points for this month\">Feb</a></th><th><a href=\"update.php?month=march\" title=\"Update points for this month\">Mar</a></th><th><a href=\"update.php?month=april\" title=\"Update points for this month\">Apr</a></th><th><a href=\"update.php?month=may\" title=\"Update points for this month\">May</a></th><th><a href=\"update.php?month=june\" title=\"Update points for this month\">Jun</a></th><th><b>Bonus</b></th><th><b>Total</b></th></tr>";
	}
	else
	{
		echo "<tr><th><b>Rank</b></th><th><b>[<a href=\"addplayer.php\" title=\"Add a new player\">Add</a>] Player</b></th><th><b>Avatar</b></th><th><a href=\"addbrucies.php\" title=\"Add/reset Brucie Bonuses for all players\"><b>Brucies</b></a></th><th><a href=\"update.php?month=groupstage\" title=\"Update points for this stage\">Group</a></th><th><a href=\"update.php?month=knockout\" title=\"Update points for this stage\">Knockout</a></th><th><b>Bonus</b></th><th><b>Total</b></th></tr>";
	}
}
else
{
	if ($competition == "league")
	{
		echo "<tr><tr><th><b>Rank</b></th><th><b>Player</b></th><th><b>Avatar</b></th><th><b>Brucies</b></th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th><b>Bonus</b></th><th><b>Total</b></th></tr>";
	}
	else
	{
		echo "<tr><tr><th><b>Rank</b></th><th><b>Player</b></th><th><b>Avatar</b></th><th><b>Brucies</b></th><th>Group</th><th>Knockout</th><th><b>Bonus</b></th><th><b>Total</b></th></tr>";
	}
}

$playerdata = mysqli_query($connection, "SELECT * FROM players ORDER BY name");

$totals = array();

//get all players and their totals
while ($playerrow = mysqli_fetch_array($playerdata))
{
	if ($competition == "league")
	{
		$totals[$playerrow['name']] = $playerrow['july'] + $playerrow['august'] + $playerrow['september'] + $playerrow['october'] + $playerrow['november'] + $playerrow['december'] + $playerrow['january'] + $playerrow['february'] + $playerrow['march'] + $playerrow['april'] + $playerrow['may'] + $playerrow['june'] + $playerrow['bonus'];
	}
	else
	{
		$totals[$playerrow['name']] = $playerrow['groupstage'] + $playerrow['knockout'] + $playerrow['bonus'];
	}
}

$noplayers = false;
if (mysqli_num_rows($playerdata) == 0 || mysqli_num_rows($playerdata) == 1)
{
	$noplayers = true;
}

$playerrow = null;
$playerdata = null;

//sort by totals
arsort($totals);

//rank counter
$rank = 0;

foreach ($totals as $name => $totalpoints)
{
	$playerdata = mysqli_query($connection, "SELECT * FROM players WHERE name = '" . $name . "'");

	while ($playerrow = mysqli_fetch_array($playerdata))
	{		
		if ($playerrow['name'] != "Admin")
		{
			$rank += 1;
			
			//highlight the row if it belongs to the logged in player
			if ($playerrow['name'] == $username)
			{
				$rowbg = "#006600";
				$headbg = "#006600";
			}
			else
			{
				$rowbg = "#222222";
				$headbg = "#333333";
			}
			if ($admin == 1)
			{
				//what to show if user is a game admin
				echo "<tr>";
				echo "<td style=\"background-color:" . $headbg . "\"><b>" . $rank . "</b></td>";
				echo "<td style=\"background-color:" . $rowbg . "\">[<a href=deleteplayer.php?player=" . $playerrow['player_id'] . " title=\"Delete this player\">Del</a>] <a href=\"avatar.php?player=" . $playerrow['player_id'] . "\" title=\"View or edit this player's settings\">" . $playerrow['name'] . "</a></td>";
			}
			else
			{
				//what to show if user is not a game admin
				echo "<tr>";
				echo "<td style=\"background-color:" . $headbg . "\"><b>" . $rank . "</b></td>";
				echo "<td style=\"background-color:" . $rowbg . "\"><a href=\"avatar.php?player=" . $playerrow['player_id'] . "\" title=\"View this player's avatar\">" . $playerrow['name'] . "</a></td>";
			}
			if ($playerrow['avatar'] != "")
			{
				echo "<td style=\"background-color:" . $rowbg . "\"><img src=\"" . $playerrow['avatar'] . "\" height=\"100\" width=\"100\"></td>";
			}
			else
			{
				echo "<td style=\"background-color:" . $rowbg . "\">Not Set</td>";				
			}
            if ($admin == 1)
            {
                echo "<td style=\"background-color:" . $rowbg . "\"><a href=\"setbrucies.php?player=" . $playerrow['player_id'] . "\" title=\"Add/reset Brucie Bonuses for this player\">" . $playerrow['brucies'] . "B</a></td>";
            }
            else
            {
                echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['brucies'] . "B</td>";
            }
			if ($competition == "league")
			{
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
			}
			else
			{
				echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['groupstage'] . "</td>";
				echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['knockout'] . "</td>";
			}
			if ($admin == 1)
			{
				echo "<td style=\"background-color:" . $rowbg . "\"><a href=\"setbonus.php\">" . $playerrow['bonus'] . "</a></td>";
			}
			else
			{
				echo "<td style=\"background-color:" . $rowbg . "\">" . $playerrow['bonus'] . "</td>";
			}
			echo "<td style=\"background-color:" . $headbg . "\"><b>" . $totalpoints . "</b></td>";
			echo "</tr>";
		}
	}
}

//display No Players if there are none
if ($noplayers)
{
	if ($competition == "league")
	{
		echo "<tr><td colspan=\"18\"><center>No Players</center></td></tr>";
	}
	else
	{
		echo "<tr><td colspan=\"8\"><center>No Players</center></td></tr>";
	}
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
	echo "User: " . $username;
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
if (isset($_SESSION['username']) && $_SESSION['username'] != "")
{
  echo "<a href=\"account.php\" title=\"account.php\">Account Settings</a> - <a href=\"halloffame.php\" title=\"See who the best Predikta players are!\">Hall Of Fame</a> - <a href=\"logout.php\" title=\"Clear your current session\">Logout</a> - <a href=\"reset.php\" title=\"Delete all fixtures and reset all points\">Reset</a> - <a href=\"viewlog.php\" title=\"View the log\">Log</a> - ";
}
echo "<a href=\"about.php\" title=\"About Predikta\">About</a>";

//functions to format mysqli dates and times
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
    {
		$points = 3;
    }
	elseif (($playerscore1 > $playerscore2) && ($actualscore1 > $actualscore2))
    {
		$points = 1;
    }
	elseif (($playerscore1 < $playerscore2) && ($actualscore1 < $actualscore2))
    {
		$points = 1;
    }
	elseif (($playerscore1 == $playerscore2) && ($actualscore1 == $actualscore2))
    {
		$points = 1;
    }
	if ($brucie == 1)
    {
		$points = $points * 2;
    }
	return $points;
}

function bruciepredicts($gameid, $team1, $team2)
{
	include("connect.php");
	
    $brucieid = 3; //this should not change as long as the player Brucie is never deleted
                   //TODO: prevent Brucie from being deleted in code

    $brucieresultdata = mysqli_query($connection, "SELECT * FROM results WHERE game_id = " . $gameid . " AND player_id = " . $brucieid);
    
    //check if Brucie has made a prediction yet for this game, if not, do it
    if (mysqli_num_rows($brucieresultdata) == 0)
    {
        $team1rank = brucieranking($team1);
        $team2rank = brucieranking($team2);
        
        $team1score = 0;
        $team2score = 0;
        $gap = round(abs($team1rank - $team2rank) / 4);
        if ($team1rank > $team2rank)
        {
            $team1score = $gap;
            $team2score = 0;
        }
        else
        {
            $team1score = 0;
            $team2score = $gap;
        }
        
        //weight random adjustments towards the home team
        if (rand(1, 3) == 3)
        {
            $team1score += 1;
        }
        if (rand(1, 3) == 3)
        {
            $team2score -= 1;
        }
        if ($team1score < 0) { $team1score = 0; }
        if ($team2score < 0) { $team2score = 0; }
        
        //don't predict more than 3 goals on either side
        if ($team1score > 3) { $team1score = 3; }
        if ($team2score > 3) { $team2score = 3; }
        
        //decide whether Brucie should use a Brucie (ha!)
        $bruciebonus = 0;
        if (abs($team1score - $team2score) >= 2)
        {
            $bruciedata = mysqli_query($connection, "SELECT brucies FROM players WHERE player_id = " . $brucieid);
            $brucierow = mysqli_fetch_array($bruciedata);
            if ($brucierow['brucies'] > 0)
            {
                $bruciebonus = 1;
                $updbrucies = $brucierow["brucies"] - 1;
                mysqli_query($connection, "UPDATE players SET brucies = " . $updbrucies . " WHERE player_id = " . $brucieid);
            }
        }
        
        writelog("Brucie predicted on game: " . $gameid);
        
        mysqli_query($connection, "INSERT INTO results (score_1, score_2, brucie, game_id, player_id) VALUES (" . (int)$team1score . ", " . (int)$team2score . ", " . $bruciebonus . ", " . $gameid . ", " . $brucieid . ")");
    }
}

function brucieranking($team)
{
    switch ($team)
    {
		case "Brazil":
			return 32;
		case "Belgium":
			return 31;
		case "Argentina":
			return 30;
		case "France":
			return 29;
		case "England":
			return 28;
		case "Spain":
			return 27;
		case "Netherlands":
			return 26;
		case "Portugal":
			return 25;
		case "Denmark":
			return 24;
		case "Germany":
			return 23;
		case "Croatia":
			return 22;
		case "Mexico":
			return 21;
		case "Uruguay":
			return 20;
		case "Switzerland":
			return 19;
		case "United States":
			return 18;
		case "Senegal":
			return 17;
		case "Wales":
			return 16;
		case "Iran":
			return 15;
		case "Serbia":
			return 14;
		case "Morocco":
			return 13;
		case "Japan":
			return 12;
		case "Poland":
			return 11;
		case "South Korea":
			return 10;
		case "Tunisia":
			return 9;
		case "Costa Rica":
			return 8;
		case "Australia":
			return 7;
		case "Canada":
			return 6;
		case "Cameroon":
			return 5;
		case "Ecuador":
			return 4;
		case "Qatar":
			return 3;
		case "Saudi Arabia":
			return 2;
		case "Ghana":
			return 1;
    }
}

?>

</center>
</body>

</html>
