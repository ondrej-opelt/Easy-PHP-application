<?php ### vytvo�eno 17.12.2014  ### ?>
<?php
#Na�ten� text� z datab�ze
$designation="articles";
$text=fce_gettext($designation,$language);

#P��prava prom�n�ch pro p��pad chybn�ho zad�n�
$chyby="";

#Zji�t�n� zda se ulo�it tvorba nov�ho �l�nku
if(isset($_POST['create']))
{
  #P��prava prom�n�ch pro p��pad chybn�ho zad�n�
  $_POST['new']=TRUE;
  
  #Zji�t�n� zda n�jak� pole je pr�zdn�
  if((empty($_POST['title'])) OR (empty($_POST['text'])))
  {
    #Vytvo�en� chybov� hl�ky
    $chyby.=$text[10];
  }
  
  #Kdy� je v�e zad�no spr�vn�
  else
  {
    #Vytvo�en� nov�ho �l�nku
    $dotaz ="INSERT INTO `db_easyapp`.`tbl_article` 
            (`id_article`, `language_id`, `user_id`, `title`, `article`) VALUES 
            (NULL, '$language', '".$_SESSION['id']."', '".$_POST['title']."', '".$_POST['text']."');";
    $result = $sql->query($dotaz);
    
    #Zji�t�n� zda li do�lo k chyb� z�pisu
    if (!$result) 
    {
      #Ukon�en� programu se zpr�vou
      printf("%s\n", $sql->error);
      exit();
    } 
    
    #Obnoven� strany
    fce_refresh();
  }
}

#Zji�t�n� zda se m� ulo�it �prava nov�ho �l�nku
elseif(isset($_POST['update']))
{    
  #P��prava prom�n�ch pro p��pad chybn�ho zad�n�
  $_POST['edit']=TRUE;
  
  #Zji�t�n� zda n�jak� pole je pr�zdn�
  if((empty($_POST['title'])) OR (empty($_POST['text'])))
  {
    #Vytvo�en� chybov� hl�ky
    $chyby.=$text[10];  
  }
  
  #Kdy� je v�e zad�no spr�vn�
  else
  {
    #�prava �l�nku v datab�zi   
    $dotaz ="UPDATE  `db_easyapp`.`tbl_article` SET  `title` =  '".$_POST['title']."',`article` =  '".$_POST['text']."' where `id_article`='".$_POST['id']."';";
    $result = $sql->query($dotaz);
    
    #Zji�t�n� zda li do�lo k chyb� �pravy
    if (!$result) 
    {
      #Ukon�en� programu se zpr�vou
      printf("%s\n", $sql->error);
      exit();
    }
    
    #Obnoven� strany
    fce_refresh();
  }
}

#Zji�t�n� zda m� b�t zobrazen �l�nek
if(isset($_POST['display']))
{
  #P��prava prom�n�ch pro vyps�n� obsahu
  $article="";
  
  #vyhled�n� �l�nku v datab�zi
  $query="SELECT * FROM `tbl_article` WHERE `id_article`='".$_POST['display']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  while($row = $result->fetch_assoc()) 
  {
    #P�ipraven� vlastnost� �l�nku
    $article.="<h3>".$row['title']."</h3>";
    $article.="<p>".$row['article']."</p>";
    
    #Vyhled�n� autora �l�nku v datab�zi
    $query="SELECT * FROM `tbl_user` WHERE `id_user`='".$row['user_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #P�ipaven� jm�na u�ivatele
      $article.="<p><b>".$text[7]."</b>".$row1['user']."</p>";
    }    
  }
  
  #vytvo�en� zp�tn�ho odkazu
  $article.="<a href='".$_SERVER['PHP_SELF']."'>".$text[8]."</a>";
}

