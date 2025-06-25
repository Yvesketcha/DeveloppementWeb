<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données

// Supprimer une recommandation
if (isset($_POST['id_user'])) {
    $	id_user = $_POST['id_user'];

    $stmt = $link_mysql->prepare("DELETE FROM users WHERE id_user = ?");
    $stmt->execute([id_user]);

    // Rediriger vers la page d'accueil après suppression
    header("Location: dashboard.php");
    exit();
} else {
    // Rediriger vers la page d'accueil si l'ID n'est pas spécifié
    header("Location: dashboard.php");
    exit();
}
?>
