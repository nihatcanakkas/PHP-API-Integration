<?php
  
try{
     $db = new PDO("mysql:host=localhost; dbname=izle;  charset = utf-8", 'root','');
     //echo "veri tabanı baglandı";
}

catch(PDOException $e)
{
    echo $e->getMessage();

}
?>

