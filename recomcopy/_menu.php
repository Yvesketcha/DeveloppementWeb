<link rel="stylesheet" href="styles/main.css">
<nav>
    <ul>
        <li>
            <a href="Accueil.php">Accueil</a>
        </li>
    </ul>
    <ul>
        <?php if(isset($_SESSION['user'])) { ; ?>
        <li>
        <a href="profile.php">Mon profile</a>
    </li>
    <li>
        <a href="logout.php">Se deconnecter</a>
    </li>

      <?php  } else { ?>
        <li>
            <a href="register.php">S'inscrire</a>
        </li>
        <li>
            <a href="Login.php">Se connecter</a>
        </li>
        <?php }; ?>
    </ul>
</nav>