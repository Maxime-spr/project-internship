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
    header('Location: cartouche.php');
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
    <title>CARTOUCHES</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <!--cartouche epson-->
            <div class="product">
                <img src="" alt="ET1802… 1804">
                <h3>ET1802… 1804</h3>
                <h3>0 DA</h3>
                <h4>Epson Expression Home XP 102, XP 202, XP 205, XP 212, XP 215, XP 225, XP 30, XP 302, XP 305, XP 312, XP 315, XP 322, XP 323, XP 325, XP 402, XP 405, XP 405WH, XP 412, XP 415, XP 422, XP 425,    
                    Epson XP 102, 202, 205, 212, 215, 225, 30, 302, 305, 312, 315, 322, 323, 325, 402, 405, 405WH, 412, 415, 422, 425.</h4>
                <button onclick="addToCart(280)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET1811….1814">
                <h3>ET1811….1814</h3>
                <h3>0 DA</h3>
                <h4>Epson Expression Home XP 102, XP 202, XP 205, XP 212, XP 215, XP 225, XP 30, XP 302, XP 305, XP 312, XP 315, XP 322, XP 323, XP 325, XP 402, XP 405, XP 405WH, XP 412, XP 415, XP 422, XP 425,        
                    epson XP 102, 202, 205, 212, 215, 225, 30, 302, 305, 312, 315, 322, 323, 325, 402, 405, 405WH, 412, 415, 422, 425.</h4>
                <button onclick="addToCart(281)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET1281….1284">
                <h3>ET1281….1284</h3>
                <h3>0 DA</h3>
                <h4>Epson BX 305F, 305FW, 305FW Plus, Epson S 22, Epson Stylus BX305F, BX305FW, BX305FW Plus, S22, SX125, SX130, SX230, SX235W, SX420W, SX425W, SX430W, SX435W, SX438W, SX440W, SX445W, Epson Stylus Office BX305F, BX305FW, BX305FW Plus, Epson SX 125, 130, 230, 235W, 420W, 425W, 430W, 435W, 438W, 440W, 445W.</h4>
                <button onclick="addToCart(282)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET2991… 2994">
                <h3>ET2991… 2994</h3>
                <h3>139 DA</h3>
                <h4>Epson BX 305F, 305FW, 305FW Plus, Epson S 22, Epson Stylus BX305F, BX305FW, BX305FW Plus, S22, SX125, SX130, SX230, SX235W, SX420W, SX425W, SX430W, SX435W, SX438W, SX440W, SX445W, Epson Stylus Office BX305F, BX305FW, BX305FW Plus, Epson SX 125, 130, 230, 235W, 420W, 425W, 430W, 435W, 438W, 440W, 445W.</h4>
                <button onclick="addToCart(283)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0711/712">
                <h3>ET0711/712</h3>
                <h3>0 DA</h3>
                <h4>EPSON Stylus D78/D92/D120/DX4000/DX4050/DX4400 DX4450/DX5000/DX5050/ DX6000/DX6050/DX7000F DX7400/DX7450/DX8400/DX8450/DX9400F/S20/S21/SX100/SX110/SX105/SX115/SX200/SX205/SX209/SX210 /SX215/ SX218/  SX400 / SX405/SX405WiFi/SX410/SX415/SX510W/SX515W/SX600FW/SX610FW/ BX600FW/BX610FW Office B40W/BX300F/BX300FW/BX310FN</h4>
                <button onclick="addToCart(284)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0921…..924">
                <h3>ET0921…..924</h3>
                <h3>0 DA</h3>
                <h4>C91/CX4300/T26/TX106/TX109 V6</h4>
                <button onclick="addToCart(285)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0731…..734">
                <h3>ET0731…..734</h3>
                <h3>79 DA</h3>
                <h4>C79/C90/C92/C110/CX3900/CX4900/CX4905/CX5500/CX5600/CX5900/CX6900F/CX7300/CX8300</h4>
                <button onclick="addToCart(286)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET073C/M/Y">
                <h3>ET073C/M/Y</h3>
                <h3>79 DA</h3>
                <h4>EPSON stylus C79/C90/C92/C110/CX3900/CX3905 /CX4900/CX4905/CX5500/ CX5505/CX5600/CX5900 /CX6900F/CX7300/CX7310/CX8300/CX9300F T10/T11/T13/T20/T21/T23/T24/T30/T33/T40W/TX100/TX105/TX110/TX111/TX115/TX200/TX209/TX210/TX213/TX220/TX300F/TX400/TX409/TX410/TX550W/TX600FW/TX610FW</h4>
                <button onclick="addToCart(287)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="T01171N">
                <h3>T01171N</h3>
                <h3>85 DA</h3>
                <h4></h4>
                <button onclick="addToCart(288)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET073N C/M/Y">
                <h3>ET073N C/M/Y</h3>
                <h3>85 DA</h3>
                <h4>Stylus T23/T24/TX105/TX115</h4>
                <button onclick="addToCart(289)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET090N">
                <h3>ET090N</h3>
                <h3>69 DA</h3>
                <h4>T20/T21/TX100/TX110/TX111</h4>
                <button onclick="addToCart(290)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET007-N ET009-C">
                <h3>ET007-N ET009-C</h3>
                <h3>20 DA</h3>
                <h4>Stylus 1270/1280/1290/3300c/780/</h4>
                <button onclick="addToCart(291)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET017-N ET018-C">
                <h3>ET017-N ET018-C</h3>
                <h3>15 DA</h3>
                <h4>stylus 680/680T/685/777/1000ICS</h4>
                <button onclick="addToCart(292)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET019-N ET020-C">
                <h3>ET019-N ET020-C</h3>
                <h3>20 DA</h3>
                <h4>stylus c880/880I/880T</h4>
                <button onclick="addToCart(293)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET026-N ET027-C">
                <h3>ET026-N ET027-C</h3>
                <h3>19 DA</h3>
                <h4>Epson 810/820/830/925/C50</h4>
                <button onclick="addToCart(294)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET028-N ET029-C">
                <h3>ET028-N ET029-C</h3>
                <h3>20 DA</h3>
                <h4>stylus c50/c60/c61/cx3100</h4>
                <button onclick="addToCart(295)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET036-N ET037-C">
                <h3>ET036-N ET037-C</h3>
                <h3>35 DA</h3>
                <h4>stylus c42/c44/c46</h4>
                <button onclick="addToCart(296)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET038-N ET039-C">
                <h3>ET038-N ET039-C</h3>
                <h3>35 DA</h3>
                <h4>stylus c41/c43/C45/CX1500</h4>
                <button onclick="addToCart(297)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET040-N ET041-C">
                <h3>ET040-N ET041-C</h3>
                <h3>25 DA</h3>
                <h4>stylus c62/cx3200</h4>
                <button onclick="addToCart(298)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET066-N ET067-C">
                <h3>ET066-N ET067-C</h3>
                <h3>25 DA</h3>
                <h4>stylus c48</h4>
                <button onclick="addToCart(299)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET1001-N">
                <h3>ET1001-N</h3>
                <h3>59 DA</h3>
                <h4>Stylus office B40W/BX600FW</h4>
                <button onclick="addToCart(300)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET711H">
                <h3>ET711H</h3>
                <h3>95 DA</h3>
                <h4>Stylus office B40W/BX600FW/B1100</h4>
                <button onclick="addToCart(301)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET1002-1003-1004">
                <h3>ET1002-1003-1004</h3>
                <h3>95 DA</h3>
                <h4>Stylus office B40W/BX600FW/B1100</h4>
                <button onclick="addToCart(302)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0187-N/050">
                <h3>ET0187-N/050</h3>
                <h3>45 DA</h3>
                <h4>stylus color 400/440/460/600/610/1160/1520/760</h4>
                <button onclick="addToCart(303)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0193-C /53">
                <h3>ET0193-C /53</h3>
                <h3>65 DA</h3>
                <h4>stylus color 400/440/460/600/610/1160/1520/760</h4>
                <button onclick="addToCart(304)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET1 91-C/052">
                <h3>ET1 91-C/052</h3>
                <h3>65 DA</h3>
                <h4>stylus photo 700/710/720/750/IP-100</h4>
                <button onclick="addToCart(305)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0321 …..324">
                <h3>ET0321 …..324</h3>
                <h3>25 DA</h3>
                <h4>stylus C70/C80/C82/C80N/C80WN/C82/C82N/CX5100 /5200/5400</h4>
                <button onclick="addToCart(306)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0422 ….424">
                <h3>ET0422 ….424</h3>
                <h3>25 DA</h3>
                <h4>stylus C82/C82N/C82WN/CX5100/CX5200/CX5400</h4>
                <button onclick="addToCart(307)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0441 …..444">
                <h3>ET0441 …..444</h3>
                <h3>35 DA</h3>
                <h4>C64/C66/C84/C84N/C86/CX3600/3650/CX4600/CX6400/CX6600</h4>
                <button onclick="addToCart(308)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0461…...474">
                <h3>ET0461…...474</h3>
                <h3>35 DA</h3>
                <h4>C63/C65/C83/C85/CX3500/CX6300</h4>
                <button onclick="addToCart(309)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0481 …..486">
                <h3>ET0481 …..486</h3>
                <h3>35 DA</h3>
                <h4>Stylus Photo R200/R220/R300/R300M/R320/R340/RX500/RX600/RX620</h4>
                <button onclick="addToCart(310)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0491 …..496">
                <h3>ET0491 …..496</h3>
                <h3>45 DA</h3>
                <h4>Stylus Photo R210M/R230/R310/RX510</h4>
                <button onclick="addToCart(311)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0551 …..554">
                <h3>ET0551 …..554</h3>
                <h3>35 DA</h3>
                <h4>Stylus Photo R240/R245/RX420/RX425/RX520</h4>
                <button onclick="addToCart(312)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0601 …..604">
                <h3>ET0601 …..604</h3>
                <h3>35 DA</h3>
                <h4>C88/CX3800/CX4200/CX4800/CX5800/CX7800</h4>
                <button onclick="addToCart(313)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0611 …..614">
                <h3>ET0611 …..614</h3>
                <h3>30 DA</h3>
                <h4>D68/D88/DX3800/DX3850/DX4200/DX4250/DX4800/DX4850</h4>
                <button onclick="addToCart(314)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0631 …..634">
                <h3>ET0631 …..634</h3>
                <h3>30 DA</h3>
                <h4>C67/C87/DX3700/CX4100/CX4700/RX500/RX600/RX620</h4>
                <button onclick="addToCart(315)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0771 …..776">
                <h3>ET0771 …..776</h3>
                <h3>30 DA</h3>
                <h4>Stylus Photo R260/R280/R380/RX580/RX595/RX680NEW</h4>
                <button onclick="addToCart(316)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0801 …..806">
                <h3>ET0801 …..806</h3>
                <h3>35 DA</h3>
                <h4>P50/R265/R360/RX560/RX585/PX650/RX685/PX700W/PX710W/PX800FW/PX810W</h4>
                <button onclick="addToCart(317)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ET0811 …..816">
                <h3>ET0811 …..816</h3>
                <h3>35 DA</h3>
                <h4>R390/RX590/R270/1410</h4>
                <button onclick="addToCart(318)">Ajouter au panier</button>
            </div>
            <!--cartouche hp-->
            <div class="product">
                <img src="" alt="CHP932BK">
                <h3>CHP932BK</h3>
                <h3>970 DA</h3>
                <h4>HP COMPAT 932/933 / 7110</h4>
                <button onclick="addToCart(319)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CHP932C">
                <h3>CHP932C</h3>
                <h3>970 DA</h3>
                <h4>HP COMPAT 932/933 / 7110</h4>
                <button onclick="addToCart(320)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CHP932M">
                <h3>CHP932M</h3>
                <h3>970 DA</h3>
                <h4>HP COMPAT 932/933 / 7110</h4>
                <button onclick="addToCart(321)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CHP932Y">
                <h3>CHP932Y</h3>
                <h3>970 DA</h3>
                <h4>HP COMPAT 932/933 / 7110</h4>
                <button onclick="addToCart(322)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP920bXL">
                <h3>HP920bXL</h3>
                <h3>290 DA</h3>
                <h4>H178/364/564/826 B8550/8553/C6380/C6383/C5324/C5383/ C6324/C5390/C5393/ C5388/D5463</h4>
                <button onclick="addToCart(323)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP920C/M/Y">
                <h3>HP920C/M/Y</h3>
                <h3>290 DA</h3>
                <h4>H178/364/564/826 B8550/8553/C6380/C6383/C5324/C5383/ C6324/C5390/C5393/ C5388/D5463</h4>
                <button onclick="addToCart(324)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP51629A">
                <h3>HP51629A</h3>
                <h3>690 DA</h3>
                <h4>Cartouche Noir N29 HP 600/660/670/690/695 Black</h4>
                <button onclick="addToCart(325)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH49A/N">
                <h3>CH49A/N</h3>
                <h3>690 DA</h3>
                <h4>Cartouche couleur N°49 DJ350,350cbi,610,640,600,660,670,690,695/DW600,66 0,670/OJ500,590,635,700</h4>
                <button onclick="addToCart(326)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH14A/20 N">
                <h3>CH14A/20 N</h3>
                <h3>650 DA</h3>
                <h4>HP 610/C640c Black</h4>
                <button onclick="addToCart(327)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP 51626A">
                <h3>HP 51626A</h3>
                <h3>650 DA</h3>
                <h4>HP 540/540C/550C/560C Black</h4>
                <button onclick="addToCart(328)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP1823D">
                <h3>HP1823D</h3>
                <h3>850 DA</h3>
                <h4>HP 710/720/890C/1120C/1125c Black</h4>
                <button onclick="addToCart(329)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP 6617D/25">
                <h3>HP 6617D/25</h3>
                <h3>790 DA</h3>
                <h4>Cartouche Couleur N 17/25 HP 825/840C/842C/843/845C</h4>
                <button onclick="addToCart(330)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP130">
                <h3>HP130</h3>
                <h3>790 DA</h3>
                <h4>Cartouche hp Noir  N130/H96/339 HP Deskjet 5740/5743/5943/6540d/6543/6623/ 6840/ 6843/  6943/698 3  /9803/9803d
                    Photosmart 3/2575/2575v/2575xi/2610/2613/2710/2713/8049/8050xi/8150v/  8150xi/8153/ 8453/8753/ D5063/D5160/Pro B8353
                    Officejet 6313/6315/7210/7213/7313/7410/7410xi/7413/Pro</h4>
                <button onclick="addToCart(331)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP1300">
                <h3>HP131 C8765</h3>
                <h3>1090 DA</h3>
                <h4>"Cartouche hp Noir N131 /H94/338 HP Deskjet 460c/460cb/460wbt/5740/5743/6540d/ 6543/6623/6840/ 6843/9803/9803d
                    Photosmart 2573/2610/2613/2710/2713/7830/8153/8453/8753/C3175/C3180/C3183/Pro B8353
                    PSC1510/1513/1600/1613/2210v/2210xi/2350/2353/2355/2410v/2410xi/2510xi
                    Officejet 6210/6213/7210/7213/7313/7410/7413/H470/H470b/H470wbt/Pro K7100/ Pro K7103 "</h4>
                <button onclick="addToCart(332)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE250A">
                <h3>HP135 C8766</h3>
                <h3>1090 DA</h3>
                <h4>"Cartouche Couleur N135/H95/343 
                    HP Deskjet 460c/460cb/460wbt/5443/5743/5943/6540d/6543/ 6623/6843/6943 /6983/ 9803/ 9803d/ D4163
                    Photosmart 325/335/375/385/428/475/2573/2610/2613/2710/2713/8050xi/8153/ 8453/ 753/ C3180/C3183/C4138/D5063/Pro B8353
                    PSC 1513/1600/1613/2210v/2210xi/2350/2353/2355/2410v/2410xi/2510xi
                    Officejet 6213/6313/6315/7213/7313/7413/H470/H470b/H470wbt/Pro K7103"</h4>
                <button onclick="addToCart(333)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE253A">
                <h3>HP121BK/640 XL</h3>
                <h3>1190 DA</h3>
                <h4>Cartouche Noir HP N121 DeskjetD2500/2560/D2563/F4200/F4240/F4272/F4275/F4280/F4283</h4>
                <button onclick="addToCart(335)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE253A">
                <h3>CH10BK</h3>
                <h3>290 DA</h3>
                <h4>Cartouche noire N° 10 HP Designjet 500/800/2000/2500B Réf(4844A)</h4>
                <button onclick="addToCart(335)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE255A">
                <h3>CH82C</h3>
                <h3>290 DA</h3>
                <h4>Cartouche couleur Cyan N°82 HP2500Proseries/HP,DJ500/800/1100d/2200/2000/250 0/cp1700/bi3000HP2500Proseries/HP,DJ500/800/1100d/2200/2000/2500/cp1700/bi3000 
                    HP Designjet 500/800 </h4>
                <button onclick="addToCart(336)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH82M">
                <h3>CH82M</h3>
                <h3>290 DA</h3>
                <h4>Cartouche couleur Magenta N°82 HP2500Proseries/HP,DJ500/800/1100d/2200/2000/2500/cp1700/bi3000
                    HP2500Proseries/HP,DJ500/800/1100d/2200/2000/2500/cp1700/bi3000 HP Designjet 500/800 </h4>
                <button onclick="addToCart(337)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH82Y">
                <h3>CH82Y</h3>
                <h3>290 DA</h3>
                <h4>Cartouche couleur Yellow N°82 HP2500Proseries/HP,DJ500/800/1100d/2200/2000/250 0/cp1700/bi3000
                    HP2500Proseries/HP,DJ500/800/1100d/2200/2000/2500/cp1700/bi3000 HP Designjet 500/800 </h4>
                <button onclick="addToCart(338)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH11C /4836">
                <h3>CH11C /4836</h3>
                <h3>190 DA</h3>
                <h4>Cartouche cyan-Magenta-Yellow N°11 HP DesignjetBI 2200/2250/2600/2230/2280,BI1200d/CP1700,DJ100/BI1100d/DS100/DS N° 11</h4>
                <button onclick="addToCart(339)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH11M /4836">
                <h3>CH11M /4836</h3>
                <h3>190 DA</h3>
                <h4>Cartouche cyan-Magenta-Yellow N°11 HP DesignjetBI 2200/2250/2600/2230/2280,BI1200d/CP1700,DJ100/BI1100d/DS100/DS N° 11</h4>
                <button onclick="addToCart(340)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CH11Y /4836">
                <h3>CH11Y /4836</h3>
                <h3>190 DA</h3>
                <h4>Cartouche cyan-Magenta-Yellow N°11 HP DesignjetBI 2200/2250/2600/2230/2280,BI1200d/CP1700,DJ100/BI1100d/DS100/DS N° 11</h4>
                <button onclick="addToCart(341)">Ajouter au panier</button>
            </div>
            <!--cartouche cannon-->
            <div class="product">
                <img src="" alt="PGI270BK">
                <h3>PGI270BK</h3>
                <h3>135 DA</h3>
                <h4>Cartouche Canon PIXMA MG5720/MG5721/MG5722/MG6820/MG6821/MG6822/MG7720</h4>
                <button onclick="addToCart(342)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL271C">
                <h3>CL271C</h3>
                <h3>135 DA</h3>
                <h4>Cartouche Canon PIXMA MG5720/MG5721/MG5722/MG6820/MG6821/MG6822/MG7720</h4>
                <button onclick="addToCart(343)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL271M">
                <h3>CL271M</h3>
                <h3>135 DA</h3>
                <h4>Cartouche Canon PIXMA MG5720/MG5721/MG5722/MG6820/MG6821/MG6822/MG7720</h4>
                <button onclick="addToCart(344)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL271Y">
                <h3>CL271Y</h3>
                <h3>135 DA</h3>
                <h4>Cartouche Canon PIXMA MG5720/MG5721/MG5722/MG6820/MG6821/MG6822/MG7720</h4>
                <button onclick="addToCart(345)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL271GY">
                <h3>CL271GY</h3>
                <h3>135 DA</h3>
                <h4>Cartouche Canon PIXMA MG5720/MG5721/MG5722/MG6820/MG6821/MG6822/MG7720</h4>
                <button onclick="addToCart(346)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="PGI470BK">
                <h3>PGI470BK</h3>
                <h3>129 DA</h3>
                <h4>Cartouche Canon PIXMA MG5740/MG6840/MG7740</h4>
                <button onclick="addToCart(347)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL471C">
                <h3>CL471C</h3>
                <h3>129 DA</h3>
                <h4>Cartouche Canon PIXMA MG5740/MG6840/MG7740</h4>
                <button onclick="addToCart(348)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL471M">
                <h3>CL471M</h3>
                <h3>129 DA</h3>
                <h4>Cartouche Canon PIXMA MG5740/MG6840/MG7740</h4>
                <button onclick="addToCart(349)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL471Y">
                <h3>CL471Y</h3>
                <h3>129 DA</h3>
                <h4>Cartouche Canon PIXMA MG5740/MG6840/MG7740</h4>
                <button onclick="addToCart(350)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL471BK">
                <h3>CL471BK</h3>
                <h3>129 DA</h3>
                <h4>Cartouche Canon PIXMA MG5740/MG6840/MG7740</h4>
                <button onclick="addToCart(351)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC520BK">
                <h3>CC520BK</h3>
                <h3>119 DA</h3>
                <h4>CANON IP3600/IP4600/IP4700/MP540</h4>
                <button onclick="addToCart(352)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC521BC">
                <h3>CC521BC</h3>
                <h3>119 DA</h3>
                <h4>CANON IP3600/IP4600/IP4700/MP540</h4>
                <button onclick="addToCart(353)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC521BM">
                <h3>CC521BM</h3>
                <h3>119 DA</h3>
                <h4>CANON IP3600/IP4600/IP4700/MP540</h4>
                <button onclick="addToCart(354)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC521BY">
                <h3>CC521BY</h3>
                <h3>119 DA</h3>
                <h4>CANON IP3600/IP4600/IP4700/MP540</h4>
                <button onclick="addToCart(355)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC521BK">
                <h3>CC521BK</h3>
                <h3>119 DA</h3>
                <h4>CANON IP3600/IP4600/IP4700/MP540</h4>
                <button onclick="addToCart(356)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="PGI550BK">
                <h3>PGI550BK</h3>
                <h3>95 DA</h3>
                <h4>Cartouche canon PIXMA MG5450/MG5550/MG5650/MG6350/MG6450/MG6650/ MG7150 /MG7550/ Ip7250/MX925/MX725/IX6850/IP8750</h4>
                <button onclick="addToCart(357)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL551C">
                <h3>CL551C</h3>
                <h3>95 DA</h3>
                <h4>Cartouche canon PIXMA MG5450/MG5550/MG5650/MG6350/MG6450/MG6650/ MG7150 /MG7550/ Ip7250/MX925/MX725/IX6850/IP8750</h4>
                <button onclick="addToCart(358)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL551M">
                <h3>CL551M</h3>
                <h3>95 DA</h3>
                <h4>Cartouche canon PIXMA MG5450/MG5550/MG5650/MG6350/MG6450/MG6650/ MG7150 /MG7550/ Ip7250/MX925/MX725/IX6850/IP8750</h4>
                <button onclick="addToCart(359)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL551Y">
                <h3>CL551Y</h3>
                <h3>95 DA</h3>
                <h4>Cartouche canon PIXMA MG5450/MG5550/MG5650/MG6350/MG6450/MG6650/ MG7150 /MG7550/ Ip7250/MX925/MX725/IX6850/IP8750</h4>
                <button onclick="addToCart(360)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CL551BK">
                <h3>CL551BK</h3>
                <h3>95 DA</h3>
                <h4>Cartouche canon PIXMA MG5450/MG5550/MG5650/MG6350/MG6450/MG6650/ MG7150 /MG7550/ Ip7250/MX925/MX725/IX6850/IP8750</h4>
                <button onclick="addToCart(361)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CCPGI-1500 B">
                <h3>CCPGI-1500 B</h3>
                <h3>450 DA</h3>
                <h4>Canon MAXIFY MB2050, MB2150, MB2155, MB2350, MB2750, MB2755, Canon MB 2050, 2150, 2155, 2350, 2750, 2755.</h4>
                <button onclick="addToCart(362)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CCPGI-1500 C">
                <h3>CCPGI-1500 C</h3>
                <h3>450 DA</h3>
                <h4>Canon MAXIFY MB2050, MB2150, MB2155, MB2350, MB2750, MB2755, Canon MB 2050, 2150, 2155, 2350, 2750, 2755.</h4>
                <button onclick="addToCart(363)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CCPGI-1500 M">
                <h3>CCPGI-1500 M</h3>
                <h3>450 DA</h3>
                <h4>Canon MAXIFY MB2050, MB2150, MB2155, MB2350, MB2750, MB2755, Canon MB 2050, 2150, 2155, 2350, 2750, 2755.</h4>
                <button onclick="addToCart(364)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CCPGI-1500 Y">
                <h3>CCPGI-1500 Y</h3>
                <h3>450 DA</h3>
                <h4>Canon MAXIFY MB2050, MB2150, MB2155, MB2350, MB2750, MB2755, Canon MB 2050, 2150, 2155, 2350, 2750, 2755.</h4>
                <button onclick="addToCart(365)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C24BK-N C24C-C">
                <h3>C24BK-N C24C-C</h3>
                <h3>15 DA</h3>
                <h4>CANON IP1000/IP1500/I450/Ip2000   </h4>
                <button onclick="addToCart(366)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C3E B/C/M/Y">
                <h3>C3E B/C/M/Y</h3>
                <h3>15 DA</h3>
                <h4>CANON BJC 3000/6000/S400/S450…</h4>
                <button onclick="addToCart(367)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CLI8 BC/M/Y">
                <h3>CLI8 BC/M/Y</h3>
                <h3>49 DA</h3>
                <h4>IP3300/ip3500ip4200/4500/ip5200/ ip4000/ip5000/mp500/mp600</h4>
                <button onclick="addToCart(368)">Ajouter au panier</button>
            </div>
            <!--cartouche brother-->
            <div class="product">
                <img src="" alt="CB11/16 B">
                <h3>CB11/16 B</h3>
                <h3>230 DA</h3>
                <h4>BROTHER DCP-J195C/185c/165cCB11/16/38/39/60/61/65/67/975/980/985/990 /1100</h4>
                <button onclick="addToCart(369)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB11/16 C">
                <h3>CB11/16 C</h3>
                <h3>230 DA</h3>
                <h4>BROTHER DCP-J195C/185c/165cCB11/16/38/39/60/61/65/67/975/980/985/990 /1100</h4>
                <button onclick="addToCart(370)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB11/16 M">
                <h3>CB11/16 M</h3>
                <h3>230 DA</h3>
                <h4>BROTHER DCP-J195C/185c/165cCB11/16/38/39/60/61/65/67/975/980/985/990 /1100</h4>
                <button onclick="addToCart(371)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB11/16 Y">
                <h3>CB11/16 Y</h3>
                <h3>230 DA</h3>
                <h4>BROTHER DCP-J195C/185c/165cCB11/16/38/39/60/61/65/67/975/980/985/990 /1100</h4>
                <button onclick="addToCart(372)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB12 B/C/M/Y">
                <h3>CB12 B/C/M/Y</h3>
                <h3>89 DA</h3>
                <h4>BROTHER DCP-J525/J725/J925/J5910DW/J6510D CB12/71/73/75/400/1220/1240</h4>
                <button onclick="addToCart(373)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB39/985 B/C/M/Y">
                <h3>CB39/985 B/C/M/Y</h3>
                <h3>75 DA</h3>
                <h4>BROTHER DCP-J125/J315W/J515W/J540W  MFC-J265W/J410/J415W/J220</h4>
                <button onclick="addToCart(374)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB103 BK/C/M/Y">
                <h3>CB103 BK/C/M/Y</h3>
                <h3>79 DA</h3>
                <h4>Brother MFC-J4310DW/J4410DW/J4510DW/J4610DW/J4710DW/J6520DW J470DW/J475DW/J650DW /J870DW/J875DW / J6920DW/      
                    DCP-J152W MFC-J245/J450DW/J6720DW</h4>
                <button onclick="addToCart(375)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB123BK/121 B">
                <h3>CB123BK/121 B</h3>
                <h3>370 DA</h3>
                <h4>Brother MFC-J4410DW/J4510DW/J4610DW/J4710DW/J470DW/ J6920DW    Brother DCP-J4110DW/J132W/J152W/J552DW/J752DW</h4>
                <button onclick="addToCart(376)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB123BK/121 C">
                <h3>CB123BK/121 C</h3>
                <h3>370 DA</h3>
                <h4>Brother MFC-J4410DW/J4510DW/J4610DW/J4710DW/J470DW/ J6920DW    Brother DCP-J4110DW/J132W/J152W/J552DW/J752DW</h4>
                <button onclick="addToCart(377)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB123BK/121 M">
                <h3>CB123BK/121 M</h3>
                <h3>370 DA</h3>
                <h4>Brother MFC-J4410DW/J4510DW/J4610DW/J4710DW/J470DW/ J6920DW    Brother DCP-J4110DW/J132W/J152W/J552DW/J752DW</h4>
                <button onclick="addToCart(378)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB123BK/121 Y">
                <h3>CB123BK/121 Y</h3>
                <h3>370 DA</h3>
                <h4>Brother MFC-J4410DW/J4510DW/J4610DW/J4710DW/J470DW/ J6920DW    Brother DCP-J4110DW/J132W/J152W/J552DW/J752DW</h4>
                <button onclick="addToCart(379)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB221/223 BK">
                <h3>CB221/223 BK</h3>
                <h3>159 DA</h3>
                <h4>Brother MFC-J4420DW/J4620DW/J4625DW/J5320DW/J5625DW /J5720DW /J480DW/ J680DW/J880DW/ Brother DCP-J4120DW/J562DW</h4>
                <button onclick="addToCart(380)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB221/223 C">
                <h3>CB221/223 C</h3>
                <h3>159 DA</h3>
                <h4>Brother MFC-J4420DW/J4620DW/J4625DW/J5320DW/J5625DW /J5720DW /J480DW/ J680DW/J880DW/  Brother DCP-J4120DW/J562DW</h4>
                <button onclick="addToCart(381)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB221/223 M">
                <h3>CB221/223 M</h3>
                <h3>159 DA</h3>
                <h4>Brother MFC-J4420DW/J4620DW/J4625DW/J5320DW/J5625DW /J5720DW /J480DW/ J680DW/J880DW/ Brother DCP-J4120DW/J562DW</h4>
                <button onclick="addToCart(382)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB221/223 Y">
                <h3>CB221/223 Y</h3>
                <h3>159 DA</h3>
                <h4>Brother MFC-J4420DW/J4620DW/J4625DW/J5320DW/J5625DW /J5720DW /J480DW/ J680DW/J880DW/ Brother DCP-J4120DW/J562DW</h4>
                <button onclick="addToCart(383)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB3213">
                <h3>CB3213</h3>
                <h3>430 DA</h3>
                <h4>Brother DCP J572DW, J770 Series, J772DW, J774DW, Brother MFC J491DW, J497DW, J890 Series, J890DW, J895DW.</h4>
                <button onclick="addToCart(384)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB3219BK/C/M/Y">
                <h3>CB3219BK/C/M/Y</h3>
                <h3>490 DA</h3>
                <h4>Brother MFC- J5330DW-J5335DW-J5730DW-J5930DW</h4>
                <button onclick="addToCart(385)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `cartouche.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
