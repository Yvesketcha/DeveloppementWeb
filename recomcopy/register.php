<?php
   if ($_SERVER['REQUEST_METHOD'] == "POST") { //ECHO " FORM ENVOYE !";
      require_once "connexion.php";


        echo $_POST['username']. '<br />';
        echo $_POST['email']. '<br />';
        echo $_POST['password']. '<br />';   
    
       $sql = "INSERT INTO users (`username`,`email`, `password` )VALUES (:username, :email, :password)";

       $stmt = $link_mysql->prepare($sql);
       $stmt->execute([
            ':username' => $_POST['username'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        


       ]);
       // Redirection vers la page login 
       header('Location:login.php?msg=utilisateur bien créé !');



}

?>

<!DOCTYPE html>
<link rel="stylesheet" href="styles/register.css">
<?php  require_once "_header.php" ; ?>  
<body>
 <?php require_once "_menu.php"; ?> 
 <h1>Créer un compte </h1>
    <div class="inscrir">
    <form action="" method="POST">
       
        <div>
        <div>
            <label for="username">Username</label>
            <input type="username" name="username" id="username"/> 
        </div> 
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email"/> 
        </div>    
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password"/> 
        </div>    
    
        <div>
            <input type="submit" />
        </div>   
    
    </form>
</body>
</html>