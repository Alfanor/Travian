<?php
if(long2ip(ip2long($_SERVER['REMOTE_ADDR'])) == '127.0.0.1') {
	$dsn = 'mysql:dbname=travian_artefact;host=127.0.0.1';
	$user = 'travian_artefact';
	$password = 'travian_artefact';
}

else {
	$dsn = 'mysql:dbname=dbname;host=127.0.0.1';
	$user = 'user';
	$password = 'password';
}
?>
