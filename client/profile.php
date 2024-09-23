<?php
session_start();
require_once '../includes/config.php';
include '../includes/header.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Vous devez vous connecter d'abord";
    header('location: login.php');
    exit();
}
$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Récupération de l'historique des achats de l'utilisateur
$query_history = "SELECT * FROM purchases WHERE user_id=? ORDER BY purchase_date DESC";
$stmt_history = $db->prepare($query_history);
$stmt_history->bind_param('i', $user['id']);
$stmt_history->execute();
$result_history = $stmt_history->get_result();
$purchase_history = $result_history->fetch_all(MYSQLI_ASSOC);

// Récupération des rendez-vous de l'utilisateur
$query_appointments = "SELECT * FROM rendezvous WHERE user_id=? ORDER BY appointment_date DESC";
$stmt_appointments = $db->prepare($query_appointments);
$stmt_appointments->bind_param('i', $user['id']);
$stmt_appointments->execute();
$result_appointments = $stmt_appointments->get_result();
$appointments = $result_appointments->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - <?php echo htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <div class="profile-container">
        <div class="profile-header">
            <h2>Profil</h2>
        </div>
        <div class="profile-content">
            <div class="user-info">
                <p><strong>Nom:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>

            <div class="purchase-history">
                <h3>Historique d'achats</h3>
                <?php if (count($purchase_history) > 0) : ?>
                    <ul>
                        <?php foreach ($purchase_history as $purchase) : ?>
                            <li class="purchase-item">
                                <strong>Produit:</strong> <?php echo htmlspecialchars($purchase['product_name']); ?><br>
                                <strong>Prix:</strong> $<?php echo number_format($purchase['product_price'], 2); ?><br>
                                <strong>Quantité:</strong> <?php echo htmlspecialchars($purchase['product_quantity']); ?><br>
                                <strong>Date:</strong> <?php echo htmlspecialchars($purchase['purchase_date']); ?><br>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>Aucun achat effectué.</p>
                <?php endif; ?>
            </div>

            <div class="appointments-history">
                <h3>Historique des rendez-vous</h3>
                <?php if (count($appointments) > 0) : ?>
                    <ul>
                        <?php foreach ($appointments as $appointment) : ?>
                            <li class="appointment-item">
                                <strong>Date:</strong> <?php echo htmlspecialchars($appointment['appointment_date']); ?><br>
                                <strong>Raison:</strong> <?php echo htmlspecialchars($appointment['reason']); ?><br>
                                <strong>Statut:</strong> <?php echo htmlspecialchars($appointment['status']); ?><br>
                                <strong>Nom:</strong> <?php echo htmlspecialchars($appointment['user_name']); ?><br>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>Aucun rendez-vous pris.</p>
                <?php endif; ?>
            </div>

            <p><a href="index.php?logout=1" class="logout-link">Se déconnecter</a></p>
        </div>
    </div>
    <?php include '../includes/footer.php';?>
</body>
</html>
