<?php
  session_start();
  require_once('../Db/index.php');
  if(isset($_SESSION['name'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/moncss.css">
    <link rel="stylesheet" href="../css/principal.css">
</head>
<body>

<div class="container">

    <div class="jumbotron">
    <h2><p class="text-center" style="font-size: 35px;"> <b> Bienvenue sur le système de gestion de votre centre <?php echo $_SESSION['name']  ?></b> </p></h2> 
    <p class="text-center" style="font-size:12px;"> Vous pouvez maintenant gerer votre centre a partir de ces differents menus</p> <br>


<!--/*=========================================================
	  Recherche formation,formateur,etudiant
===========================================================*/-->

    <?php

  if(isset($_GET['chercheformodordelete'])){
    $formationrecherche = htmlspecialchars($_GET['chercheformodordelete']);
    $selectformationrecherche = $bd->prepare("SELECT * FROM formation WHERE titre like '%".$formationrecherche."%' ORDER BY id_formation DESC");
    $selectformationrecherche->execute();
  while($recherche = $selectformationrecherche->fetch()){
    echo'<h5><p class="text-center">'.$recherche['titre'].'</p></h5>';
   ?>
   <div class="btnmodel">
   <div class="butmodsup">
      <a href="?action=consultformation&amp;id=<?php echo $recherche['id_formation']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
      <a href="?action=modifyformation&amp;id=<?php echo $recherche['id_formation']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
      <a href="?action=deleteformation&amp;id=<?php echo $recherche['id_formation']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br>
    </div>
   </div>

  <?php
  }
}else if(isset($_GET['chercheformateurodordelete'])){
  $formationrecherche = htmlspecialchars($_GET['chercheformateurodordelete']);
  $selectformationrecherche = $bd->prepare("SELECT * FROM formateur WHERE nom_formateur like '%".$formationrecherche."%' ORDER BY id_formateur DESC");
  $selectformationrecherche->execute();
while($recherche = $selectformationrecherche->fetch()){
  echo'<h5><p class="text-center">'.$recherche['nom_formateur'].'</p></h5>';
 ?>
 <div class="btnmodel">
 <div class="butmodsup">
    <a href="?action=consultformateur&amp;id=<?php echo $recherche['id_formateur']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
    <a href="?action=modifyformateur&amp;id=<?php echo $recherche['id_formateur']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
    <a href="?action=deleteformateur&amp;id=<?php echo $recherche['id_formateur']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br>
  </div>
 </div>

<?php
}
}else if(isset($_GET['chercheetudiant'])){
  $formationrecherche = htmlspecialchars($_GET['chercheetudiant']);
  $selectformationrecherche = $bd->prepare("SELECT * FROM etudiant WHERE nom_etudiant like '%".$formationrecherche."%' ORDER BY id_etudiant DESC");
  $selectformationrecherche->execute();
while($recherche = $selectformationrecherche->fetch()){
  echo'<h5><p class="text-center">'.$recherche['nom_etudiant'].'</p></h5>';
 ?>
 <div class="btnmodel">
 <div class="butmodsup">
    <a href="?action=consultetudiant&amp;id=<?php echo $recherche['id_etudiant']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
    <a href="?action=modifyetudiant&amp;id=<?php echo $recherche['id_etudiant']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
    <a href="?action=deleteetudiant&amp;id=<?php echo $recherche['id_etudiant']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br>
  </div>
 </div>

<?php
}
 } 
?>

<!--/*=========================================================
	 Traitement formation
===========================================================*/-->
  <?php
      if(isset($_GET['action'])){
        if($_GET['action'] == 'formation'){
            echo '<br><br><br>';
  ?>
  <div class="btn">
    <a href="?action=nouvelleformation"><button class="buttoncat"><span> Nouvelle formation </span></button></a>
    <a href="?action=formateurs"><button class="buttonuser"><span> Formateurs</span></button></a>
    <a href="?action=formationexistante"><button class="button"><span> Nos formations</span></button></a>
      <br> <br> <br> <br><br>
 </div>
<!--/*=========================================================
	  Ajout de formation
===========================================================*/-->
   <?php
       }else if($_GET['action'] == 'nouvelleformation'){
         if(isset($_POST['submitaddformation'])){
           $titre = $_POST['titre'];
           $description = $_POST['descriptionform'];
           $formateur = $_POST['formateur'];
           $dated = $_POST['datedebut'];
           $datef = $_POST['datefin'];
           $prix = $_POST['prixform'];

           if($titre && $description && $formateur && $dated && $datef && $prix){
                $insertionformation = $bd->prepare("INSERT INTO formation(titre,description,formateur,date_debut,date_fin,prix) VALUES(?,?,?,?,?,?)");
                $insertionformation->execute(array(
                   $titre,$description,$formateur,$dated,$datef,$prix
                ));
             echo'<br> <div class ="alert alert-success"> Ajout de la formation reussie </div> <br>';
              }else{
             echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
           }
         }
   ?>
  <div class="btnd">
    <h4><p class="text-center">Ajouter une formation*</p></h4>
     <form action="" method="post">
      <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de la formation" maxlength="50" required>
       <textarea class="form-control" id="descid" name="descriptionform" placeholder="Decrivez la formation" rows="5" cols="30" required></textarea> <br>
       <div class="sel">
      <select name="formateur" id="selectid" class="form-control">
      <option value="Aucun">Nom du formateur</option>
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM formateur");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['nom_formateur']; ?>"><?php echo $values['nom_formateur']; ?></option>
      <?php
         }
      ?>
       </select> 
       </div> 
       <input type="date" class="form-control" name="datedebut" id="dd" required>
       <input type="date" class="form-control" name="datefin" id="df" required>
       <input type="number" name="prixform" id="prixid" class="form-control" placeholder="Coût de la formation" required>
     <div class="btnbutton"> <button type="submit"   name="submitaddformation" id="" class="btn btn-primary" value="" required> Ajouter la formation</button></div>  <br><br><br>
     </form>
  <div class="btn">
    <a href="?action=formationexistante"><button class="button"><span> Nos formations</span></button></a>
    <a href="?action=formateurs"><button class="buttonuser"><span> Formateurs</span></button></a>  <br> <br> <br> <br><br>
 </div>


 </div>
 <!--/*=========================================================
	  Modification et suppression des formations
===========================================================*/-->
  <?php 
       }else if($_GET['action'] == 'formationexistante'){
  ?>       
    <div class="searchbar">
      <div class="centrerform">
          <form  method="get" class="form-inline">
                    <div class="input-group">
                    <input type="search" class="form-control" name="chercheformodordelete" size="50" placeholder="cherchez pour supprimer ou modifier" required>
                    <div class="input-group-btn">
                    <button type="button" name="recherche" class="searchbtn"><i class="fa fa-search"></i></button>
                    </div>
                    </div>
           </form> 
        </div>
   </div> <br><br>
          
  <?php
          $selectformation = $bd->prepare("SELECT * FROM formation ORDER BY id_formation DESC");
          $selectformation->execute();
          while($data = $selectformation->fetch()){
  ?>
  <?php
            echo '<h5><p class="text-center"><b>'.$data['titre'].'</b></p></h5>';
  ?>
    <div class="btnmodel">
    <div class="butmodsup">
      <a href="?action=consultformation&amp;id=<?php echo $data['id_formation']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
      <a href="?action=modifyformation&amp;id=<?php echo $data['id_formation']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
      <a href="?action=deleteformation&amp;id=<?php echo $data['id_formation']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br><br>
    </div>
  </div>
  <?php
          }
  ?>
 <div class="btn">
    <a href="?action=nouvelleformation"><button class="buttoncat"><span> Nouvelle formation </span></button></a>
    <a href="?action=formateurs"><button class="buttonuser"><span> Formateurs</span></button></a>  <br> <br> <br> <br><br>
 </div>
<!--/*=========================================================
    Modification des formations
===========================================================*/-->
<?php
       }else if($_GET['action'] == 'consultformation'){
           $idcons = $_GET['id'];
           $consultform = $bd->prepare("SELECT * FROM formation WHERE id_formation = $idcons");
             $consultform->execute();
            while($data = $consultform->fetch()){
               $formationetudiant = $data['titre'];
               $selectetudiant = $bd->prepare("SELECT COUNT(nom_etudiant) as comptage FROM etudiant WHERE formation_etudiant = '$formationetudiant' ");
                 $selectetudiant->execute();
                 while($etudiant = $selectetudiant->fetch()){
                
?>
              <div class="panel panel-info" style="width:50%; margin:auto;">
                        <div class="panel-heading"> <h3> Informations de la formation </h3></div>
                        <div class="panel-body">
                           <p>Titre de la formation : <b><?php echo $data['titre']; ?></b></p>
                           <P>Formateur : <b><?php echo $data['formateur']; ?></b></P>
                           <p>Debut de la formation :<b> <?php echo $data['date_debut']; ?></b></p>
                           <p>Fin de la formation : <b><?php echo $data['date_fin']; ?></b></p>
                           <p>Coût de la formation : <b><?php echo $data['prix']; ?> fcfa</b></p>
                           <p>Nombre d'etudiants ayant fait l'inscription : <b><?php echo $etudiant['comptage']; ?></b></p>
                        </div>
                        <div class="panel-footer">
                         <a href="index.php?action=formationexistante"><button type="submit" class="btn btn-primary" name="valider" data-toggle="modal" data-target="#myModal">Retour</button></a>
                        </div>
                    </div> <br><br>
<?php
                 }
            }

       }else if($_GET['action'] == 'modifyformation'){
          $idform = $_GET['id'];
         $selectformamod = $bd->prepare("SELECT * FROM formation WHERE id_formation = $idform");
         $selectformamod->execute();
         while($data = $selectformamod->fetch()){
?>
  <div class="btnd">
    <h4><p class="text-center">Modifier une formation*</p></h4>
     <form action="" method="post">
      <input type="text" class="form-control" name="newtitre" id="titre" placeholder="Titre de la formation" maxlength="50" value="<?php echo $data['titre']; ?>" required>
       <textarea class="form-control" id="descid" name="newdescriptionform" placeholder="Decrivez la formation" rows="5" cols="30" value="<?php echo $data['description']; ?>" required><?php echo $data['description']; ?></textarea><br>
      <div class="sel">
      <select name="newformateur" id="selectid" class="form-control">
      <option value="<?php echo $data['formateur']?>"><?php echo $data['formateur'] ?> </option>
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM formateur");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['nom_formateur']; ?>"><?php echo $values['nom_formateur']; ?></option>
      <?php
         }
      ?>
       </select> 
       </div> 
       <input type="date" class="form-control" name="newdatedebut" id="dd" value="<?php echo $data['date_debut']; ?>" required>
       <input type="date" class="form-control" name="newdatefin" id="df" value="<?php echo $data['date_fin']; ?>" required>
       <input type="number" name="newprixform" id="prixid" class="form-control" placeholder="Coût de la formation" value="<?php echo $data['prix']; ?>" required>
     <div class="btnbutton"> <button type="submit"   name="submitmodifyform" id="" class="btn btn-primary"  required> Modifier la formation</button></div>  <br><br><br>
     </form>
 </div>



  <?php
    }
        if(isset($_POST['submitmodifyform'])){
          $newtitre = $_POST['newtitre'];
          $newdescription = $_POST['newdescriptionform'];
          $newformateur = $_POST['newformateur'];
          $newdated = $_POST['newdatedebut'];
          $newdatef = $_POST['newdatefin'];
          $newprix = $_POST['newprixform'];
          if($newtitre && $newdescription && $newformateur && $newdated && $newdatef && $newprix){
             $updateformation = $bd->prepare("UPDATE formation SET titre = ?,description = ?,formateur = ?,date_debut = ?,date_fin = ?,prix = ? WHERE id_formation = $idform");
             $updateformation->execute(array(
               $newtitre,$newdescription,$newformateur,$newdated,$newdatef,$newprix
             ));
              header('location:index.php?action=formationexistante');
          }else{
            echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
          }

        }
 ?>

<!--/*=========================================================
    Suppression des formations
===========================================================*/-->
 <?php

       }else if($_GET['action'] == 'deleteformation'){
        $idform = $_GET['id'];
        $suppressionformation = $bd->prepare("DELETE FROM formation WHERE id_formation = $idform");
        $suppressionformation->execute();
        header('location:index.php?action=formationexistante');

      }else if($_GET['action'] == 'formateurs'){
  ?>
  <div class="btn">
    <a href="?action=nouveauformateur"><button class="buttoncat"><span> Nouveau formateur</span></button></a>
    <a href="?action=nosformateurs"><button class="buttonuser"><span>Nos formateurs </span></button></a>  <br> <br> <br> <br><br>
  </div>
  <div class="btn">
    <a href="?action=nouvelleformation"><button class="but"><span> Nouvelle formation </span></button></a>
    <a href="?action=formationexistante"><button class="but"><span> Nos formations</span></button></a> <br><br><br>
 </div>
  <?php    
      }else if($_GET['action'] == 'nouveauformateur'){
        if(isset($_POST['submitaddformateur'])){
          $nomf = $_POST['nomf'];
          $prenomf = $_POST['prenomf'];
          $specf = $_POST['specf'];
           if($nomf && $prenomf && $specf){
             $insertformateur = $bd->prepare("INSERT INTO formateur (nom_formateur,prenom_formateur,spec) VALUES(?,?,?)");
             $insertformateur->execute(array(
               $nomf,$prenomf,$specf
             ));
            echo'<br> <div class ="alert alert-success"> Ajout du formateur reussie </div> <br>';
           }else{
            echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
           }

        }
  ?>
      <div class="btnd">
    <h4><p class="text-center">Ajouter un formateur*</p></h4>
     <form action="" method="post">
      <input type="text" class="form-control" name="nomf" id="titre" placeholder="Nom du formateur" maxlength="50" required>
      <input type="text" class="form-control" name="prenomf" id="titre" placeholder="Prénom du formateur" maxlength="25" required>
      <input type="text" class="form-control" name="specf" id="titre" placeholder="Spécialité du formateur" maxlength="50" required>
     <div class="btnbutton"> <button type="submit"   name="submitaddformateur" id="" class="btn btn-primary" value="" required> Ajouter le formateur</button></div>  <br><br><br>
     </form>
 </div>
 <div class="btn">
 <a href="?action=nosformateurs"><button class="buttonuser"><span>Nos formateurs </span></button></a>
 </div>
  <?php
      }else if($_GET['action'] == 'nosformateurs'){
  ?>
        <div class="searchbar">
      <div class="centrerform">
          <form  method="get" class="form-inline">
                    <div class="input-group">
                    <input type="search" class="form-control" name="chercheformateurodordelete" size="50" placeholder="cherchez pour supprimer ou modifier" required>
                    <div class="input-group-btn">
                    <button type="button" name="recherchef" class="searchbtn"><i class="fa fa-search"></i></button>
                    </div>
                    </div>
           </form> 
        </div>
   </div> <br><br>

  <?php
         $selectformateur = $bd->prepare("SELECT * FROM formateur");
           $selectformateur->execute();
           while($data = $selectformateur->fetch()){
            echo '<h5><p class="text-center"><b>'.$data['nom_formateur'].'</b></p></h5>';
  ?>
               <div class="btnmodel">
    <div class="butmodsup">
      <a href="?action=consultformateur&amp;id=<?php echo $data['id_formateur']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
      <a href="?action=modifyformateur&amp;id=<?php echo $data['id_formateur']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
      <a href="?action=deleteformateur&amp;id=<?php echo $data['id_formateur']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br>
    </div> <br>
  </div>
  <?php
           }
  ?>
  <div class="btn">
<a href="?action=nouvelleformation"><button class="buttonuser"><span> Nouvelle formation </span></button></a> <br><br>
</div>
  <?php
          }else if($_GET['action'] == 'consultformateur'){
            $idcons = $_GET['id'];
            $consultform = $bd->prepare("SELECT * FROM formateur WHERE id_formateur = $idcons");
              $consultform->execute();
             while($data = $consultform->fetch()){
 ?>
               <div class="panel panel-info" style="width:50%; margin:auto;">
                         <div class="panel-heading"> <h3> Informations de la formation </h3></div>
                         <div class="panel-body">
                            <p>Nom du formateur : <b><?php echo $data['nom_formateur']; ?></b></p>
                            <P>Prenom du formateur : <b><?php echo $data['prenom_formateur']; ?></b></P>
                            <p>Spécialité du formateur :<b> <?php echo $data['spec']; ?></b></p>
                         </div>
                         <div class="panel-footer">
                          <a href="index.php?action=nosformateurs"><button type="submit" class="btn btn-primary" name="valider" data-toggle="modal" data-target="#myModal">Retour</button></a>
                         </div>
                     </div> <br><br>
 <?php
             }
 
        }else if($_GET['action'] == 'modifyformateur'){
           $idform = $_GET['id'];
          $selectformamod = $bd->prepare("SELECT * FROM formateur WHERE id_formateur = $idform");
          $selectformamod->execute();
          while($data = $selectformamod->fetch()){
 ?>
   <div class="btnd">
     <h4><p class="text-center">Modifier un formateur*</p></h4>
      <form action="" method="post">
      <input type="text" class="form-control" name="newnameformateur" id="titre" placeholder="Titre de la formation" maxlength="50" value="<?php echo $data['nom_formateur']; ?>" required>
      <input type="text" class="form-control" name="newprenomformateur" id="titre" placeholder="Nom du formateur" maxlength="25" value="<?php echo $data['prenom_formateur']; ?>" required>
      <input type="text" class="form-control" name="newspecformateur" id="titre" placeholder="Nom du formateur" maxlength="25" value="<?php echo $data['spec']; ?>" required>
      <div class="btnbutton"> <button type="submit"   name="submitmodifyformateur" id="" class="btn btn-primary"  required> Modifier la formation</button></div>  <br><br><br>
      </form>
  </div>
 
 
 
   <?php
     }
         if(isset($_POST['submitmodifyformateur'])){
           $newnfor = $_POST['newnameformateur'];
           $newprefor = $_POST['newprenomformateur'];
           $newspecfor = $_POST['newspecformateur'];
           if($newnfor && $newprefor && $newspecfor){
              $updateformation = $bd->prepare("UPDATE formateur SET nom_formateur = ?,prenom_formateur = ?,spec = ? WHERE id_formateur = $idform");
              $updateformation->execute(array(
                $newnfor,$newprefor,$newspecfor
              ));
               header('location:index.php?action=nosformateurs');
           }else{
             echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
           }
 
         }
  ?>
 
 <!--/*=========================================================
     Suppression des formateurs
 ===========================================================*/-->
  <?php
 
        }else if($_GET['action'] == 'deleteformateur'){
         $idform = $_GET['id'];
         $suppressionformation = $bd->prepare("DELETE FROM formateur WHERE id_formateur = $idform");
         $suppressionformation->execute();
         header('location:index.php?action=nosformateurs');
  ?>
<!--/*=========================================================
    Etudiant
===========================================================*/-->
  <?php
      }else if($_GET['action'] == 'etudiant'){
        
  ?>
   <div class="btn">
     <a href="?action=ajoutetudiant"><button class="buttoncat"><span>Ajouter un etudiant</span></button></a>
     <a href="?action=nosetudiants"><button class="buttonuser"><span> Liste des etudiants </span></button></a>  <br> <br> <br> <br><br>
  </div>

  <?php
        }else if($_GET['action'] == 'ajoutetudiant'){
          if(isset($_POST['submitaddetudiant'])){
            $nomEtudiant = $_POST['nometudiant'];
            $prenomEtudiant = $_POST['prenometudiant'];
            $formationsuivie = $_POST['formationasuivre'];
            $ageEtudiant = $_POST['ageetudiant'];
 
            if($nomEtudiant && $prenomEtudiant && $formationsuivie && $ageEtudiant){
                 $insertionetudiant = $bd->prepare("INSERT INTO etudiant(nom_etudiant,prenom_etudiant,formation_etudiant,age_etudiant) VALUES(?,?,?,?)");
                 $insertionetudiant->execute(array(
                    $nomEtudiant,$prenomEtudiant,$formationsuivie,$ageEtudiant
                 ));
              echo'<br> <div class ="alert alert-success"> Ajout de l\'etudiant reussie </div> <br>';
               }else{
              echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
            }
          }
  ?>
  <div class="btnd">
    <h4><p class="text-center">Ajouter un etudiant*</p></h4>
     <form action="" method="post">
      <input type="text" class="form-control" name="nometudiant" id="titre" placeholder="Nom de l'etudiant" maxlength="50" required>
      <input type="text" class="form-control" name="prenometudiant" id="titre" placeholder="Prenom de l'etudiant" maxlength="50" required>
      <input type="number" name="ageetudiant" id="prixid" class="form-control" placeholder="Âge" required> <br>
       <div class="sel">
      <select name="formationasuivre" id="selectid" class="form-control">
      <option value="Aucun">Formations </option>
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM formation");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['titre']; ?>"><?php echo $values['titre']; ?></option>
      <?php
         }
      ?>
       </select> 
       </div> 
     <div class="btnbutton"> <button type="submit"   name="submitaddetudiant" id="" class="btn btn-primary" value="" required> Ajouter l'etudiant</button></div>  <br><br><br>
     </form>
     <div class="btn">
        <a href="?action=nosetudiants"><button class="buttonuser"><span> Liste des etudiants </span></button></a>  <br> <br> <br> <br><br>
     </div>
  <div class="btn">
    <a href="?action=formationexistante"><button class="button"><span> Nos formations</span></button></a>
    <a href="?action=formateurs"><button class="buttonuser"><span> Formateurs</span></button></a>  <br> <br> <br> <br><br>
 </div>


 </div>
  <?php
         
    }else if($_GET['action'] == 'nosetudiants'){
?>
      <div class="searchbar">
    <div class="centrerform">
        <form  method="get" class="form-inline">
                  <div class="input-group">
                  <input type="search" class="form-control" name="chercheetudiant" size="50" placeholder="cherchez pour supprimer ou modifier" required>
                  <div class="input-group-btn">
                  <button type="button" name="recherchef" class="searchbtn"><i class="fa fa-search"></i></button>
                  </div>
                  </div>
         </form> 
      </div>
 </div> <br><br>

<?php
       $selectformateur = $bd->prepare("SELECT * FROM etudiant");
         $selectformateur->execute();
         while($data = $selectformateur->fetch()){
          echo '<h5><p class="text-center"><b>'.$data['nom_etudiant'].'</b></p></h5>';
?>
<div class="btnmodel">
  <div class="butmodsup">
    <a href="?action=consultetudiant&amp;id=<?php echo $data['id_etudiant']; ?>"> <button class="consultationbtn"><i class="fa fa-eye"></i>  Consulter</button></a> 
    <a href="?action=modifyetudiant&amp;id=<?php echo $data['id_etudiant']; ?>"> <button class="modificationbtn"><i class="fa fa-pencil"></i>  Modifier</button></a>
    <a href="?action=deleteetudiant&amp;id=<?php echo $data['id_etudiant']; ?>"> <button class="suppressionbtn"><i class="fa fa-trash"></i> Supprimer </button></a>  <br><br>
  </div>
</div>
<?php
         }


        }else if($_GET['action'] == 'consultetudiant'){
          $idcons = $_GET['id'];
          $consultform = $bd->prepare("SELECT * FROM etudiant WHERE id_etudiant = $idcons");
            $consultform->execute();
           while($data = $consultform->fetch()){
?>
             <div class="panel panel-info" style="width:50%; margin:auto;">
                       <div class="panel-heading"> <h3> Informations de l'etudiant </h3></div>
                       <div class="panel-body">
                          <p>Nom de l'etudiant : <b><?php echo $data['nom_etudiant'];?></b></p>
                          <P>Prenom de l'etudiant : <b><?php echo $data['prenom_etudiant']; ?></b></P>
                          <p>Age de l'etudiant :<b> <?php echo $data['age_etudiant']; ?> ans</b></p>
                          <p>Formation :<b> <?php echo $data['formation_etudiant']; ?></b></p>
                       </div>
                       <div class="panel-footer">
                        <a href="index.php?action=nosetudiants"><button type="submit" class="btn btn-primary" name="valider" data-toggle="modal" data-target="#myModal">Retour</button></a>
                       </div>
                   </div> <br><br>
<?php
           }

      }else if($_GET['action'] == 'modifyetudiant'){
         $idform = $_GET['id'];
        $selectformamod = $bd->prepare("SELECT * FROM etudiant WHERE id_etudiant = $idform");
        $selectformamod->execute();
        while($data = $selectformamod->fetch()){
?>
 <div class="btnd">
   <h4><p class="text-center">Modifier un formateur*</p></h4>
    <form action="" method="post">
    <input type="text" class="form-control" name="newnameetudiant" id="titre" placeholder="Titre de la formation" maxlength="50" value="<?php echo $data['nom_etudiant']; ?>" required>
    <input type="text" class="form-control" name="newprenometudiant" id="titre" placeholder="Nom du formateur" maxlength="25" value="<?php echo $data['prenom_etudiant']; ?>" required>
    <input type="text" class="form-control" name="newageetudiant" id="titre" placeholder="Nom du formateur" maxlength="25" value="<?php echo $data['age_etudiant']; ?>" required> <br>
    <div class="sel">
      <select name="newformation" id="selectid" class="form-control">
      <option value="<?php echo $data['formation_etudiant']?>"><?php echo $data['formation_etudiant'] ?> </option>
       <?php
         $reqselcat = $bd->prepare("SELECT * FROM formation");
         $reqselcat->execute();
         while($values = $reqselcat->fetch()){
       ?>
         <option value="<?php echo $values['titre']; ?>"><?php echo $values['titre']; ?></option>
      <?php
         }
      ?>
       </select> 
       </div> 
    <div class="btnbutton"> <button type="submit"   name="submitmodifyetudiant" id="" class="btn btn-primary"  required> Modifier la formation</button></div>  <br><br><br>
    </form>
</div>



 <?php
   }
       if(isset($_POST['submitmodifyetudiant'])){
         $newnnomEt = $_POST['newnameetudiant'];
         $newpreEt = $_POST['newprenometudiant'];
         $newageEt = $_POST['newageetudiant'];
         $newformation = $_POST['newformation'];
         if($newnnomEt && $newpreEt && $newageEt && $newformation){
            $updateformation = $bd->prepare("UPDATE etudiant SET nom_etudiant = ?,prenom_etudiant = ?,age_etudiant = ?,formation_etudiant = ? WHERE id_etudiant = $idform");
            $updateformation->execute(array(
              $newnnomEt,$newpreEt,$newageEt,$newformation
            ));
             header('location:index.php?action=nosetudiants');
         }else{
           echo'<br> <div class ="alert alert-warning"> Veuillez remplir tous les champs et reessayer </div> <br>';
         }

       }
?>

<!--/*=========================================================
   Suppression des formateurs
===========================================================*/-->
<?php

      }else if($_GET['action'] == 'deleteetudiant'){
       $idform = $_GET['id'];
       $suppressionformation = $bd->prepare("DELETE FROM etudiant WHERE id_etudiant = $idform");
       $suppressionformation->execute();
       header('location:index.php?action=nosetudiants');
?>
  <?php
      }
    }
  ?>

<!--/*=========================================================
	 Principal
===========================================================*/-->
        <div class="btn">
          <a href="?action=formation"><button class="button"><span> Gestions des formations</span></button></a>
          <a href="?action=etudiant"><button class="buttoncat"><span> Gestion des etudiants </span></button></a> <br> <br> <br><br>
          <a href="decon.php"><button class="buttondec" name="decon"><span> Deconnexion </span></button></a> <br> <br> <br>

        </div>
    </div>
        
</div> 
</body>
</html>
<?php
}else{
    header('location:../connection');
}
?>