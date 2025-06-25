<?php
session_start();
require_once "connexion.php"; // Connexion à la base de données

// Récupérer les recommandations depuis la base de données
$query = "SELECT * FROM users";
$utilisateurs = $link_mysql->query($query)->fetchAll();
$users = $_SESSION['users'];
$isAdmin = isset($users['admin']) && $users['admin'] == 1;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="styles/sidebar.css"> 
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
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
		<h2 class="mb-4 text-center">Liste des utilisateurs</h2>
		
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
					<th>Email</th>
					<th>Access</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($utilisateurs as $rec): ?>
				<tr>
					<td><?= htmlspecialchars($rec['username']) ?></td>
					<td><?= htmlspecialchars($rec['email']) ?></td>
					<td><?php if ($rec['admin'] == 1): ?>
						<span class="badge bg-danger">Administrateur</span>
						<?php else: ?>
						<span class="badge bg-success">Utilisateur</span>
						<?php endif; ?>
				</td>
					<td>
						<a href="modifierutilisateurs.php?id_user=<?= $rec['id_user'] ?>" class="btn btn-sm btn-warning">Modifier</a>
						<form action="supprimerutilisateurs.php" method="post" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recommandation ?')">
							<input type="hidden" name="id" value="<?= $rec['id_user'] ?>">
							<button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="text-center">
			<a href="Ajouterutilisateurs.php" class="btn btn-success">Ajouter un utilisateur</a>
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
			$('#example').DataTable({
				           language: {
                search: "Recherche :",
                lengthMenu: "Afficher _MENU_ éléments",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                },
                zeroRecords: "Aucun résultat trouvé",
            }
			});
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
