<?php
    require '../../include/function.php';
    require '../../Database/database.php';
     $Nom = $Prenom = $CIN  = $Telephone =  $DateNaissence = $Departement = $macBracelet = $point = $online  = $NomError = $PrenomError = $CINError  = $TelephoneError =  $DateNaissenceError = $DepartementError = $macBraceletError = $pointError = $onlineError  = $statement = $num =  "";
     $isSuccess  = $status =  true;
     $error = null;
     $p = "";
     session_start();
     if( $_SESSION["user"] == null){
        header("Location:../Login.php");
     }else{

        $db = Database::connect();
            $statement = $db->prepare("select * from utilisateur where emailUtilisateur   = ? ");
            $statement->execute(array($_SESSION["user"]));
            $item = $statement->fetch();
            Database::disconnect();
            if($item["roleUtilisateur"] != "admin" && $item["roleUtilisateur"] != "Super admin" ){
                header("Location:error.php");
            }
        if(!empty($_GET['id'])){
            $id = $_GET['id'];  
        }
         if(!empty($_POST)){
            $num = 0;
           $Nom = checkInput($_POST['NOM']);
           $Prenom  = checkInput($_POST['Prenom']);
           $CIN = checkInput($_POST['CIN']);
           $Telephone = checkInput($_POST['Telephone']);
           $DateNaissence = checkInput($_POST['DateNaissence']);
           $Departement =  checkInput($_POST['Departement']);
           $macBracelet  =  checkInput($_POST['macBracelet']);
           $point  =  checkInput($_POST['point']);
           $online  =  checkInput($_POST['online']);
           if(empty($Nom)){
            $NomError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($Prenom)){
            $PrenomError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($CIN)){
            $CINError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($Telephone)){
            $TelephoneError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }

           if(empty($DateNaissence)){
            $DateNaissenceError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($macBracelet)){
            $macBraceletError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($Departement)){
            $DepartementError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if(empty($point)){
            $pointError = "ce champ ne peut pas etre vide";
            $isSuccess = false;
           }
           if($online == "True"){
               $num = 1;
            
           }else{
            $num = 0;
           }
           
          
    if($isSuccess){
        $status = false;
        try{
            $db = Database::connect();
            $statement = $db->prepare("Update personnel set cinPersonnel = ?,nomPersonnel = ?,prenomPersonnel = ?,telPersonnel = ?,dateNaisPersonnel = ?,departementPersonnel = ?, macBracelet = ?,pointsPersonnel = ?,onlinePersonnel = ?  where  idPersonnel = ?");
            $id = $_POST["id"];
            if($online == "True"){
                $num = 1;
            }else{
                $num = 0;
            }
            $statement->execute([$CIN,$Nom,$Prenom,$Telephone,$DateNaissence,$Departement,$macBracelet,$point,$num,$id]);     
            $status = true;
        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        Database::disconnect();  
        if($status){
            header("Location:personne.php");
        } 
    }
         }else{
            $db = Database::connect();
            $statement = $db->prepare("select * from personnel where idPersonnel = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $CIN = $item['cinPersonnel'];
            $Nom = $item['nomPersonnel'] ;
            $Prenom = $item['prenomPersonnel'];
            $CIN = $item["cinPersonnel"];
            $Telephone = $item['telPersonnel'];
            $DateNaissence = $item["dateNaisPersonnel"];
            $Departement = $item['departementPersonnel'];
            $macBracelet = $item['macBracelet'];
            $point = $item['pointsPersonnel'];
            $online = $item['onlinePersonnel'];
            Database::disconnect();
         }
     }
?>

<!DOCTYPE html>
<html>
<head>
<title>ADMIN</title>
    <meta charset="utf-8">
    <style><?php file_get_contents("css_file.css");?></style>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="../css/style2.Css">
 <link href="../../app/img/logoadmin.png" rel="icon" type="image/png">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type="text/css">
</head>
    <body>
        <div class="container admin" >
        <!-- <a href="../../index.php">
                <img src="../../app/img/Logo_vertical.svg" class="LOGO" alt="logo">
        </a> -->
        <div class="row" style="margin-top:131px;">
                <br>
            <form class="form" action="Modifier.php" enctype="multipart/form-data" id="formulaire" method="post">
            <h1><strong>Modifier  un  Personnel</strong></h1>
            <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="NOM"  id="name" placeholder="Nom"   value="<?php echo $Nom; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $NomError; ?>
                </span>                
                </div>  
                <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="Prenom"  id="Prenom" placeholder="Prenom"   value="<?php echo $Prenom; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $PrenomError; ?>
                </span>                
                </div> 
                <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="CIN"  id="CIN" placeholder="CIN"   value="<?php echo $CIN ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $CINError; ?>
                </span>                
                </div> 
                <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="Telephone"  id="Telephone" placeholder="Telephone"   value="<?php echo $Telephone; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $TelephoneError; ?>
                </span>                
                </div> 
                <div class="form-group" enctype="multipart/form-data">
                <input type="date" name="DateNaissence"  id="DateNaissence" placeholder="DateNaissence"   value="<?php echo $DateNaissence; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $DateNaissenceError; ?>
                </span>                
                </div> 
                <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="Departement"  id="Departement" placeholder="Departement"   value="<?php echo $Departement; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $DepartementError; ?>
                </span>                
                </div> 
                <div class="form-group" enctype="multipart/form-data">
                <input type="text" name="macBracelet"  id="macBracelet" placeholder="macBracelet"  value="<?php echo $macBracelet; ?>">
                <span class="help-inline"  style="color:red"> 
                <?php echo $macBraceletError; ?>
                </span>                
                </div>  
                <div class="form-group" enctype="multipart/form-data">
                <input type="number" name="point"  id="point" placeholder="point"  value="<?php echo $point; ?>">   
                <span class="help-inline"  style="color:red"> 
                <?php echo $pointError; ?>
                </span>            
                </div>  
                <div class="form-group" enctype="multipart/form-data">
                <input type="hidden" name="id"  id="point" placeholder="point"  value="<?php echo $id; ?>">   
                <span class="help-inline"  style="color:red"> 
                <?php echo $pointError; ?>
                </span>            
                </div>  
                <div class="form-group" enctype="multipart/form-data">
              <label>Online</label>
                <select name="online"  id="online" placeholder="online">
                    <?php
                    
                    if($online == 1){
echo '<option value="True">True</option>';
echo '<option value="False">False</option>';
                    }else{

echo '<option value="False">False</option>';
echo '<option value="True">True</option>';

                    }
                    ?>
                    <!-- <option value="False">False</option> -->
                </select>
                <span class="help-inline"  style="color:red"> 
                <?php echo $onlineError; ?>
                </span>                
                </div>      
            <br>
            
            <div class="form-actions">
            
            <button type="submit" class="btn btn-success" > <span class="glyphicon glyphicon-pencil"></span>Modifier</button>
            <a class="btn btn-primary" href="personne.php"> <span class="glyphicon glyphicon-arrow-left"></span>Retour</a>            
            </div>
                 </form>
               
            
            
            
       
            
           
            
        </div>
        
        
        </div>
    
        <!-- <div id="footer">
            <span>@Copyright 2020. All right reserved.</span>
        </div> -->
    
    </body>
</html>