<?php 
include('../includes/server.php'); 
include('../includes/header.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>S'inscrire</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

  <div class="form-container">
    <div class="form-header">
      <h2>S'inscrire</h2>
    </div>
    <form method="post" action="register.php">
      <?php include('../includes/errors.php'); ?>
      <div class="input-group">
        <label>Nom</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
      </div>
      <div class="input-group">
        <label>Mot de passe</label>
        <input type="password" name="password_1" required>
      </div>
      <div class="input-group">
        <label>Confirmer le mot de passe</label>
        <input type="password" name="password_2" required>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">S'inscrire</button>
      </div>
      <p class="register-link">
        Déjà membre? <a href="login.php">Connectez-vous</a>
      </p>
    </form>
  </div>
  <?php include '../includes/footer.php';?>
</body>
</html>
