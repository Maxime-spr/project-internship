<?php
session_start();
include '../includes/header.php';

// Charger les données de stock depuis le fichier JSON
$products = json_decode(file_get_contents('stock.json'), true);

// Initialisation du panier s'il n'existe pas encore en session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fonction pour ajouter un produit au panier
function addToCart($productId, &$products) {
    if (isset($products[$productId])) {
        if ($products[$productId]['stock'] > 0) {
            // Vérifier si le produit est déjà dans le panier
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity']++;
            } else {
                // Ajouter le produit au panier avec une quantité initiale de 1
                $_SESSION['cart'][$productId] = [
                    'name' => $products[$productId]['name'],
                    'price' => $products[$productId]['price'],
                    'quantity' => 1
                ];
            }
            // Décrémenter le stock du produit
            $products[$productId]['stock']--;

            // Sauvegarder les nouvelles données de stock dans le fichier JSON
            file_put_contents('stock.json', json_encode($products));
        } else {
            // Produit en rupture de stock
            $_SESSION['stock_error'] = "Le produit \"{$products[$productId]['name']}\" est en rupture de stock.";
        }
    } else {
        echo "Produit non disponible.";
    }
}

// Gestion du paramètre 'addToCart' pour ajouter un produit au panier
if (isset($_GET['addToCart'])) {
    $productId = $_GET['addToCart'];
    addToCart($productId, $products);
    header('Location: cable.php');
    exit();
}

