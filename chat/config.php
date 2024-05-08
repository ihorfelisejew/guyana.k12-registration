<?php

/* PLEASE DO NOT ALLOW EVEN ONE BLANK SPACE/LINE IN THIS FILE OUTSIDE '<?php' AND 'error_reporting(1);
?>' */

$salt='kwa1zawunztvw6tt';                 // Salt. A salt consists of random chars used as one of the inputs of a one-way function (MD5 hash). DO NOT CHANGE!


/* ------ BLAB! DATABASE SETTINGS ------  */


$dbss=array();
$dbss['type']='mysql';         // Database type, *lowercase* (options: mysql, mysqli, postgre, sqlite, pdo_sqlite)
$dbss['host']='localhost';         // Database host (in most cases 'localhost', on Windows systems - use '127.0.0.1' instead of 'localhost' to avoid a php/ipv6 bug)
$dbss['user']='registration';         // Database user (not used with sqlite)
$dbss['pass']='aries123';         // Database password  (not used with sqlite)
$dbss['name']='sports_league';         // Database name [mysql, postgre]. Note that the installation script cannot create a database for you!
$dbss['prfx']='blab8';         // Table prefix for BLAB! tables, default 'blab8'
$dbss['sqlt']='';         // Database file [sqlite]: 'path/filename', a 0-byte file CHMODed to 777 in a dir that is CHMODed to 777
$dbss['sqlp']=0;          // SQLITE only: PRAGMA synchronous; options: 0|1|2; 0 = OFF /fastest/; 1= NORMAL; 2 = FULL /slowest/
$dbss['pcon']=0;          // [0 or 1] Establishes a persistent connection to the SQL server. If you are not sure leave it 0.
$dbss['cset']='utf8';     // mysql & mysqli only: utf8 or utf8mb4 [utf8 is default, if your database is converted to utf8mb4 to support emoji then set utf8mb4]


/* ------- ADDITIONAL SETTINGS ------- */


$error_log='errors.txt';           // CHMODed to 777 file to store sql errors if any ( it is recommended to rename this file )
$latest_mssg=20;                   // Messages to display when users enter the chat, recommended value: 5-50.
$bwords=array('fuck','bitch');     // Bad words array: $bwords=array('fuck','bitch','etc');  $bwords=0; -> off. Turn it off to save CPU resources. 
$topic='/topic';                   // Topic. If found, the posted text appears with larger letters and clears the screen.
$paint_prefix='p';                 // Paint prefix. Mind that it's to be set in "preg_replace" function. To be safe use letters only.
$anonymto=0;                       // Links are converted to anonym.to links [0 or 1]

error_reporting(1);
?>