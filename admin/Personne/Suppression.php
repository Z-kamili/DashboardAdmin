<?php 
       require '../../Database/database.php';
       require '../../include/function.php';
session_start();
if( $_SESSION["user"] == null){
    header("Location:../Login.php");
}
$db = Database::connect();
$statement = $db->prepare("select * from utilisateur where emailUtilisateur   = ? ");
$statement->execute(array($_SESSION["user"]));
$item = $statement->fetch();
Database::disconnect();
if($item["roleUtilisateur"] != "admin" && $item["roleUtilisateur"] != "Super admin" ){
    header("Location:error.php");
}
if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);   
}
if(!empty($_POST)){
  $id = checkInput($_POST['id']);
  $db = Database::connect();
  $statement = $db->prepare("delete from personnel where idPersonnel = ?");
  $statement->execute(array($id));
  Database::disconnect();
  header("Location:personne.php");  
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Personnel</title>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="../../app/img/logoadmin.png" rel="icon" type="image/png">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type="text/css">
</head>
    <body>
        <div class="container admin">
            <div class="row">
            <h1> <strong>Supprimer un Personnel</strong> </h1>
                <br>
              <form class="form" role="form" action="Suppression.php" method="post"  enctype="multipart/form-data">
                  <p class="alert alert-warning">Etes vous de vouloir supprimer ?</p>
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
        <div class="form-actions">
    <button type="submit" class="btn btn-success" > Oui   </button>
   <a class="btn btn-primary" href="personne.php">Non</a>
            </div>
                </form>
            </div>        
        </div>
        
    
    </body>
    </html>