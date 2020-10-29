<?php 
 require '../../include/function.php';
 require '../../Database/database.php';
$status = false;
$isSuccess  = true;
$search = "";
$error = false;
$password = "";
     session_start();
     if( $_SESSION["user"] == null){
      header("Location:../Login.php");
     }else{
      if(!empty($_POST)){
       
        $status = true;
        $search = $_POST["name"];
      }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title>PARTIE Patient</title>
	<link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script  src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="../../app/img/logoadmin.png" rel="icon" type="image/png">
	<script>
		$(document).ready(function(){
			$(".hamburger").click(function(){
			   $(".wrapper").toggleClass("collapse");
			});
		});
	</script>
</head>
<body>

<div class="wrapper">
  <div class="top_navbar">
    <div class="hamburger">
       <div class="one"></div>
       <div class="two"></div>
       <div class="three"></div>
    </div>
    <div class="top_menu">
      <div class="logo"> </div>
      <form class="form" role="form" name="search" action="user.php" method="post">
      <ul>
        <li>
         
          <input type="text" placeholder="rechercher" name="name" id="search">
         
        </li>
       <li>
       <button type="submit" style="background-color:white;border:none;outline:none;"   >
       <a>
          <i class="fas fa-search"></i>
        
        </a> 
      </button>
          </li>
          <li><a href="user.php"> 
          <i class="fas fa-user"></i>
          </a></li>
      </ul>
      </form>
    </div>
  </div>
  
  <div class="sidebar">
  <ul>
        <li><a href="../index.php" >
          <span class="icon"><i class="fas fa-home"></i></span>
          <span class="title">ACCEUIL</span></a></li>
        <li><a href="../Personne/personne.php">
          <span class="icon"><i class="fas fa-user"></i></span>
          <span class="title">Management</span>
          </a></li>
           <?php
          $db = Database::connect();
            $statement = $db->prepare("select * from utilisateur where emailUtilisateur   = ? ");
            $statement->execute(array($_SESSION["user"]));
            $item = $statement->fetch();
            Database::disconnect();
            if($item["roleUtilisateur"] == "admin"){
              echo '<li><a href="#"  class="active">
              <span class="icon"><i class="fas fa-user"></i></span>
              <span class="title">User</span>
              </a></li>';
            }
          ?> 
        <li><a href="#" >
          <span class="icon"><i class="fas fa-project-diagram"></i></span>
          <span class="title">MAINTENANCE</span>
          </a></li>
        <li><a href="../Loguot.php">
          <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
          <span class="title">DECONNECTER</span>
          </a></li>
          
    </ul>
  </div>
  
  <div class="main_container">
    <!-- <h1 class="title">Tbeb Lik</h1> -->
    <div class="container admin">
    <div>
        <div class="row">
            
        <h1>Listes Personnel</h1>
       
          <a class="btn-main" href="AjouteUser.php" id="Ajoute">Ajouter</a>  <br>
 
          </div>
            <table class="table table-striped table-bordered">
  
            <thead>
                <tr>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody> 
            <tr>
            <?php
            $db = Database::connect();
            if($status){
              $statement = $db->prepare("select * from personnel where emailUtilisateur = ?");
              $statement->execute(array($search));
              while($item = $statement->fetch())
              {
                echo    '<tr>';
                echo    '<td>' . $item['emailUtilisateur'] .  '</td>';
                echo    '<td>' . $item['roleUtilisateur'] .  '</td>';
                echo   '<td width="300">';
                echo     '<a class="btn btn-danger" href="delete.php?id=' .$item['idUtilisateur'] . '"><span class="glyphicon glyphicon-remove"></span> delete </a>'; 
                echo    '</td>';
                
                echo '</tr>';    
                 
                  
              }
              }else{ 
              $statement = $db->query("select * from utilisateur LIMIT 10 ");
              while($item = $statement->fetch())
              {

             echo      '<tr>';
             echo    '<td>' . $item['emailUtilisateur'] .  '</td>';
             echo    '<td>' . $item['roleUtilisateur'] .  '</td>';
             echo   '<td width="300">';
             echo     '<a class="btn btn-danger" href="delete.php?id=' .$item['idUtilisateur'] . '"><span class="glyphicon glyphicon-remove"></span> delete </a>'; 
             echo    '</td>';
             
             echo '</tr>';     
              
                  
              }
            }         
              Database::disconnect();  
                
                
                ?>  
                        </tr>
                    
              
                
          
                
            </tbody>
            </table>
            
            
        </div>
        
        
        </div>
  </div>
</div>
<form class="bg-modal" action="" enctype="multipart/form-data" method="POST">
  <div class="modal-content2">
      <div class="close">+</div>
      <img src="../../app/img/Logo_vertical.svg"  class="LOGO" alt="logo">
      <div class="form">
        <input type="file" placeholder="fichier" name="result_file" class="entrer">
        <div class="erreur"></div>
        <!-- <input type="password" placeholder="Mot passe" name="mtp" class="entrer" onkeyup='this.value=this.value.toUpperCase()'>
        <div class="erreur"></div> -->
         <input class="button btn-main" name="upload_excel" type="submit" id="btnLogin" class="enter2" value="Ajouter">
      
  </div>
</div>
</form>
<!-- <script src="../javascript/file.js"></script> -->
</body>
</html>