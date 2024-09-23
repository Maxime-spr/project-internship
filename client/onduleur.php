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
    header('Location: onduleur.php');
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
    <title>ONDULEUR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <div class="product">
                <img src="./img/BK650AS.jpg" alt="">
                <h3>BACK UPS BK650-AS</h3>
                <h3>0 DA</h3>
                <h4>Output Power Capacity   :   300 Watts / 650 VA  Off  Line 4 Sorties </h4>
                <h4>Output Connections  : (3) BAttery Backup   (1) Surge Protection   </h4>
                <button onclick="addToCart(129)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SUA750I.jpg" alt="">
                <h3>SMAT UPS SUA750I</h3>
                <h3>18900 DA</h3>
                <h4>Output Power Capacity   :  500 Watts / 750 VA</h4>
                <h4>Line Interactive  Output Connections  : (6) BAttery Backup</h4>
                <button onclick="addToCart(130)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SUA1000I.png" alt="">
                <h3>SMART UPS SUA 1000I</h3>
                <h3>28900 DA</h3>
                <h4>Output Power Capacity   :   670 Watts / 1000 VA</h4>
                <h4>Line Interactive  Output Connections  : (8) BAttery Backup </h4>
                <button onclick="addToCart(131)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SUA1500I_3000I.png" alt="">
                <h3>SMART UPS SUA 1500I</h3>
                <h3>54900 DA</h3>
                <h4>Output Power Capacity   :   980 Watts / 1500 VA</h4>
                <h4>Line Interactive  Output Connections  : (8) BAttery Backup </h4>
                <button onclick="addToCart(132)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SUA1500I_3000I.png" alt="">
                <h3>SMART UPS SUA 3000I</h3>
                <h3>109500 DA</h3>
                <h4>Output Power Capacity   :   2700 Watts / 3000 VA</h4>
                <h4>Line Interactive  Output Connections  : (8) IEC 320 C13</h4>
                <button onclick="addToCart(133)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SMT.jpg" alt="">
                <h3>SMART UPS SMT 750VA-RMI2U</h3>
                <h3>49800 DA</h3>
                <button onclick="addToCart(134)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/SMT.jpg" alt="">
                <h3>SMART UPS SMT 3000VA-RMI2U</h3>
                <h3>159900 DA</h3>
                <button onclick="addToCart(135)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="./img/PRISE.png" alt="">
                <h3>Multiprise cyber power 5 sorties</h3>
                <h3>990 DA</h3>
                <button onclick="addToCart(136)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `onduleur.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
