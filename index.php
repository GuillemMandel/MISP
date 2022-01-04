
<?php

include_once __DIR__ . "/info.php";


function score($ip)
{
    $scores = [
        "ip" => ip2long($ip),
        "score" => "0",
        "date" => getdate(),
    ];
    $aux = 0;

    //IBM X-FORCE
    try{

        $xFor = abuseipdb($ip);
        $scores["score"] .= $xFor["data"]["abuseConfidenceScore"]/10;
        $scores["score"] = $scores["score"] + $xFor['score'];
        $aux = $aux +1;
        $scores["country"] = $xFor['geo']['country'];
        $scores["xForce"]=var_dump([
            'score' => $xFor['score'],
            'country' => $xFor['geo']['country'],
            'reason' => $xFor['reason'],
            'last_seen' => $xFor['created'],
        ]);

    } catch (Exception $e) {
        echo 'Exception ocurred: ',  $e->getMessage(), "\n";
    }

    //AbuseIPdb
    try{

        $abuse = abuseipdb($ip);
        $scores["score"] .= $abuse["data"]["abuseConfidenceScore"]/10;
        $aux .= +1;
        $scores["abuse"]=var_dump([
            'score' => $abuse["data"]["abuseConfidenceScore"]/10,
            'country' => $abuse["data"]["countryCode"],
            'isp' => $abuse["data"]["isp"],
            
        ]);

    } catch (Exception $e) {
        echo '"abuseIPDB API not working properly, check API keys" ',  $e->getMessage(), "\n";
        $scores["abuse"]='-';
    }

    //Virus Total
    try{

        $virus = virusTotal($ip);
        if($virus['last_analysis_stats']['malicious']>3 || $virus['last_analysis_stats']['suspicious']>10) {
            $scores["score"] = $scores["score"] + 10;
            $aux= $aux + 1;
        }
        $scores["virus"]=var_dump([
            "last_analysis_stats" => $virus['last_analysis_stats'], 
            "country" => $virus['country'], 
            "owner" => $virus['as_owner'],
        ]);

    } catch (Exception $e) {
        echo 'Exception ocurred: ',  $e->getMessage(), "\n";
        $scores["virus"]='-';
    }

    //Url Quality
    try{

        $urlQ = urlQuality($ip);
        $scores["score"] .= $urlQ["fraud_score"]/10;
        $aux .= +1;
        $scores["urlQ"]=var_dump([
            'score' => $urlQ["fraud_score"]/10,
            'country' => $urlQ["country_code"],
            'isBot' => $urlQ["bot_status"],
            'organization' => $urlQ["organization"],
        ]);

    } catch (Exception $e) {
        echo 'Exception ocurred: ',  $e->getMessage(), "\n";
        $scores["urlQ"]='-';
    }




    if($aux != 0) {
        $scores["score"] = $scores["score"]/$aux;
        try{
            if($scores["urlQ"]["isBot"]) {
                $scores["score"]= scores["score"] + 1;
            }
        } catch (Exception $e) {

        }

    }


    return $scores;
}

score("179.43.149.13");



?>
