<?php
  session_start();
  // connexion
    require_once "connexion.php";

  // Exemple de session : dans un vrai site, ça vient du login
  // $_SESSION['user'] = ['username' => 'admin', 'is_admin' => 1];

  if (!isset($_SESSION['users'])) {
      // Redirection si l'utilisateur n'est pas connecté
      header('Location: login.php');
      exit();
}

$users = $_SESSION['users'];
$isAdmin = isset($users['admin']) && $users['admin'] == 1;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="stylesheet" href="styles/sidebar.css"> 
  <link rel="stylesheet" href="styles/users.css"> 
  <meta charset="UTF-8">
  <title>Sidebar sécurisée</title>
  <script>
    function toggleMenu(id) {
      var submenu = document.getElementById(id);
      submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    }
  </script>
</head>
<body>

  <div class="sidebar">
    <h2>Bonjour <?= htmlspecialchars($users['username']) ?></h2>

    <button class="menu-item" onclick="toggleMenu('menu1')">Mon compte</button>
    <div class="submenu" id="menu1">
      <a href="#">Profil</a>
      <a href="#">Paramètres</a>
    </div>

    <?php if ($isAdmin): ?>
      <button class="menu-item" onclick="toggleMenu('menu2')">Utilisateurs</button>
      <div class="submenu" id="menu2">
        <a href="listesutilisateurs.php">Liste des utilisateurs</a>
        <a href="#">Ajouter un utilisateur</a>
      </div>
    <?php endif; ?>

    <button class="menu-item" onclick="toggleMenu('menu3')">Recommandations</button>
    <div class="submenu" id="menu3">
      <a href="listesrecommandations.php">Liste des recommandations</a>
      <a href="Ajouterrecommandation">Ajouter une recommandation</a>
    </div>

    <a class="menu-item" href="logout.php">Déconnexion</a>
  </div>

  <div class="content">
    <?php include "AccueilR.php"; ?>
    <p>Contenu visible uniquement aux utilisateurs connectés.</p>
    <?php if ($isAdmin): ?>
      <p style="color: green;">Vous êtes administrateur.</p>
    <?php else: ?>
      <p style="color: orange;">Vous êtes un utilisateur standard.</p>
    <?php endif; ?>
  </div>

</body>
</html>