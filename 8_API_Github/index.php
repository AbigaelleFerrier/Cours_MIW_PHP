<?php 

$url = 'http://api.github.com/users/FerrierCirill';

$ch = curl_init();

var_dump($ch);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
curl_setopt($ch, CURLOPT_USERAGENT,'User-Agent: Awesome-Octocat-App');
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, '011e6f55f884f2253323f5baa29d478347f0d848');
// var_dump(curl_getinfo ($ch));

$cont =  curl_exec($ch);

// var_dump($cont);

curl_close($ch);

var_dump(json_decode($cont));


curl_close($ch);


