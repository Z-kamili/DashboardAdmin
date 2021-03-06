<?php
require '../Database/database.php';
session_start();
if( $_SESSION["user"] == ""){
    header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ACCEUIL</title>
	<link rel="stylesheet" href="css/styles.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script  src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <link href="../app/img/logoadmin.png" rel="icon" type="image/png">
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
  </div>
  
  <div class="sidebar">
      <ul>
        <li><a href="#" class="active">
          <span class="icon"><i class="fas fa-home"></i></span>
          <span class="title">ACCEUIL</span></a></li>
        <li><a href="Personne/personne.php">
          <span class="icon"><i class="fas fa-user"></i></span>
          <span class="title">Management</span>
          </a></li>
        <!-- <li><a href="Patient/patient.php">
          <span class="icon"><i class="fas fa-address-card"></i></span>
          <span class="title">PATIENT</span>
          </a></li> -->
          <?php
          
          $db = Database::connect();
            $statement = $db->prepare("select * from utilisateur where emailUtilisateur   = ? ");
            $statement->execute(array($_SESSION["user"]));
            $item = $statement->fetch();
            Database::disconnect();
            if($item["roleUtilisateur"] == "Super admin"){
              echo '<li><a href="User/user.php">
              <span class="icon"><i class="fas fa-user"></i></span>
              <span class="title">User</span>
              </a></li>';
            }
          
          
          ?> 
  
        <li><a href="#" >
          <span class="icon"><i class="fas fa-project-diagram"></i></span>
          <span class="title">MAINTENANCE</span>
          </a></li>
        <li><a href="Loguot.php">
          <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
          <span class="title">DECONNECTER</span>
          </a></li>
          
    </ul>
  </div>
  
  <div class="main_container">
    <!-- <h1 class="title">Tbeb Lik</h1> -->
    <img src="img/undraw_Chatting_re_j55r (1).png" class="img">
  
  </div>
</div>
	
</body>
</html>