// Afficher un message d'erreur si le produit est en rupture de stock
if (isset($_SESSION['stock_error'])) {
    echo "<div class='error'>{$_SESSION['stock_error']}</div>";
    unset($_SESSION['stock_error']); // Effacer le message après l'avoir affiché
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CABLES</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <main>
    <div class="products-container">
        <div class =products>
            <!--vga-->
            <div class="product">
                <img src="./img/product2.jpg" alt="Produit 1">
                <h3>Câble VGA M/F  1,5M </h3>
                <h3>90 DA</h3>
                <button onclick="addToCart(137)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble VGA M/F  3M </h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(138)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble VGA M/F 5M</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(139)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble VGA M/M 1,5M FLAT</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(140)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble VGA M/M  10M </h3>
                <h3>490 DA</h3>
                <button onclick="addToCart(141)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble VGA TO VGA Spliter</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(142)">Ajouter au panier</button>
            </div>
            <!--HDMI-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 1,5M Tréssé</h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(143)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 3M  Tréssé</h3>
                <h3>240 DA</h3>
                <button onclick="addToCart(144)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 5M  Tréssé</h3>
                <h3>420 DA</h3>
                <button onclick="addToCart(145)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 1,5M FLAT</h3>
                <h3>190 DA</h3>
                <button onclick="addToCart(146)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 3M FLAT</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(147)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI 5M FLAT</h3>
                <h3>470 DA</h3>
                <button onclick="addToCart(148)">Ajouter au panier</button>
            </div>
            <!--HDMI DVI-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI to DVI 5M</h3>
                <h3>490 DA</h3>
                <button onclick="addToCart(149)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI to DVI 10M</h3>
                <h3>790 DA</h3>
                <button onclick="addToCart(150)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble HDMI to DVI 15M</h3>
                <h3>1290 DA</h3>
                <button onclick="addToCart(151)">Ajouter au panier</button>
            </div>
            <!--DVI-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble DVI to 3RCA</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(152)">Ajouter au panier</button>
            </div>
            <!--3RCA-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble 3RCA to 3RCA 3M</h3>
                <h3>60 DA</h3>
                <button onclick="addToCart(153)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble 3RCA to 3RCA 5M</h3>
                <h3>120 DA</h3>
                <button onclick="addToCart(154)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble 3RCA to 3RCA 10M</h3>
                <h3>210 DA</h3>
                <button onclick="addToCart(155)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble 3RCA to 3RCA 20M</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(156)">Ajouter au panier</button>
            </div>
            <!--cable reseau-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 15M</h3>
                <h3>190 DA</h3>
                <button onclick="addToCart(157)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 20M UTP NOIR</h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(158)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 20M</h3>
                <h3>210 DA</h3>
                <button onclick="addToCart(159)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat6 20M</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(160)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 40M</h3>
                <h3>450 DA</h3>
                <button onclick="addToCart(161)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat6 40M</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(162)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 50M</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(163)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat6 50M</h3>
                <h3>790 DA</h3>
                <button onclick="addToCart(164)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat6 70M</h3>
                <h3>950 DA</h3>
                <button onclick="addToCart(165)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Réseau Cat5 100M</h3>
                <h3>1190 DA</h3>
                <button onclick="addToCart(166)">Ajouter au panier</button>
            </div>
            <!--cable firewire-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Firewire 1394 USB/4P 1,5M</h3>
                <h3>90 DA</h3>
                <button onclick="addToCart(167)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Firewire 1394 USB/6P 1,5M</h3>
                <h3>90 DA</h3>
                <button onclick="addToCart(168)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Firewire 1394 6P/4P 1,5M</h3>
                <h3>90 DA</h3>
                <button onclick="addToCart(169)">Ajouter au panier</button>
            </div>
            <!--cable db9-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble DB9/RJ45</h3>
                <h3>190 DA</h3>
                <button onclick="addToCart(170)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble DB9/DB9 F/F 1,5 Croisé</h3>
                <h3>90 DA</h3>
                <button onclick="addToCart(171)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble DB9/DB9 M/M 1,5M</h3>
                <h3>80 DA</h3>
                <button onclick="addToCart(172)">Ajouter au panier</button>
            </div>
            <!--cable kvm-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble KVM (VGA+Clav+Souris) M/F 1,5M</h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(173)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble KVM (VGA+Clav+Souris) M/M 1,5M</h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(174)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble KVM (VGA+Clav+Souris) M/M 5M</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(175)">Ajouter au panier</button>
            </div>
            <!--cable audio-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio Male/2RCA 5M</h3>
                <h3>85 DA</h3>
                <button onclick="addToCart(176)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio Male/2RCA 10M</h3>
                <h3>190 DA</h3>
                <button onclick="addToCart(177)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio Male/2RCA 15M</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(178)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio Male/2RCA 20M</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(179)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio M/F Ralonge 10M</h3>
                <h3>190 DA</h3>
                <button onclick="addToCart(180)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio M/M 3M</h3>
                <h3>75 DA</h3>
                <button onclick="addToCart(181)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Audio Y M/2F</h3>
                <h3>89 DA</h3>
                <button onclick="addToCart(182)">Ajouter au panier</button>
            </div>
            <!--cable USB-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Imprimante USB 1,8M Noir</h3>
                <h3>25 DA</h3>
                <button onclick="addToCart(183)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Ralonge USB 1,5M FLAT</h3>
                <h3>120 DA</h3>
                <button onclick="addToCart(184)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Ralonge USB 3M</h3>
                <h3>105 DA</h3>
                <button onclick="addToCart(185)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Ralonge USB 3M FLAT</h3>
                <h3>170 DA</h3>
                <button onclick="addToCart(186)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB / 4Pin M/M</h3>
                <h3>20 DA</h3>
                <button onclick="addToCart(187)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB / 5Pin M/M 1,8m</h3>
                <h3>30 DA</h3>
                <button onclick="addToCart(188)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB To Parallèle</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(189)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB To Parallèle New</h3>
                <h3>490 DA</h3>
                <button onclick="addToCart(190)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB To DB25</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(191)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble USB Netlink 1M/DIRECT LINK 1M</h3>
                <h3>350 DA</h3>
                <button onclick="addToCart(192)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Imprimante HP1100</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(193)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Imprimante Parallel</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(194)">Ajouter au panier</button>
            </div>
            <!--Cable alimentation/onduleur-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Alimentation 3M</h3>
                <h3>150 DA</h3>
                <button onclick="addToCart(195)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Alimentation 5M</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(196)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Alim 2 sorties 1,5M</h3>
                <h3>350 DA</h3>
                <button onclick="addToCart(197)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Onduleur 2 sortie</h3>
                <h3>350 DA</h3>
                <button onclick="addToCart(198)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble onduleur Trefle 3S</h3>
                <h3>110 DA</h3>
                <button onclick="addToCart(199)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Alimentation laptop Dell</h3>
                <h3>60 DA</h3>
                <button onclick="addToCart(200)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Alimentation SATA 15P </h3>
                <h3>25 DA</h3>
                <button onclick="addToCart(201)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble donné SATA 10cm</h3>
                <h3>10 DA</h3>
                <button onclick="addToCart(202)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble donné SATA 30cm</h3>
                <h3>20 DA</h3>
                <button onclick="addToCart(203)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble DVD PS2  5 con</h3>
                <h3>145 DA</h3>
                <button onclick="addToCart(204)">Ajouter au panier</button>
            </div>
            <!--Cable autre-->
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Extension Antenne 3m</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(205)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Péritelle</h3>
                <h3>39 DA</h3>
                <button onclick="addToCart(206)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Câble Véroyage laptop</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(207)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Kit Usb 7pcs</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(208)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Kit USB 14 pcs</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(209)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `cable.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
