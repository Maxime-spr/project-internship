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
    header('Location: product2.php');
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
    <title>CARTE PCMCIA/ EXPRESSCARD</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="./img/product2.jpg" alt="Produit 1">
                <h3>PcmciaTo ExpressCard - PCM002</h3>
                <h3>1250 DA</h3>
                <button onclick="addToCart(16)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To Firware 2 ports - PCM010</h3>
                <h3>850 DA</h3>
                <button onclick="addToCart(17)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To DB9 RS232 - PCM011</h3>
                <h3>1150 DA</h3>
                <button onclick="addToCart(18)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To Parallèle - PCM012</h3>
                <h3>2350 DA</h3>
                <button onclick="addToCart(19)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To Réseau 10/100Mo -PCM013</h3>
                <h3>750 DA</h3>
                <button onclick="addToCart(20)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To Sata</h3>
                <h3>1250 DA</h3>
                <button onclick="addToCart(21)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>PCMCIA To 4USB</h3>
                <h3>0 DA</h3>
                <button onclick="addToCart(22)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>USB To ExpressCard - PCM001</h3>
                <h3>1390 DA</h3>
                <button onclick="addToCart(23)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To ESSATA II -PCM003</h3>
                <h3>1190 DA</h3>
                <button onclick="addToCart(24)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To USB2,0 + Firware -PCM004</h3>
                <h3>1590 DA</h3>
                <button onclick="addToCart(25)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To Réseau 1000m-PCM005</h3>
                <h3>1390 DA</h3>
                <button onclick="addToCart(26)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To Firware</h3>
                <h3>950 DA</h3>
                <button onclick="addToCart(27)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To USB3,0</h3>
                <h3>1950 DA</h3>
                <button onclick="addToCart(28)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To Parallèle-PCM006</h3>
                <h3>1550 DA</h3>
                <button onclick="addToCart(29)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard To Port DB9 RS232</h3>
                <h3>950 DA</h3>
                <button onclick="addToCart(30)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>ExpressCard Lecteur de carte 24 in1-PCM9</h3>
                <h3>1150 DA</h3>
                <button onclick="addToCart(31)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `product2.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
