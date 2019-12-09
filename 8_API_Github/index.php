<?php 

$url = 'https://api.github.com/repos/FerrierCirill/directory/contents/peoples.json';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL            , $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt($ch, CURLOPT_HTTPHEADER     , array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_USERAGENT      , 'User-Agent: Awesome-Octocat-App');
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER , '011e6f55f884f2253323f5baa29d478347f0d848');

$cont =  curl_exec($ch);
curl_close($ch);

$monJson = json_decode($cont); 
echo(base64_decode($monJson->{'content'}));
