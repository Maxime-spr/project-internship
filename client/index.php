<?php
session_start();
include '../includes/header.php';

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <main>
        <h1>Bienvenue sur mon site</h1>
        <p>Choisissez une section</p>
        <div class="product-links">
            <div class="product-card">
                <a href="product1.php" >
                <div >
                    <img decoding="async"  src="img/cartepci.jpg" alt="CARTE PCI/PCI EXPRESS">
                </div>
                <div >
                    <h6  style="font-size:15px;">CARTE PCI/PCI EXPRESS</h6>
                    <p  style="font-size:13px;">15 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="product2.php" >
                <div >
                    <img decoding="async"  src="img/pcmcia.jpg" alt="CARTE PCMCIA/ EXPRESSCARD">
                </div>
                <div >
                    <h6  style="font-size:15px;">CARTE PCMCIA/ EXPRESSCARD</h6>
                    <p  style="font-size:13px;">16 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="carttv.php" >
                <div >
                    <img decoding="async"  src="img/cartetv.jpg" alt="CARTE TV">
                </div>
                <div >
                    <h6  style="font-size:15px;">CARTE TV</h6>
                    <p  style="font-size:13px;">8 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="sourisclavier.php" >
                <div >
                    <img decoding="async"  src="img/souris.jpg" alt="SOURIS / CLAVIER">
                </div>
                <div >
                    <h6  style="font-size:15px;">SOURIS / CLAVIER</h6>
                    <p  style="font-size:13px;">11 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="casque_micro.php" >
                <div >
                    <img decoding="async"  src="img/casque.jpg" alt="CASQUE / MICROPHONE">
                </div>
                <div >
                    <h6  style="font-size:15px;">CASQUE / MICROPHONE</h6>
                    <p  style="font-size:13px;">10 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="webcam.php" >
                <div >
                    <img decoding="async"  src="img/webcam.jpg" alt="WEBCAM">
                </div>
                <div >
                    <h6  style="font-size:15px;">WEBCAM</h6>
                    <p  style="font-size:13px;">6 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="haut_parleur.php" >
                <div >
                    <img decoding="async"  src="img/hautp.jpg" alt="HAUT PARLEUR">
                </div>
                <div >
                    <h6  style="font-size:15px;">HAUT PARLEUR</h6>
                    <p  style="font-size:13px;">4 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="disk.php" >
                <div >
                    <img decoding="async"  src="img/ddur.jpg" alt="DISQUE DUR">
                </div>
                <div >
                    <h6  style="font-size:15px;">DISQUE DUR</h6>
                    <p  style="font-size:13px;">4 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="nettoyage.php" >
                <div >
                    <img decoding="async"  src="img/nett.jpg" alt="PRODUIT DE NETTOYAGE">
                </div>
                <div >
                    <h6  style="font-size:15px;">PRODUIT DE NETTOYAGE</h6>
                    <p  style="font-size:13px;">4 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="sacoche.php" >
                <div >
                    <img decoding="async"  src="img/tablette.jpg" alt="SACOCHE TABLETTE">
                </div>
                <div >
                    <h6  style="font-size:15px;">SACOCHE TABLETTE</h6>
                    <p  style="font-size:13px;">8 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="chargeur.php" >
                <div >
                    <img decoding="async"  src="img/chargeur.jpg" alt="CHARGEUR LAPTOP">
                </div>
                <div >
                    <h6  style="font-size:15px;">CHARGEUR LAPTOP</h6>
                    <p  style="font-size:13px;">5 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="reseau.php" >
                <div >
                    <img decoding="async"  src="img/routeur.jpg" alt="RESEAU">
                </div>
                <div >
                    <h6  style="font-size:15px;">RESEAU</h6>
                    <p  style="font-size:13px;">9 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="speaker.php" >
                <div >
                    <img decoding="async"  src="img/ipod.jpg" alt="SPEAKER IPOD">
                </div>
                <div >
                    <h6  style="font-size:15px;">SPEAKER IPOD</h6>
                    <p  style="font-size:13px;">6 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="lecteur.php" >
                <div >
                    <img decoding="async"  src="img/lecteur.jpg" alt="LECTEUR DE CARTE">
                </div>
                <div >
                    <h6  style="font-size:15px;">LECTEUR DE CARTE</h6>
                    <p  style="font-size:13px;">6 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="jeux.php" >
                <div >
                    <img decoding="async"  src="img/manette.jpg" alt="MANETTE / KIT JEUX">
                </div>
                <div >
                    <h6  style="font-size:15px;">MANETTE / KIT JEUX</h6>
                    <p  style="font-size:13px;">7 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="accessoire.php" >
                <div >
                    <img decoding="async"  src="img/accessoire.jpg" alt="ACCESSOIRES">
                </div>
                <div >
                    <h6  style="font-size:15px;">ACCESSOIRES</h6>
                    <p  style="font-size:13px;">9 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="onduleur.php" >
                <div >
                    <img decoding="async"  src="img/SUA1000I.png" alt="ONDULEUR">
                </div>
                <div >
                    <h6  style="font-size:15px;">ONDULEUR</h6>
                    <p  style="font-size:13px;">8 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="cable.php" >
                <div >
                    <img decoding="async"  src="img/cable.jpg" alt="CABLES">
                </div>
                <div >
                    <h6  style="font-size:15px;">CABLES</h6>
                    <p  style="font-size:13px;">73 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="drum.php" >
                <div >
                    <img decoding="async"  src="img/drum.jpg" alt="DRUM">
                </div>
                <div >
                    <h6  style="font-size:15px;">DRUM</h6>
                    <p  style="font-size:13px;">23 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="encre.php" >
                <div >
                    <img decoding="async"  src="img/systeme.jpg" alt="ENCRE PAPIER SYSTEME CONTINUE">
                </div>
                <div >
                    <h6  style="font-size:15px;">ENCRE PAPIER SYSTEME CONTINUE</h6>
                    <p  style="font-size:13px;">52 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="cartouche.php" >
                <div >
                    <img decoding="async"  src="img/cartouche.jpg" alt="CARTOUCHES">
                </div>
                <div >
                    <h6  style="font-size:15px;">CARTOUCHES</h6>
                    <p  style="font-size:13px;">106 produits</p>
                </div>
                </a>
            </div>
            <div class="product-card">
                <a href="toner.php" >
                <div >
                    <img decoding="async"  src="img/toner.jpg" alt="TONER COMPATIBLE">
                </div>
                <div >
                    <h6  style="font-size:15px;">TONER COMPATIBLE</h6>
                    <p  style="font-size:13px;">216 produits</p>
                </div>
                </a>
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
