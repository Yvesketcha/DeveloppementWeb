<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données

// Modifier une recommandation
if (isset($_POST['update'])) {
    // Récupérer les données du formulaire
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];
    // Préparer la requête pour mettre à jour la recommandation en toute sécurité
    $query = "UPDATE users SET username = ?, email = ?, admin = ? WHERE id_user = ?";
    $stmt = $link_mysql->prepare($query);

    // Exécuter la requête avec les valeurs sécurisées
    $stmt->execute([$username, $email, $admin, $id_user]);

    // Rediriger vers la page des utilisateurs apres modifications
    header("Location: listesutilisateurs.php");
    exit();
}

// Récupérer la recommandation à modifier
if (isset($_GET['id_user'])) {
    $id_user = intval($_GET['id_user']); // sécurisation de l'entrée

    // Préparer la requête pour récupérer la recommandation spécifique
    $query = "SELECT * FROM users WHERE id_user = ?";
    $stmt = $link_mysql->prepare($query);
    $stmt->execute([$id_user]);

    // Récupérer le résultat
    $rec = $stmt->fetch();

    if (!$rec) {
        header("Location: listesutilisateurs.php");
        exit();
    }
} else {
    header("Location: listesutilisateurs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier un utilisateur</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="modifierutilisateurs.php" class="p-4 border rounded bg-white shadow">
                <input type="hidden" name="id_user" value="<?= $rec['id_user'] ?>">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($rec['username']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($rec['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Access</label>
                    <input type="text" class="form-control" id="admin" name="admin" value="<?= htmlspecialchars($rec['admin']) ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary w-100">Mettre à jour</button>
            </form>
            <div class="text-center mt-3">
                <a href="listesutilisateurs.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
