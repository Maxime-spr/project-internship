<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_complet = htmlspecialchars($_POST['nom_complet']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "mail";

    $subject = "Message de Contact de " . $nom_complet;
    
    // Corps de l'email
    $body = "Nom Complet: $nom_complet\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";
    
    // Configuration de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mail';   
        $mail->Password   = 'mot de passe';      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port       = 587; 

 
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Paramètres du message
        $mail->setFrom($email, $nom_complet);       
        $mail->addAddress($to);                   

        // Contenu du message
        $mail->isHTML(false);                       
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Envoyer l'email
        $mail->send();
        $success = "Votre message a été envoyé avec succès!";
    } catch (Exception $e) {
        $error = "Une erreur est survenue. Le message n'a pas pu être envoyé. Erreur: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    
    <main class="contact-page">
        <h1>Nous contacter</h1>
        
        <!-- Informations de contact -->
        <section class="contact-info">
            <h2>Localisation</h2>
            <p>Adresse: Lotissement 5 Juillet Souidania Alger</p>

            <h2>E-mail</h2>
            <p>Infos@epitac.com</p>
            <p>Epita6660@yahoo.fr</p>

            <h2>Téléphone</h2>
            <p>023 278811/14</p>
            <p>0550 495619 -0770911896</p>
        </section>

        <!-- Formulaire de contact -->
        <section class="contact-form">
            <h2>Envoyez-nous un message direct</h2>
            <?php if (!empty($success)): ?>
                <p class="success"><?= $success ?></p>
            <?php elseif (!empty($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" action="contact.php">
                <div class="input-group">
                    <label for="nom_complet">Nom complet *</label>
                    <input type="text" id="nom_complet" name="nom_complet" required>
                </div>

                <div class="input-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <button type="submit" class="btn">Envoyer</button>
            </form>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
