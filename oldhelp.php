<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>

<?php include("title"); ?>

<a href="#overview">Overview</a> - <a href="#addplayer">Add Player</a> - <a href="#delplayer">Delete Player</a> - <a href="#addgame">Add Game</a> - <a href="#delgame">Delete Game</a> - <a href="#setpred">Set Predictions</a>
<br><a href="#activate">Activate Game</a> - <a href="#update">Update Points</a> - <a href="#setpoints">Set Points</a> - <a href="#password">Change Admin Password</a> - <a href="#reset">Reset</a>

<p><b><a name="overview">[Overview]</a></b>

<p>Predikta displays all the information you need to know about the current season on the main page.
<br>
<br><b>Fixtures</b> lists all of the current games that are active, along with the actual score and the predictions each player has made.
<br>If the game has not yet been activated, <b>Activate</b> will appear in place of the actual result.
<br>If a player's prediction has not yet been set, <b>Set</b> will appear in place of their prediction.
<br>Games can be added and deleted from here.
<br>
<br><b>Points Table</b> shows the total points for each player.
<br>The totals are broken down in to the ten months in the season, as well as showing the overall total of all months.
<br>Players can be added and deleted from this table.
<br>At the bottom are links to various useful functions.

<p><b><a name="addplayer">[Add Player]</a></b>

<p>To add a new player to the game, click <b>Add</b> on the <b>Player</b> column.
<br>Enter the new player's name, enter the admin password, and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page where the new player will appear on the <b>Fixtures</b> list, as well as on the <b>Points Table</b>.

<p><b><a name="delplayer">[Delete Player]</a></b>

<p>To delete a player, click <b>Del</b> next to the required player.
<br>Enter the admin password to confirm and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>All information about the deleted player will be removed.

<p><b><a name="addgame">[Add Game]</a></b>

<p>To add a game to the list of <b>Fixtures</b>, click <b>Add</b> on the <b>Game</b> column.
<br>Enter the names of the teams, enter the admin password, and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page where the new game will appear.

<p><b><a name="delgame">[Delete Game]</a></b>

<p>To delete a game from the list of <b>Fixtures</b>, click <b>Del</b> next to the required game.
<br>Enter the admin password to confirm and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>All information about the deleted game will be removed.

<p><b><a name="setpred">[Set Predictions]</a></b>

<p>To set a player's prediction for a game, click <b>Set</b> in the cell that corresponds to that player and game.
<br>Enter the prediction this player has made, enter the admin password, and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>No <b>Set</b> option will be available for players whose prediction has already been set for that game.

<p><b><a name="activate">[Activate Game]</a></b>

<p>When a game's actual result is available, click <b>Activate</b> for that game.
<br>Enter the actual score, enter the admin password and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>Once a game is activated, player predictions will be compared against the actual result and included in the points at the bottom of the <b>Fixtures</b> list.
<br>No <b>Activate</b> option will be available for games that have already been activated.

<p><b><a name="update">[Update Points]</a></b>

<p>The list of <b>Fixtures</b> can be cleared, adding the points to the selected month in the <b>Points Table</b>.
<br>Click on the required month at the top of the <b>Points Table</b>.
<br>Enter the admin password to confirm and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>The <b>Fixtures</b> list will now be empty, and the selected month in the <b>Points Table</b> will have been updated.

<p><b><a name="setpoints">[Set Points]</a></b>

<p>A player's points for a particular month can be set manually if required.
<br>Click the points in the cell that corresponds to that player and month.
<br>Enter the points this player should have for this month, enter the admin password, and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>This option will be particularly helpful if starting mid-season.

<p><b><a name="password">[Change Admin Password]</a></b>

<p>The admin password is required when making any changes to Predikta, to prevent changes being made by users not managing the game.
<br>To change the admin password, click <b>Admin Password</b>.
<br>Enter the new password, enter the current password, and click <b>OK</b>.
<br>If the current admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.
<br>The new admin password will now be required for all changes.

<p><b><a name="reset">[Reset]</a></b>

<p>Predikta provides an option to quickly reset the entire game.
<br>All games are deleted and all points are reset to zero.
<br>Be careful when using this option, this information is lost permanently!
<br>Players are retained, and need not be recreated after resetting the game.
<br>To reset, click <b>Reset</b>.
<br>Enter the admin password to confirm and click <b>OK</b>.
<br>If the admin password was correct, a confirmation will be displayed.
<br>Click <b>Back</b> to return to the main page.

<p><a href="index.php">Back</a>

</center>
</body>

</html>
