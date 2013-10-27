<?php
  $REMIND_DAYS = 2;	// The number of days before the next game to send reminder emails

  if (isset($_GET['remind_days']) && $_GET['remind_days'])
  {
    $REMIND_DAYS = $_GET['remind_days'];
  }

  //-------------------------------------------------------------------------------------------------

  // Method to get a list of players that wish to be reminded by email
  function get_reminder_players($conn)
  {
    $t_player_array = array();

    $t_sql =  "SELECT `name`, `email` " . 
              "FROM `players` " . 
              "WHERE `email` IS NOT NULL AND `send_reminder_email` = 1;";

    if ($t_rs = mysql_query($t_sql))
    {
      while ($t_row = mysql_fetch_assoc($t_rs))
      {
        array_push($t_player_array, array("name" => $t_row['name'], "email" => $t_row['email']));
      }
    }
    
    return $t_player_array;
  }

  //-------------------------------------------------------------------------------------------------

  if (isset($_GET['key']) && $_GET['key'] == "89dshjv903h4tingkjlwnhikzd89778as8934tnuosx909")
  {
    // Connect to the database
    require_once('connect.php');

    // Include PHPMailer class
    require_once("class.phpmailer.php");

    // Fetch a list of games occurring in exactly $REMIND_DAYS days time
    $t_sql =  "SELECT `team_1`, `team_2`, `date` " . 
              "FROM `games` " . 
              "WHERE `date` = DATE(DATE_ADD(NOW(), INTERVAL " . $REMIND_DAYS . " DAY));";

    if ($t_rs = mysql_query($t_sql))
    {
      // Build a list of upcoming games (to display in email)
      $t_upcoming_games = "";      
      while ($t_row = mysql_fetch_assoc($t_rs))
      {
        $t_upcoming_games .= $t_row['date'] . ': ' . $t_row['team_1'] . " vs " . $t_row['team_2'] . "\n";
      }

      if (strlen($t_upcoming_games) == 0)
      {
        echo "No games were returned, so no message will be sent. Have nice day!\n";
        exit;
      }

      // Fetch an array of players that want to be reminded...
      if (isset($_GET['test']) && $_GET['test'] == 1)
      {
        $t_player_array = array();
        array_push($t_player_array, array("name" => "Edward Jacobs", "email" => "essoft@gmail.com"));
        array_push($t_player_array, array("name" => "James Hemming", "email" => "jameskhemming@gmail.com"));
      }
      else
      {
        $t_player_array = get_reminder_players($connection);
      }

      if (count($t_player_array) > 0)
      {
    	 $t_mail = new PHPMailer();
	 $t_mail->From = "predikta@jkhemming.co.uk";
	 $t_mail->FromName = "Predikta";

         // Loop through all the players that wish to be sent reminder emails to add their email address to recipients
         for($n = 0; $n < count($t_player_array); $n += 1)
         {
      	    $t_mail->AddAddress($t_player_array[$n]['email'], $t_player_array[$n]['name']);
         }

         $t_mail->IsHTML(false);                                  // set email format to HTML

         $t_mail->Subject = "Predikta Reminder";
         $t_mail->Body    = "Hi,\n\nThe following game(s) are being played in " . $REMIND_DAYS . " day(s). ";
         $t_mail->Body   .= "Don't forget to set your predictions. It's nice to see you, to see you nice!\n\n";
         $t_mail->Body   .= $t_upcoming_games . "\n\n";
         $t_mail->Body   .= "Regards,\n\n";
         $t_mail->Body   .= "Bruce Forsyth\n";

         if(!$t_mail->Send())
         {
           echo "Message could not be sent.\n";
           echo "Mailer Error: " . $t_mail->ErrorInfo . "\n";
           exit;
         }

         echo "Message has been sent\n";
      }
      else
      {
        echo "No players want these pesky emails :-(\n";
      }

    }
    else
    {
      echo "Failed to query upcoming games: " . mysql_error() . "\n";
    }

  }
  else
  {
     echo "Go away!\n";
  }
?>
