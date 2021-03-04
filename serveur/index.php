<?php

require_once('../Db/index.php');

         if(isset($_POST['inscription'])){
                  $nameinscription = $_POST['nom'];
                  $numinscription = $_POST['num'];
                  $passwordinscription = $_POST['pass'];
                  $passwordconfirminscription = $_POST['conf'];
            if($nameinscription && $numinscription && $passwordinscription && $passwordconfirminscription){
                  if($passwordinscription == $passwordconfirminscription){
                    $inscription = $bd->prepare("INSERT INTO user(nom_user,numero_user,password_user) VALUES(?,?,?)");
                    $inscription->execute(array(
                    $nameinscription,$numinscription,$passwordinscription
                  ));
                  echo'<div class = "alert alert-success">inscription reussie  
                  <a href="../connection"><b>connectez-vous</b></a></div>';
                  }else{
                      echo'<div class = "alert alert-warning">les mots de passe ne sont pas les memes reessayer</div>';
                  }
            }else{
                echo'<div class = "alert alert-warning">Veuillez remplir tous les champs  et reessayer</div>';
            }
         }

?>