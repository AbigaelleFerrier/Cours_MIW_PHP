<?php
function p($data = null){
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}
function d($data = null){
	p($data);
	die();
}