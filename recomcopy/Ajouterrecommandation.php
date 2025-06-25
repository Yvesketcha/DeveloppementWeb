<?php
   if ($_SERVER['REQUEST_METHOD'] == "POST") { //ECHO " FORM ENVOYE !";
      require_once "connexion.php";


        echo $_POST['nom']. '<br />';
        echo $_POST['titre']. '<br />';
        echo $_POST['description']. '<br />';  
        echo $_POST['url']. '<br />';   
    
       $sql = "INSERT INTO reco (`nom`,`titre`, `description`, `url` )VALUES (:nom, :titre, :description, :url)";

       $stmt = $link_mysql->prepare($sql);
       $stmt->execute([
            ':nom' => $_POST['nom'],
            ':titre' => $_POST['titre'],
            ':description' => $_POST['description'],
            ':url' => $_POST['url']
       ]);
       // Redirection vers la page login 
       header("Location: listesrecommandations.php");
       exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une recommandation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Ajouter une recommandation</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post" class="p-4 border rounded bg-white shadow">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" name="url" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Ajouter</button>
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
