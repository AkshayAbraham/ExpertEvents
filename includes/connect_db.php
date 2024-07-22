<?php

DEFINE ('DB_USER', 'c2070431');
DEFINE ('DB_PASSWORD', 'Anjalids1371991');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'c2070431_db3');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
	die("Connection failed: " . $dbc->connect_error);
}

$dbc -> set_charset("utf8");
?>

