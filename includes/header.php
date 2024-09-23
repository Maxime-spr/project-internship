<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<header>
    <nav>
        <div class="logo">EPITAC</div>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="rendezvous.php">Prendre un rendez-vous</a></li>
                <li><a href="index.php?logout='1'">Se déconnecter</a></li>
            <?php else : ?>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="register.php">S'inscrire</a></li>
            <?php endif ?>
            <li><a href="contact.php">Contact</a></li>
            <li class="active"><a href="cart.php">Panier</a></li>
            <li id="search-icon">
                <a href="#"><i class="fa fa-search"></i></a> 
            </li>
        </ul>
        <!-- Formulaire de recherche -->
        <form method="GET" action="search.php" class="search-form">
            <input type="text" name="search" placeholder="Rechercher" required>
            <button type="submit">Rechercher</button>
        </form>
    </nav>
</header>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var searchIcon = document.getElementById('search-icon');
    var searchForm = document.querySelector('.search-form');

    searchIcon.addEventListener('click', function() {
      if (searchForm.style.display === 'flex') {
        searchForm.style.display = 'none';
      } else {
        searchForm.style.display = 'flex';
      }
    });
  });
</script>


