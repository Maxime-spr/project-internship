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
    header('Location: jeux.php');
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
    <title>MANETTE/KIT JEUX</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="./img/product1.jpg" alt="Produit 1">
                <h3>Volant USB U783</h3>
                <h3>1350 DA</h3>
                <button onclick="addToCart(113)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Kit jeux WII W005</h3>
                <h3>890 DA</h3>
                <button onclick="addToCart(114)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Kit Arts Martiaux W006</h3>
                <h3>890 DA</h3>
                <button onclick="addToCart(115)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Kit Jeux WII W019</h3>
                <h3>890 DA</h3>
                <button onclick="addToCart(116)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Range Etui Télécommande W009</h3>
                <h3>290 DA</h3>
                <button onclick="addToCart(117)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>Gant Boxe WII W021</h3>
                <h3>590 DA</h3>
                <button onclick="addToCart(118)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/product3.jpg" alt="Produit 3">
                <h3>lecteur DISQUETTE</h3>
                <h3>990 DA</h3>
                <button onclick="addToCart(119)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `jeux.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
