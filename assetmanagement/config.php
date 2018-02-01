<?php

$username = "QPS_user";
$password = "QPS_user";
$host = "localhost";

$connector = mysql_connect($host,$username,$password)
  or die("Unable to connect");
echo "Connections are made successfully::";
$selected = mysql_select_db("QPSDatabase", $connector)
or die("Unable to connect");

?>