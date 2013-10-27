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
<option value="Arsenal">Arsenal</option>
<option value="Aston Villa">Aston Villa</option>
<option value="Cardiff">Cardiff</option>
<option value="Chelsea">Chelsea</option>
<option value="Crystal Palace">Crystal Palace</option>
<option value="Everton">Everton</option>
<option value="Fulham">Fulham</option>
<option value="Hull">Hull</option>
<option value="Liverpool">Liverpool</option>
<option value="Man City">Man City</option>
<option value="Man Utd">Man Utd</option>
<option value="Newcastle">Newcastle</option>
<option value="Norwich">Norwich</option>
<option value="Southampton">Southampton</option>
<option value="Stoke">Stoke</option>
<option value="Sunderland">Sunderland</option>
<option value="Swansea">Swansea</option>
<option value="Tottenham">Tottenham</option>
<option value="West Brom">West Brom</option>
<option value="West Ham">West Ham</option>
</select>
v
<select name="team2">
<option value="Arsenal">Arsenal</option>
<option value="Aston Villa">Aston Villa</option>
<option value="Cardiff">Cardiff</option>
<option value="Chelsea">Chelsea</option>
<option value="Crystal Palace">Crystal Palace</option>
<option value="Everton">Everton</option>
<option value="Fulham">Fulham</option>
<option value="Hull">Hull</option>
<option value="Liverpool">Liverpool</option>
<option value="Man City">Man City</option>
<option value="Man Utd">Man Utd</option>
<option value="Newcastle">Newcastle</option>
<option value="Norwich">Norwich</option>
<option value="Southampton">Southampton</option>
<option value="Stoke">Stoke</option>
<option value="Sunderland">Sunderland</option>
<option value="Swansea">Swansea</option>
<option value="Tottenham">Tottenham</option>
<option value="West Brom">West Brom</option>
<option value="West Ham">West Ham</option>
</select>

<!-- Euro 2012 -->
<!--
<select name="team1">
<option value="Croatia">Croatia</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Greece">Greece</option>
<option value="Italy">Italy</option>
<option value="Netherlands">Netherlands</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Republic of Ireland">Republic of Ireland</option>
<option value="Russia">Russia</option>
<option value="Spain">Spain</option>
<option value="Sweden">Sweden</option>
<option value="Ukraine">Ukraine</option>
</select>

<select name="team2">
<option value="Croatia">Croatia</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Greece">Greece</option>
<option value="Italy">Italy</option>
<option value="Netherlands">Netherlands</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Republic of Ireland">Republic of Ireland</option>
<option value="Russia">Russia</option>
<option value="Spain">Spain</option>
<option value="Sweden">Sweden</option>
<option value="Ukraine">Ukraine</option>
</select>
</select>
-->

<!-- World Cup 2010 -->
<!--
<select name="team1">
<option value="Algeria">Algeria</option>
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Brazil">Brazil</option>
<option value="Cameroon">Cameroon</option>
<option value="Chile">Chile</option>
<option value="Denmark">Denmark</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option>
<option value="Honduras">Honduras</option>
<option value="Italy">Italy</option>
<option value="Ivory Coast">Ivory Coast</option>
<option value="Japan">Japan</option>
<option value="Mexico">Mexico</option>
<option value="Netherlands">Netherlands</option>
<option value="New Zealand">New Zealand</option>
<option value="Nigeria">Nigeria</option>
<option value="North Korea">North Korea</option>
<option value="Paraguay">Paraguay</option>
<option value="Portugal">Portugal</option>
<option value="Serbia">Serbia</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="South Africa">South Africa</option>
<option value="South Korea">South Korea</option>
<option value="Spain">Spain</option>
<option value="Switzerland">Switzerland</option>
<option value="Uruguay">Uruguay</option>
<option value="USA">USA</option>
</select>
v
<select name="team2">
<option value="Algeria">Algeria</option>
<option value="Argentina">Argentina</option>
<option value="Australia">Australia</option>
<option value="Brazil">Brazil</option>
<option value="Cameroon">Cameroon</option>
<option value="Chile">Chile</option>
<option value="Denmark">Denmark</option>
<option value="England">England</option>
<option value="France">France</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option>
<option value="Honduras">Honduras</option>
<option value="Italy">Italy</option>
<option value="Ivory Coast">Ivory Coast</option>
<option value="Japan">Japan</option>
<option value="Mexico">Mexico</option>
<option value="Netherlands">Netherlands</option>
<option value="New Zealand">New Zealand</option>
<option value="Nigeria">Nigeria</option>
<option value="North Korea">North Korea</option>
<option value="Paraguay">Paraguay</option>
<option value="Portugal">Portugal</option>
<option value="Serbia">Serbia</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="South Africa">South Africa</option>
<option value="South Korea">South Korea</option>
<option value="Spain">Spain</option>
<option value="Switzerland">Switzerland</option>
<option value="Uruguay">Uruguay</option>
<option value="USA">USA</option>
</select>
-->

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
	echo "<script>DateInput('date', true, 'YYYY-MM-DD')</script>";
else
	echo "<script>DateInput('date', true, 'YYYY-MM-DD', '" . $_GET["date"] . "')</script>";

?>
<br>
<br>
Select the game type
<br>
<br>
<table style="border-style:none;">
<tr>
<td style="border-style:none;"><input type="radio" name="type" value="weekend" checked="checked"></td><td style="border-style:none;">Weekend (12pm lock)</td>
</tr>
<tr>
<td style="border-style:none;"><input type="radio" name="type" value="weekday"></td><td style="border-style:none;">Weekday (7pm lock)</td>
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
