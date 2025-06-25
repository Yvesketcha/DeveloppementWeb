<?php session_start();
   require_once "connexion.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

}
    $sql = "SELECT * FROM users";
   $stmt = $link_mysql->prepare($sql);
   $stmt->execute();


   $users = $stmt->fetch(PDO::FETCH_ASSOC);

  
   ;

?>





<!DOCTYPE html>
<link rel="stylesheet" href="styles/register.css">
 <?php require_once "_header.php"; ?>  
 <body>
 <?php require_once "_menu.php"; ?> 
 <link rel="stylesheet" href="styles/users.css">
 <div class="inscrir">
    <h1>Bienvenue à PARIS</h1>
    <h2> le top 5 des nos recommandations touristiques de Capitale</h2>
  </div>
 <div class="itineraire">
    <div class="image">
      <a href="login.php"><img src="Images/eiffel.jpg" alt="latour"></a>
      <p>La tour Eiffel</p>
      
    </div>
    <div class="image">
      <a href="login.php"><img src="Images/louvre.jpg" alt="louvre"></a>
      <p>Musée du louvre</p>
      
    </div>
    <div class="image">
      <a href="login.php"><img src="Images/notredame.jpeg" alt="notre"></a>
      <p>Notre-Dame de Paris</p>
      
    </div>
    <div class="image">
      <a href="login.php"><img src="Images/arc.jpeg" alt="arche"></a>
      <p>L'Arche de Triomphe </p>
      
    </div>
    <div class="image">
      <a href="login.php"><img src="Images/orsay.jpg" alt="orsay"></a>
      <p>Musée d'Orsay</p>
      
    </div>
    </div>
    </body>
    </html>
    
