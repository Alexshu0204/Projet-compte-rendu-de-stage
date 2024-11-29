  <!-- Bouton de déconnexion -->
  <a href="index.php" class="deconnexion">Se déconnecter</a>

<div class="container">
    <!-- Partie prof -->
    <div class="header">Partie prof:</div>
    <div class="subheader">
        Accueil:<br>
        Bienvenue <strong><?php echo isset($_SESSION['Slogin']) ? $_SESSION['Slogin'] : "Nom prénom"; ?></strong>
    </div>

    <div class="button-container">
        <a href="prof_regarde_liste_cr.php" class="button">Liste comptes rendus</a>
        <a href="commentaires_du_prof.php" class="button">Vos commentaires</a>
    </div>
</div>