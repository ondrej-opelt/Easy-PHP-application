<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#Vložení základních nastavení a funkcí
require 'libs/_general.php';
require 'libs/_functions.php';

#Zjištìní zda se má provést operace na uživatele
if(isset($_POST['submit']))
{
  #Vložení kontroly pøihlášení
  require 'operations/_check.php'; 
}
elseif(isset($_POST['insert']))
{
  #Vložení kontroly registrace
  require 'operations/_insert.php'; 
}

#Zjištìní zda není uživatel pøihlášený
if(!isset($_SESSION['user']))
{
  #Zjištìní zda má dojít k registraci
  if(isset($_POST['register']))
  {
    #Vložení registrace
    require 'pages/_register.php';
  }
  
  #Jestliže nemá dojít k registraci
  else
  {
    #Vložení pøihlášení
    require 'pages/_login.php';
  }
}

#Jestliže je uživatel pøihlášený
else
{
  #Vložení tlaèítka pro odhlášení
  require 'operations/logout.php';
  
  #vložení èlánkù
  require 'pages/_articles.php';
  
}
?>