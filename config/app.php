<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'blog_cdn');
define( 'ROOT_PATH', $base_dir );



include_once("DatabaseConnection.php");
$db = new DatabaseConnection;
