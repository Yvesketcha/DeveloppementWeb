<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données

// Supprimer une recommandation
if (isset($_POST['id_reco'])) {
    $id_reco = $_POST['id_reco'];

    $stmt = $link_mysql->prepare("DELETE FROM reco WHERE id_reco = ?");
    $stmt->execute([id_reco]);

    // Rediriger vers la page d'accueil après suppression
    header("Location: dashboard.php");
    exit();
} else {
    // Rediriger vers la page d'accueil si l'ID n'est pas spécifié
    header("Location: dashboard.php");
    exit();
}
?>
