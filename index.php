<?php

// -> zakladne nastavenie premennych - INDEX
$continue = true;					// povolenie dalsieho behu programu


declare(strict_types=1);
function hexfloat($hex) {

    $dec = hexdec($hex);

    if ($dec === 0) {
        return 0;
    }

    $sup = 1 << 23;

    $x = ($dec & ($sup - 1)) + $sup * ($dec >> 31 | 1);

    $exp = ($dec >> 23 & 0xFF) - 127;
    $sign = ($dec & 0x80000000) ? -1 : 1;
	
    return ($sign * $x * pow(2, $exp - 23));

	echo '::';
}

// ----------------------------------------------------------------------------
// => PRIPOJENIE K DB
include 'db_connection.php';

// ----------------------------------------------------------------------------
// -> hlavicka web dokumenta
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/htm; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="oit.css">
		<meta name="Keywords" content="IoT">
		<title>IOT - final</title>
	</head>

	<body>

	<table width="1200" align="center"><tr valign="top"><td>';

if($continue) {
	require 'function.php';
	
#print_r($_POST);

	$disp_post = $_POST;

	$segment = '';
	if(isset($_POST['segment'])) { $segment = read_data('segment'); };
	
	$activity = '';
	if(isset($_POST['activity'])) { $activity = read_data('activity'); };

	include 'menu_top.php';
	
	include 'appl_continue.php';
};

echo '</td></tr></table>
	</body>
</html>';

// -> disconnect DB
@mysql_close($db_link);
?>

