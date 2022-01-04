<?php


function xForce($ip) {
    $url = ("https://api.xforce.ibmcloud.com/auth/AnonymousToken/" . $ip);
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Authorization: Basic MzU0NzI1OTktZjZiNy00MmRiLTg4YmEtMzJlNjYxNjNhZDRmOjEyYWVlYjJmLTQ2OTQtNDQ5My04YWFkLWY4N2JiZjk0ZTdjYQ=='
        ));
    
    $data = curl_exec($ch);

    $info = curl_getinfo($ch);

    curl_close($ch);
}
?>