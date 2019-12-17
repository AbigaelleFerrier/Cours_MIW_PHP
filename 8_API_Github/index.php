<?php 

$url = 'https://api.github.com/repos/FerrierCirill/directory/contents/peoples.json';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL            , $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt($ch, CURLOPT_HTTPHEADER     , array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_USERAGENT      , 'User-Agent: Awesome-Octocat-App');
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER , 'xxx');

$cont =  curl_exec($ch);
curl_close($ch);

$monJson = json_decode($cont); 
