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
    header('Location: drum.php');
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
    <title>DRUM</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="" alt="">
                <h3>CF219A  Drum  CRG049</h3>
                <h3>1900 DA</h3>
                <h4>DRUM HP LaserJet Pro M102w  HP LaserJet Pro MFP M130fn/M130fw/M130nw/M130a     
                     CANON LBP110/LBP112/LBP113/LBP/113W</h4>
                <button onclick="addToCart(210)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>CE314 DRUM</h3>
                <h3>3900 DA</h3>
                <h4>DRUM  HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot.    
                     Laser Canon i-Sensys LBP7010C, LBP7018C </h4>
                <button onclick="addToCart(211)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPCM2000</h3>
                <h3>2090 DA</h3>
                <h4>OPC EPSON M2000</h4>
                <button onclick="addToCart(212)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>SFS51099</h3>
                <h3>0 DA</h3>
                <h4>Drum Epson EPL 6200/6200L</h4>
                <button onclick="addToCart(213)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>SAF51055B</h3>
                <h3>2590 DA</h3>
                <h4>Drum Epson EPL 5900/6100</h4>
                <button onclick="addToCart(214)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>SFS51055A</h3>
                <h3>2590 DA</h3>
                <h4>Drum Epson EPL 5700/5800</h4>
                <button onclick="addToCart(215)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPCDR1000</h3>
                <h3>1390 DA</h3>
                <h4>OPC BROTHER TN1000</h4>
                <button onclick="addToCart(216)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPC TK4105</h3>
                <h3>3290 DA</h3>
                <h4>OPC TASKALPHA 1800</h4>
                <button onclick="addToCart(217)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPCTK1150</h3>
                <h3>2290 DA</h3>
                <h4>OPC KYOCERA M2135</h4>
                <button onclick="addToCart(218)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPCTK410</h3>
                <h3>3190 DA</h3>
                <h4>OPC KYOCERA M2135 KM-1620/1635/1650/2020/2035/2050 Aurora AD-165/169/203/205 Kyocera Mita KM-2550 </h4>
                <button onclick="addToCart(219)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>OPC EXV33</h3>
                <h3>2190 DA</h3>
                <h4>OPC  Canon image RUNNER 2520/2520i/2525/2525i/2530/2530i</h4>
                <button onclick="addToCart(220)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>Drum3040</h3>
                <h3>2190 DA</h3>
                <h4>Drum Brother 3030/3070</h4>
                <button onclick="addToCart(221)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>DRUM 210</h3>
                <h3>2190 DA</h3>
                <h4>Drum  Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370,  MFC-9010CN/9120CN/9320CW/9325CW, 
                     DCP-9010CN</h4>
                <button onclick="addToCart(222)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>DRUM 230</h3>
                <h3>2190 DA</h3>
                <h4>Drum  Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370,  MFC-9010CN/9120CN/9320CW/9325CW, 
                     DCP-9010CN</h4>
                <button onclick="addToCart(223)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>DRUM 240</h3>
                <h3>2190 DA</h3>
                <h4>Drum  Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370,  MFC-9010CN/9120CN/9320CW/9325CW, 
                     DCP-9010CN</h4>
                <button onclick="addToCart(224)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>DRUM 270</h3>
                <h3>2190 DA</h3>
                <h4>Drum  Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370,  MFC-9010CN/9120CN/9320CW/9325CW, 
                     DCP-9010CN</h4>
                <button onclick="addToCart(225)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>DRUM 290</h3>
                <h3>2190 DA</h3>
                <h4>Drum  Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370,  MFC-9010CN/9120CN/9320CW/9325CW, 
                     DCP-9010CN</h4>
                <button onclick="addToCart(226)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="">
                <h3>MSD310 DRUM</h3>
                <h3>7900 DA</h3>
                <h4>Drum Lexmark MS310/410/510/610</h4>
                <button onclick="addToCart(227)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `drum.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
