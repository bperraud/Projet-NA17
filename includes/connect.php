<?php
function Connect(){
	$vHost="localhost";
	$vPort="5432";
	$vDbname="postgres";
	$vUser="postgres";
	$vPassword="admin";
	$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
	return $vConn;
}