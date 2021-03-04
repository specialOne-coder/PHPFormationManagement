<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connectez-vous</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/moncss.css">
</head>
<body>
     
    <div class="containercon">
          <div class="buttonc">
             <button class="btn"><i class="fa fa-twitter"></i> Gestionnaire </button>
          </div>
          <div class="panel panel-body">     
          </div>
       <div class="formconnexion">
          <form method="post">
              <input type="text" name="username" id="nomcon" class="form-control" placeholder="Nom d'utilisateur" required> <br>
              <input type="password" name="passw" id="passcon" class="form-control" placeholder="mot de passe" required> <br>
              <a href="">mot de passe oublié? </a><br> <br>
              <div class="buttoncon">
                 <button class="btn btn-primary" name="btnconadmin" ><b>se connecter</b></button>
              </div> 
           </form>
      </div> <br><br><br>
        <a href="../inscription/"> <b> Vous n'avez pas de compte ? Demandez en un </b> </a> <br>
      
      <div id="message">
       <?php
        require_once('../Db/index.php');
      if(isset($_POST['btnconadmin'])){
        $nom = $_POST['username'];
        $pass = $_POST['passw'];
        $select = $bd->prepare("SELECT * FROM user");
        $select->execute();
         while($data = $select->fetch()){
                if($data['nom_user'] == $nom && $pass == $data['password_user']){
                   $_SESSION['name'] = $nom;
                   header('location:../principal');
                }else{
                 
                }
         }
         echo'<div class = "alert alert-danger"> Identifiant ou mot de passe incorrect </div>';
      }
       ?>
      </div>



   </div>


</body>
</html>