<?php
session_start();
require_once '../includes/config.php';
include '../includes/header.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Récupérer les informations de l'utilisateur
$query = "SELECT * FROM users WHERE username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Récupérer les informations de la session de paiement (adaptées selon votre intégration Stripe)
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : null;

$purchase_date = date('Y-m-d H:i:s');

if ($session_id && !empty($_SESSION['cart'])) {
    // Insérer chaque produit du panier dans la table purchases
    $query = "INSERT INTO purchases (user_id, product_name, product_price, product_quantity, purchase_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    foreach ($_SESSION['cart'] as $productId => $item) {
        $stmt->bind_param('isdis', $user['id'], $item['name'], $item['price'], $item['quantity'], $purchase_date);
        $stmt->execute();
    }

    // Vider le panier après l'achat
    unset($_SESSION['cart']);
    unset($_SESSION['totalAmount']);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout - Success</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <main>
        <div>
            <h2>Paiment réussi</h2>
            <p>Merci pour votre achat !</p>
        </div>
    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>
