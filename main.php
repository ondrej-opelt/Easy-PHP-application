<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Vlo�en� z�kladn�ch nastaven� a funkc�
require 'libs/_general.php';
require 'libs/_functions.php';

#Zji�t�n� zda se m� prov�st operace na u�ivatele
if(isset($_POST['submit']))
{
  #Vlo�en� kontroly p�ihl�en�
  require 'operations/_check.php'; 
}
elseif(isset($_POST['insert']))
{
  #Vlo�en� kontroly registrace
  require 'operations/_insert.php'; 
}

#Zji�t�n� zda nen� u�ivatel p�ihl�en�
if(!isset($_SESSION['user']))
{
  #Zji�t�n� zda m� doj�t k registraci
  if(isset($_POST['register']))
  {
    #Vlo�en� registrace
    require 'pages/_register.php';
  }
  
  #Jestli�e nem� doj�t k registraci
  else
  {
    #Vlo�en� p�ihl�en�
    require 'pages/_login.php';
  }
}

#Jestli�e je u�ivatel p�ihl�en�
else
{
  #Vlo�en� tla��tka pro odhl�en�
  require 'operations/logout.php';
  
  #vlo�en� �l�nk�
  require 'pages/_articles.php';
  
}
?>