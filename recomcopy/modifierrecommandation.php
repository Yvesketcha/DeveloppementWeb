<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données

// Modifier une recommandation
if (isset($_POST['update'])) {
    // Récupérer les données du formulaire
    $id_reco = $_POST['id_reco'];
    $nom = $_POST['nom'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $url = $_POST['url'];

    // Préparer la requête pour mettre à jour la recommandation en toute sécurité
    $query = "UPDATE reco SET nom = ?, titre = ?, url = ?, description = ? WHERE id_reco = ?";
    $stmt = $link_mysql->prepare($query);

    // Exécuter la requête avec les valeurs sécurisées
    $stmt->execute([$nom, $titre, $url, $description, $id_reco]);

    // Rediriger vers la page des recommandations après la modification
    header("Location: listesrecommandations.php");
    exit();
}

// Récupérer la recommandation à modifier
if (isset($_GET['id_reco'])) {
    $id_reco = intval($_GET['id_reco']); // sécurisation de l'entrée

    // Préparer la requête pour récupérer la recommandation spécifique
    $query = "SELECT * FROM reco WHERE id_reco = ?";
    $stmt = $link_mysql->prepare($query);
    $stmt->execute([$id_reco]);

    // Récupérer le résultat
    $rec = $stmt->fetch();

    if (!$rec) {
        header("Location: listesrecommandations.php");
        exit();
    }
} else {
    header("Location: listesrecommandations.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une recommandation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier une recommandation</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="modifierrecommandation.php" class="p-4 border rounded bg-white shadow">
                <input type="hidden" name="id_reco" value="<?= $rec['id_reco'] ?>">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($rec['nom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="label" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="<?= htmlspecialchars($rec['titre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" name="url" value="<?= htmlspecialchars($rec['url']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($rec['description']) ?></textarea>
                </div>
<button type="submit" name="update" class="btn btn-primary w-100">Mettre à jour</button>
            </form>
            <div class="text-center mt-3">
                <a href="listesrecommandations.php" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
