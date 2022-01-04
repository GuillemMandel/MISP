<?php


function xForce($ip) {
    
    $io = array(
        'Accept => application/json',
        'Authorization => Basic MzU0NzI1OTktZjZiNy00MmRiLTg4YmEtMzJlNjYxNjNhZDRmOjEyYWVlYjJmLTQ2OTQtNDQ5My04YWFkLWY4N2JiZjk0ZTdjYQ==',
        );
    

    $url = ("https://api.xforce.ibmcloud.com/auth/AnonymousToken/" . $ip . "?api-key=" . strval($io));
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    
    $data = curl_exec($ch);

    print_r($data);
    print_r(curl_error($ch));
    $info = curl_getinfo($ch);

    curl_close($ch);
}

function abuseipdb($ip) {    

    $url = ("https://api.abuseipdb.com/api/v2/check");
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Key: c6e91f067193b730228ebbfb4c5f924a5317a26be3997a0601963731135641a83d6c74874856bbe1',
        ));
    curl_setopt($ch, CURLOPT_POST, 1);

    
    $query = ['ipAddress' => $ip];

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));

    $data = curl_exec($ch);

    print_r($data);
    print_r(curl_error($ch));
    $info = curl_getinfo($ch);

    curl_close($ch);

    return $data;
}
?>