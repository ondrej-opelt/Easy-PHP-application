<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#PHP z�kladn� funkce
session_start();
error_reporting(0);

#P�ipojen� k DB
$sql = mysqli_connect("localhost","root","","db_easyapp") or die("Error " . mysqli_error($sql));
$result = $sql->query("SET NAMES utf8");
$GLOBALS['sql']=$sql;

#Nastaven� jazyka (p�i pot�eb� mo�n� roz���it)
$language=1;

?>