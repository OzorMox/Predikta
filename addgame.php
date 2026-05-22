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

<!-- 2026 FIFA World Cup Teams-->
<select name="team1">
	<option value="Algeria">Algeria</option>
	<option value="Argentina">Argentina</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Belgium">Belgium</option>
	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
	<option value="Brazil">Brazil</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Colombia">Colombia</option>
	<option value="Croatia">Croatia</option>
	<option value="Curaçao">Curaçao</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="DR Congo">DR Congo</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="England">England</option>
	<option value="France">France</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Haiti">Haiti</option>
	<option value="Iran">Iran</option>
	<option value="Iraq">Iraq</option>
	<option value="Ivory Coast">Ivory Coast</option>
	<option value="Japan">Japan</option>
	<option value="Jordan">Jordan</option>
	<option value="Mexico">Mexico</option>
	<option value="Morocco">Morocco</option>
	<option value="Netherlands">Netherlands</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Norway">Norway</option>
	<option value="Panama">Panama</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Portugal">Portugal</option>
	<option value="Qatar">Qatar</option>
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Scotland">Scotland</option>
	<option value="Senegal">Senegal</option>
	<option value="South Africa">South Africa</option>
	<option value="South Korea">South Korea</option>
	<option value="Spain">Spain</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="United States">United States</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
</select>
v
<select name="team2">
	<option value="Algeria">Algeria</option>
	<option value="Argentina">Argentina</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Belgium">Belgium</option>
	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
	<option value="Brazil">Brazil</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Colombia">Colombia</option>
	<option value="Croatia">Croatia</option>
	<option value="Curaçao">Curaçao</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="DR Congo">DR Congo</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="England">England</option>
	<option value="France">France</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Haiti">Haiti</option>
	<option value="Iran">Iran</option>
	<option value="Iraq">Iraq</option>
	<option value="Ivory Coast">Ivory Coast</option>
	<option value="Japan">Japan</option>
	<option value="Jordan">Jordan</option>
	<option value="Mexico">Mexico</option>
	<option value="Morocco">Morocco</option>
	<option value="Netherlands">Netherlands</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Norway">Norway</option>
	<option value="Panama">Panama</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Portugal">Portugal</option>
	<option value="Qatar">Qatar</option>
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Scotland">Scotland</option>
	<option value="Senegal">Senegal</option>
	<option value="South Africa">South Africa</option>
	<option value="South Korea">South Korea</option>
	<option value="Spain">Spain</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="United States">United States</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
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
<input type="checkbox" name="another" value="yes" checked="yes" /> Add Another
<br>
<br>
<input type="submit" value="OK" disabled />
</form>
<a href="index.php">Back</a>

</center>
</body>

</html>
