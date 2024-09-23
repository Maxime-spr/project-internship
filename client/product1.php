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
    header('Location: product1.php');
    exit();
}

// Afficher un message d'erreur si le produit est en rupture de stock
if (isset($_SESSION['stock_error'])) {
    echo "<div class='error'>{$_SESSION['stock_error']}</div>";
    unset($_SESSION['stock_error']); 
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
    <title>CARTE PCI/PCI EXPRESS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="./img/product1.jpg" alt="Produit 1">
                <h3>Carte PCI 4 USB +1      XLT0005</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(1)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI to 2 DB9   XLT0001</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(2)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI to Parallèle+DB9</h3>
                <h3>790 DA</h3>
                <button onclick="addToCart(3)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI to SATA+IDE    XLT010</h3>
                <h3>790 DA</h3>
                <button onclick="addToCart(4)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI to 5 USB+3 Firwire</h3>
                <h3>990 DA</h3>
                <button onclick="addToCart(5)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI To PCMCIA</h3>
                <h3>600 DA</h3>
                <button onclick="addToCart(6)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte Son PCI 8 Sorties</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(7)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte son USB  7,1</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(8)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI Controleur RAID2 IDE</h3>
                <h3>1350 DA</h3>
                <button onclick="addToCart(9)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI Controleur RAID2 SATA</h3>
                <h3>1350 DA</h3>
                <button onclick="addToCart(10)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI Controleur RAID4 SATA</h3>
                <h3>1750 DA</h3>
                <button onclick="addToCart(11)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI Controleur RAID4 SATAII</h3>
                <h3>4500 DA</h3>
                <button onclick="addToCart(12)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI-E to parallèle+DB9</h3>
                <h3>1750 DA</h3>
                <button onclick="addToCart(13)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI-E 2SATA-II RAID</h3>
                <h3>1850 DA</h3>
                <button onclick="addToCart(14)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Carte PCI-E to modem</h3>
                <h3>1150 DA</h3>
                <button onclick="addToCart(15)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `product1.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
