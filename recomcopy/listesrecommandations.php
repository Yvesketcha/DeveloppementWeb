<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données
// Récupérer les recommandations depuis la base de données
$query = "SELECT * FROM reco";
$recommandations = $link_mysql->query($query)->fetchAll();
$users = $_SESSION['users'];
$isAdmin = isset($users['admin']) && $users['admin'] == 1;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="styles/sidebar.css"> 
    <meta charset="UTF-8">
    <title>Liste des recommandations</title>
    <!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
		function toggleMenu(id) {
			var submenu = document.getElementById(id);
			submenu.style.display = submenu.style.display === "block" ? "none" : "block";
		}
    </script>
</head>
<body class="bg-light">

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
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Liste des recommandations</h2>
        
        <div class="row mb-3">
			<div class="col-md-6">
				<div class="dt-buttons btn-group">
					<button class="btn btn-outline-secondary">Copy</button>
					<button class="btn btn-outline-secondary">Excel</button>
					<button class="btn btn-outline-secondary">PDF</button>
					<button class="btn btn-outline-secondary">Print</button>
				</div>
			</div>
			<div class="col-md-6 text-end">
				<input type="search" class="form-control form-control-sm w-50 d-inline" placeholder="Recherche...">
			</div>
		</div>
        <table id="example" class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>URL</th>
                    <?php if ($isAdmin): ?><th>Actions</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recommandations as $rec): ?>
                <tr>
                    <td><?= htmlspecialchars($rec['nom']) ?></td>
                    <td><?= htmlspecialchars($rec['titre']) ?></td>
                    <td><?= htmlspecialchars($rec['description']) ?></td>
                    <td><a href="<?= htmlspecialchars($rec['url']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">Visiter</a></td>
                    <?php if ($isAdmin): ?>
                        <td>
                                <a href="modifierrecommandation.php?id_reco=<?= $rec['id_reco'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="supprimerecommandation.php" method="post" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recommandation ?')">
                                    <input type="hidden" name="id_reco" value="<?= $rec['id_reco'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                                <?php else: ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="Ajouterrecommandation.php" class="btn btn-success">Ajouter une recommandation</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>
</html>
