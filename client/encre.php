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
    header('Location: encre.php');
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
    <title>ENCRE PAPIER SYSTEME CONTINUE</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
                <!--bouteille d'encre-->
            <div class="product">
                <img src="" alt="">
                <h3>Bouteille d'Encre 30 ML Black</h3>
                <h3>29 DA</h3>
                <h4></h4>
                <button onclick="addToCart(228)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>PACK 4 CARTOUCHES 30 ML Black/Cyan/Yellow</h3>
                <h3>100 DA</h3>
                <h4></h4>
                <button onclick="addToCart(229)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>100ML Black</h3>
                <h3>149 DA</h3>
                <h4></h4>
                <button onclick="addToCart(230)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>100ML Black</h3>
                <h3>149 DA</h4>
                <button onclick="addToCart(231)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>100ML Cyan</h3>
                <h3>149 DA</h3>
                <h4></h4>
                <button onclick="addToCart(232)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>100ML Magenta</h3>
                <h3>149 DA</h3>
                <h4></h4>
                <button onclick="addToCart(233)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>100ML Yellow</h3>
                <h3>149 DA</h3>
                <h4></h4>
                <button onclick="addToCart(234)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sublimation 100ML Black/Cyan Light/Magenta Light</h3>
                <h3>350 DA</h3>
                <h4></h4>
                <button onclick="addToCart(235)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L Black</h3>
                <h3>1100 DA</h3>
                <h4></h4>
                <button onclick="addToCart(236)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L Cyan</h3>
                <h3>1100 DA</h3>
                <h4></h4>
                <button onclick="addToCart(237)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L Magenta</h3>
                <h3>1100 DA</h3>
                <h4></h4>
                <button onclick="addToCart(238)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L Yellow</h3>
                <h3>1100 DA</h3>
                <h4></h4>
                <button onclick="addToCart(239)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L sublimation Black</h3>
                <h3>4390 DA</h3>
                <h4></h4>
                <button onclick="addToCart(240)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L sublimation Cyan</h3>
                <h3>4390 DA</h3>
                <h4></h4>
                <button onclick="addToCart(241)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L sublimation Magenta</h3>
                <h3>4390 DA</h4>
                <button onclick="addToCart(242)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>1L sublimation Yellow</h3>
                <h3>4390 DA</h3>
                <h4></h4>
                <button onclick="addToCart(243)">Ajouter au panier</button>
            </div>
            <!--bouteille nettoyage 10ML-->
            <div class="product">
                <img src="" alt="">
                <h3>Bouteille nettoyage 100ML</h3>
                <h3>120 DA</h3>
                <h4>Bouteille Netoyage tête d'imprission</h4>
                <button onclick="addToCart(244)">Ajouter au panier</button>
            </div>
            <!--Papier-->
            <div class="product">
                <img src="" alt="">
                <h3>Papier P690260</h3>
                <h3>290 DA</h3>
                <h4>Papier photo A4 Glasse 260Gr/20f</h4>
                <button onclick="addToCart(245)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Papier P370110</h3>
                <h3>150 DA</h3>
                <h4>PAPIER ADHESIVE CD MAT 50*2P 110Gr</h4>
                <button onclick="addToCart(246)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Papier 661260S</h3>
                <h3>90 DA</h3>
                <h4>papier photo A6 glasse 250Gr</h4>
                <button onclick="addToCart(247)">Ajouter au panier</button>
            </div>
            <!--systeme continue epson-->
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE0709</h3>
                <h3>250 DA</h3>
                <h4>Stylus 1270/1280/1290/3300c/780/</h4>
                <button onclick="addToCart(248)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CIS1718</h3>
                <h3>250 DA</h3>
                <h4>stylus 680/680T/685/777/1000ICS</h4>
                <button onclick="addToCart(249)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE3637</h3>
                <h3>250 DA</h3>
                <h4>stylus c42/c44/c46</h4>
                <button onclick="addToCart(250)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE6667</h3>
                <h3>250 DA</h3>
                <h4>stylus c48</h4>
                <button onclick="addToCart(251)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE4041</h3>
                <h3>250 DA</h3>
                <h4>stylus c62/cx3200</h4>
                <button onclick="addToCart(252)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE2829</h3>
                <h3>250 DA</h3>
                <h4>stylus c50/c60/c61/cx3100</h4>
                <button onclick="addToCart(253)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE601</h3>
                <h3>250 DA</h3>
                <h4>C88/CX3800/CX4200/CX4800/CX5800</h4>
                <button onclick="addToCart(254)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE321</h3>
                <h3>250 DA</h3>
                <h4>C70/C80/C82/C80N/C80WN/C82/C82</h4>
                <button onclick="addToCart(255)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE471</h3>
                <h3>250 DA</h3>
                <h4>C63/C65/C83/C85/CX3500/CX6300</h4>
                <button onclick="addToCart(256)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE771</h3>
                <h3>350 DA</h3>
                <h4>R260/R280/R380/RX580/RX595/RX680NEW</h4>
                <button onclick="addToCart(257)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE901</h3>
                <h3>350 DA</h3>
                <h4>C92/CX5600</h4>
                <button onclick="addToCart(258)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE561</h3>
                <h3>350 DA</h3>
                <h4>RX530/RX430/R250</h4>
                <button onclick="addToCart(259)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE481</h3>
                <h3>350 DA</h3>
                <h4>R200/R220/R300/R300M/R320/R340/RX500</h4>
                <button onclick="addToCart(260)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE491</h3>
                <h3>350 DA</h3>
                <h4>Stylus Photo R210M/R230/R310/RX510</h4>
                <button onclick="addToCart(261)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE591</h3>
                <h3>350 DA</h3>
                <h4>Stylus photo RX5700</h4>
                <button onclick="addToCart(262)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE801</h3>
                <h3>690 DA</h3>
                <h4>P50/R265/R360/RX560/PX800/RX585</h4>
                <button onclick="addToCart(263)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE811</h3>
                <h3>690 DA</h3>
                <h4>R390/RX590/R270/1410</h4>
                <button onclick="addToCart(264)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue epson CISE1281</h3>
                <h3>690 DA</h3>
                <h4>Espon SX125/130</h4>
                <button onclick="addToCart(265)">Ajouter au panier</button>
            </div>
            <!--systeme continue hp-->
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue HP CIS02/01</h3>
                <h3>850 DA</h3>
                <h4>HP3110/3310/8230/8250/6180</h4>
                <button onclick="addToCart(266)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue HP CIS21/22</h3>
                <h3>850 DA</h3>
                <h4>HP3910/3930/PCS1410</h4>
                <button onclick="addToCart(267)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue HP CIS27/28</h3>
                <h3>850 DA</h3>
                <h4>HP3300/3400/3420/PCS1210</h4>
                <button onclick="addToCart(268)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue HP CIS56/57</h3>
                <h3>850 DA</h3>
                <h4>HP450/5100/PCS1100/1350</h4>
                <button onclick="addToCart(269)">Ajouter au panier</button>
            </div>
            <!--systeme continue canon-->
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue canon CISBJ4</h3>
                <h3>250 DA</h3>
                <h4>CANON IP3000/IP6100/IP6500/MP730/IP860</h4>
                <button onclick="addToCart(270)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue canon CISBJ5</h3>
                <h3>250 DA</h3>
                <h4>CANON BJ5/950</h4>
                <button onclick="addToCart(271)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue canon CIS24</h3>
                <h3>250 DA</h4>
                <h4>IP1000</h4>
                <button onclick="addToCart(272)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Sytème continue canon CIS4840</h3>
                <h3>250 DA</h3>
                <h4>IP4840</h4>
                <button onclick="addToCart(273)">Ajouter au panier</button>
            </div>
            <!--pack cartouche vide-->
            <div class="product">
                <img src="" alt="">
                <h3>Pack Cartouche Vide 921--924</h3>
                <h3>250 DA</h3>
                <h4>D78/D92DX4500 + 4Bouteille 30ML</h4>
                <button onclick="addToCart(274)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>(D78/D92DX4500) + 4 Bouteille 30ML</h3>
                <h3>250 DA</h3>
                <h4>sx125/130/230 + 4Bouteille 30ML</h4>
                <button onclick="addToCart(275)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Pack Cartouche Vide 1281--1284</h3>
                <h3>250 DA</h4>
                <h4>P50/R265/R360</h4>
                <button onclick="addToCart(276)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>(sx125/130/230) + 4 Bouteille 30ML</h3>
                <h3>350 DA</h3>
                <h4></h4>
                <button onclick="addToCart(277)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>ack Cartouche Vide 801--806</h3>
                <h3>350 DA</h3>
                <h4></h4>
                <button onclick="addToCart(278)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>(P50/R265/R360)</h3>
                <h3>490 DA</h3>
                <h4></h4>
                <button onclick="addToCart(279)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `encre.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
