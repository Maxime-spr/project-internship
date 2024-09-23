<?php
session_start();
require_once 'config.php';

$username = "";
$email    = "";
$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Le nom d'utilisateur est requis"); }
  if (empty($email)) { array_push($errors, "L'email est requis"); }
  if (empty($password_1)) { array_push($errors, "Le mot de passe est requis"); }
  if ($password_1 != $password_2) {
    array_push($errors, "Les deux mots de passe sont différents");
  }

  $user_check_query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
  $stmt = $db->prepare($user_check_query);
  $stmt->bind_param('ss', $username, $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  
  if ($user) {
    if ($user['email'] === $email) {
      array_push($errors, "L'email existe déjà");
    }
  }

  if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES(?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $username, $email, $password);
    $stmt->execute();
    
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Vous êtes connecté";
    header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "L'email est requis");
  }
  if (empty($password)) {
    array_push($errors, "Le mot de passe est requis");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['username'] = $email;
      $_SESSION['success'] = "Vous êtes connecté";
      header('location: index.php');
    } else {
      array_push($errors, "Mauvaise combinaison email/mot de passe");
    }
  }
}
?>
