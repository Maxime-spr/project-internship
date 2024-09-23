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
    header('Location: haut_parleur.php');
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
    <title>HAUT PARLEUR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="./img/product1.jpg" alt="Produit 1">
                <h3>Haut parleur 2,0 HP2031</h3>
                <h3>250 DA</h3>
                <button onclick="addToCart(67)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Haut parleur 2,1 HP2050</h3>
                <h3>390 DA</h3>
                <button onclick="addToCart(68)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Speaker Bluetooth FY06</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(69)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>WebCam  WCH288</h3>
                <h3>690 DA</h3>
                <button onclick="addToCart(70)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `haut_parleur.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
