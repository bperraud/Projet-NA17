<?php
	function Connect(){
		$vHost = 'tuxa.sme.utc';
		$vPort = "5432";
		$vDbname = 'dbnf17p191';
		$vPassword = 'jTQiHn0m';
		$vUser = 'nf17p191';
		$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
		return $vConn;
		
	}

?>