#Zji�t�n� zda nem� doj�t k �prav� �l�nku
elseif(isset($_POST['edit']))
{
  #Vyhled�n� �l�nku v datab�zi
  $query="SELECT * FROM `tbl_article` WHERE `id_article`='".$_POST['edit']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  while($row = $result->fetch_assoc()) 
  {
    #Vytvo�en� formul��e pro �pravu �l�nku, z�rove� na�ten� text� �lanku a zp�tn�ho odkazu
    $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
    $article.="<label for='title'>".$text[4]."</label><input id='title' name='title' type='text' max-lenght='50' size='50' value='".$row['title']."'><br>";
    $article.="<textarea id='text' name='text' type='text' max-lenght='255' cols='50' rows='5'>";
    $article.=$row['article'];
    $article.="</textarea><br>";    
    $article.="<input name='id' type='hidden' value='".$_POST['edit']."'>";
    $article.="<button name='update'>".$text[2]."</button><br>";
    $article.="<button name='cancel'>".$text[8]."</button>";
    $article.="</form><br>";
  }
}

#Zji�t�n� zda nem� doj�t k vytvo�en� nov�ho �l�nku
elseif(isset($_POST['new']))
{
  #Vytvo�en� formul��e pro vytvo�en� nov�ho �l�nku a pokud ji� byly zad�na n�jak� data p�edem, tak jsou automaticky vypln�na
  $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
  $article.="<label for='title'>".$text[4]."</label><input id='title' name='title' type='text' max-lenght='50' size='50'";
  if(isset($_POST['title']))
  {
    $article.=" value='".$_POST['title']."'";
  } 
  $article.="><br>";
  $article.="<textarea id='text' name='text' type='text' max-lenght='255' cols='50' rows='5'>";
  if(isset($_POST['text']))
  {
    $article.=$_POST['text'];
  } 
  $article.="</textarea><br>";
  $article.="<button name='create'>".$text[9]."</button><br>";
  $article.="<button name='cancel'>".$text[8]."</button>";
  $article.="</form><br>";
}

#Kdy� nen� stanoven� ��dn� akce
else
{  
  #Vytvo�en� tabulky pro p�ehled �l�nk�
  $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>"; 
  $article.="<button name='new'>".$text[3]."</button>";  
  $article.="<table>";
  $article.="<tr>";
  $article.="<th>".$text[4]."</th>";
  $article.="<th>".$text[5]."</th>";
  $article.="<th>".$text[6]."</th>";
  $article.="</tr>";
  
  #Vyhled�n� vy�ech �l�nk� v datab�zi
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_article` WHERE `language_id`='".$language."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
	while($row = $result->fetch_assoc()) 
  {
    #za��tek ��dku a p�ipraven� dat �l�nku
    $article.="<tr>";
    $article.="<td>".$row['title']."</td>";
    
    #Vyhled�n� autora �l�nku
    $query="SELECT * FROM `tbl_user` WHERE `id_user`='".$row['user_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #P�ipraven� dat autora
      $article.="<td>".$row1['user']."</td>";
    }
    
    #Vyhled�n� jazyku �l�nku
    $query="SELECT * FROM `tbl_language` WHERE `id_language`='".$row['language_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #P�ipraven� dat o jazyku
      $article.="<td>".$row1['language']."</td>";
    }

    #P�ipraven� tla��tka pro zobrazen� �l�nku
    $article.="<td><button name='display' value='".$row['id_article']."'>".$text[1]."</button></td>"; 
    
    #Zji�t�n� zda je autor �l�nku pr�v� p�ihl�en� u�ivatel
    if($row['user_id']==$_SESSION['id'])
    {
      #P�ipraven� tla��tka pro �pravu �l�nku
      $article.="<td><button name='edit' value='".$row['id_article']."'>".$text[2]."</button></td>";
    } 
    
    #Ukon�en� ��dku
    $article.="</tr>";        
     	
	}
  #Ukon�en� tabulky pro p�ehled �l�nk�
  $article.="</form></table>";
}  
?>

<html>
  <head>                                     
    <meta charset="utf-8">
      <title>Easy app</title>
  </head>    
  <body>
    <?php 
      #V�ps�n� obsahu strany
      echo $article;
      
      #Zji�t�n� zda se vyskytly n�jak� chyby
      if(!empty($chyby))
      {
        #Vyps�n� chyb
        echo $chyby;
      }
    ?>        
  </body>
</html>  