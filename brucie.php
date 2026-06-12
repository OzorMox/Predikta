<?php
function bruciepredicts($gameid, $team1, $team2)
{
    include("connect.php");

    $brucieid = 3; //update to new ID for Brucie if the database is reset

    $brucieresultdata = mysqli_query($connection, "SELECT * FROM results WHERE game_id = " . $gameid . " AND player_id = " . $brucieid);

    //check if Brucie has made a prediction yet for this game, if not, do it
    if (mysqli_num_rows($brucieresultdata) == 0)
    {
        $prediction = gemini_predict_result($gameid, $team1, $team2);
        if ($prediction !== null)
        {
            $team1score = $prediction['home'];
            $team2score = $prediction['away'];
            $bruciebonus = $prediction['bonus'];

            $bruciedata = mysqli_query($connection, "SELECT brucies FROM players WHERE player_id = " . $brucieid);
            $brucierow = mysqli_fetch_array($bruciedata);
            if ($bruciebonus == 1 && $brucierow['brucies'] > 0)
            {
                $updbrucies = $brucierow["brucies"] - 1;
                mysqli_query($connection, "UPDATE players SET brucies = " . $updbrucies . " WHERE player_id = " . $brucieid);
            }
            else
            {
                $bruciebonus = 0;
            }

            mysqli_query($connection, "INSERT INTO results (score_1, score_2, brucie, game_id, player_id) VALUES (" . (int)$team1score . ", " . (int)$team2score . ", " . $bruciebonus . ", " . $gameid . ", " . $brucieid . ")");
        }
    }
}

function gemini_predict_result($gameid, $team1, $team2)
{
    $result = null;
    $success = false;
    $response = null;
    $curlError = null;

    $apiKey = "key";
    if ($apiKey)
    {
        $endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';
        $prompt = "You are predicting an international football match. The home team is '" . $team1 . "' and the away team is '" . $team2 . "'. " .
            "Return exactly one line and no extra text in this exact format: x,y,b. " .
            "x is the home team score, y is the away team score, and b is 1 if this prediction should double the points, otherwise 0. You should double the points if you are fairly sure of the winner.";

        $postData = json_encode(array(
            'contents' => array(
                array(
                    'parts' => array(
                        array('text' => $prompt)
                    )
                )
            )
        ));

        $headers = array(
            'Content-Type: application/json',
            'X-goog-api-key: ' . $apiKey
        );

        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);

        if ($response !== false && $statusCode == 200)
        {
            $decoded = json_decode($response, true);
            if (is_array($decoded) && isset($decoded['candidates'][0]['content']['parts'][0]['text']))
            {
                $content = trim($decoded['candidates'][0]['content']['parts'][0]['text']);
                if (preg_match('/^(\d+),(\d+),([01])$/', $content, $matches))
                {
                    $result = array(
                        'home' => (int)$matches[1],
                        'away' => (int)$matches[2],
                        'bonus' => (int)$matches[3]
                    );
                    $success = true;
                }
            }
        }
    }

    if (!$success)
    {
        writelog("BrucieAI failed, skipping prediction on game: " . $gameid . ", Gemini response: " . $response);
        return null;
    }

    writelog("BrucieAI predicted on game: " . $gameid);
    return $result;
}

?>
