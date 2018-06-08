<?php

//$dbhost="localhost";
//$dbuser ="kpridedbuser";
//$dbpwd="Aexd1q7O03ESlvgI";
//$dbschema="knowledgepride";

$dbhost="localhost";
$dbuser ="root";
$dbpwd="";
$dbschema="knowledgepride_maindb";

 $sql = mysql_connect($dbhost,$dbuser,$dbpwd) or die (mysql_error());
 $check = mysql_select_db($dbschema,$sql);



 //Turn off all deprecated warnings including them from mysql_*
 error_reporting(E_ALL ^ E_DEPRECATED);

/*
if(!isset($check)){
	echo "ooops!!!";
}else{
	echo "good";
}
*/


?>