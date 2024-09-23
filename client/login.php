<?php 
include('../includes/server.php'); 
include('../includes/header.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Se connecter</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>


  <div class="form-container">
    <div class="form-header">
      <h2>Se connecter</h2>
    </div>
    <form method="post" action="login.php">
      <?php include('../includes/errors.php'); ?>
      <div class="input-group">
          <label>Email</label>
          <input type="email" name="email" required>
      </div>
      <div class="input-group">
        <label>Mot de passe</label>
        <input type="password" name="password" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
      </div>
      <p class="register-link">
        Pas encore membre? <a href="register.php">Inscrivez-vous</a>
      </p>
    </form>
  </div>
  <?php include '../includes/footer.php';?>
</body>
</html>
