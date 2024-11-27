  <!-- Bouton de déconnexion -->
  <a href="index.php" class="deconnexion">Se déconnecter</a>

<div class="container">
    <!-- Partie Élève -->
    <div class="header">Partie élève:</div>
    <div class="subheader">
        Accueil:<br>
        Bienvenue <strong><?php echo isset($_SESSION['Slogin']) ? $_SESSION['Slogin'] : "Nom prénom"; ?></strong>
    </div>

    <div class="button-container">
        <a href="liste_cr.php" class="button">Liste compte rendus</a>
        <a href="creer_cr.php" class="button">Créer un compte rendu</a>
        <a href="commentaires.php" class="button">Commentaires</a>
    </div>
</div>