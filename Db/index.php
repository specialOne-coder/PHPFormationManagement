<?php
  try {
      $bd = new PDO("mysql:host=localhost;dbname=Gestion_Formation;charset:UTF8",'root','ferdio');
      $bd->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
      $bd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  } catch (\Throwable $th) {
      echo'Erreur'.$th;
  }

?>