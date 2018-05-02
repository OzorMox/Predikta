<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">

<script type="text/javascript" src="calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
</head>

<body>
<center>
<?php include("title"); ?>

<form name="addgame" action="processaddgame.php" method="post">
Select the teams for the new game
<br>
<br>

<!-- Premier League-->
<select name="team1">
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Belgium">Belgium</option>
<option value="Brazil">Brazil</option>
<option value="Colombia">Colombia</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Croatia">Croatia</option>
<option value="Denmark">Denmark</option>
<option value="Egypt">Egypt</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Iceland">Iceland</option>
<option value="Iran">Iran</option>
<option value="Japan">Japan</option>
<option value="Mexico">Mexico</option>
<option value="Morocco">Morocco</option>
<option value="Nigeria">Nigeria</option>
<option value="Panama">Panama</option>
<option value="Peru">Peru</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Russia">Russia</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="South Korea">South Korea</option>
<option value="Spain">Spain</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Tunisia">Tunisia</option>
<option value="Uruguay">Uruguay</option>
</select>
v
<select name="team2">
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Belgium">Belgium</option>
<option value="Brazil">Brazil</option>
<option value="Colombia">Colombia</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Croatia">Croatia</option>
<option value="Denmark">Denmark</option>
<option value="Egypt">Egypt</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Iceland">Iceland</option>
<option value="Iran">Iran</option>
<option value="Japan">Japan</option>
<option value="Mexico">Mexico</option>
<option value="Morocco">Morocco</option>
<option value="Nigeria">Nigeria</option>
<option value="Panama">Panama</option>
<option value="Peru">Peru</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Russia">Russia</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="South Korea">South Korea</option>
<option value="Spain">Spain</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Tunisia">Tunisia</option>
<option value="Uruguay">Uruguay</option>
</select>

<br>
<br>
<input type="checkbox" name="custom" value="yes" /> Custom
<br>
<input type="text" name="customgame1" />
v
<input type="text" name="customgame2" />
<br>
<br>
Enter the date for the fixture
<br>
<br>
<?php

//re-use previous date if available, otherwise default to today's date
if (!isset($_GET["date"]))
{
	echo "<script>DateInput('date', true, 'YYYY-MM-DD')</script>";
}
else
{
	echo "<script>DateInput('date', true, 'YYYY-MM-DD', '" . $_GET["date"] . "')</script>";
}

?>
<br>
<br>
Select the game type
<br>
<br>
<table style="border-style:none;">
<tr>
<td style="border-style:none;"><input type="radio" name="type" value="weekend" checked="checked"></td><td style="border-style:none;">12pm Lock</td>
</tr>
<tr>
<td style="border-style:none;"><input type="radio" name="type" value="weekday"></td><td style="border-style:none;">7pm Lock</td>
</tr>
</table>
<br>
<input type="checkbox" name="another" value="yes" checked="yes" /> Add Another
<br>
<br>
<input type="submit" value="OK" />
</form>
<a href="index.php">Back</a>

</center>
</body>

</html>
