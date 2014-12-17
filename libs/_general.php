<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#PHP základní funkce
session_start();
error_reporting(0);

#Pøipojení k DB
$sql = mysqli_connect("localhost","root","","db_easyapp") or die("Error " . mysqli_error($sql));
$result = $sql->query("SET NAMES utf8");
$GLOBALS['sql']=$sql;

#Nastavení jazyka (pøi potøebì možné rozšíøit)
$language=1;

?>