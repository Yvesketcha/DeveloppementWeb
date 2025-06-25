<?php 
 
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // connexion
    require_once "connexion.php";
      
    // Recuperer les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
        
    // recherche si le user existe (par email)
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $link_mysql->prepare($sql);
    $stmt->execute([
      ':email' => $email
    ]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    var_dump($users);

    if (!$users) {
      header("Location:login.php?msg=Utilisateur non trouvé ! ");
      exit(0);
    }
    //check le password
    if(!password_verify($password, $users['password'])) {
      header("Location:login.php?msg=Mot de passe incorrect ! ");
      exit (0); 
    }

    // creation de la session 
    session_start();
    $_SESSION['users'] = $users;

    //redirection vers profile.php ou login avec le message d'erreur
    header('Location:dashboard.php');

  }

  $msg = isset($_GET['msg']) ? $_GET['msg'] : false;
  
?>
  <!DOCTYPE html>
  <head>
  <?php require_once "_header.php"; ?> 
  <link rel="stylesheet" href="styles/login.css"> 
</head>
<body>
  <?php require_once "_menu.php"; ?> 
  <div class="center mt-4">
    <a href="index.php"> 
    </a>
  </div>
  <h1>Se connecter</h1>
  
  <form action="" method="POST">
      <?php if ($msg) { ?>
        <div><?php echo $msg; ?></div>
      <?php } ?>
      <div class="mb-4">
        <label for="email">Adresse mail</label>
        <input type="email" name="email" id="email" /> 
      </div>          
      <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" /> 
      </div>
      <div>
        <input type="submit" />
      </div> 
      <a href="admin.php">Se connecter en tant qu'Administrateur</a>    
  </form>
</body>
</html>





