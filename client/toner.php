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
    header('Location: toner.php');
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
    <title>TONER COMPATIBLE</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
    <div class="products-container">
        <div class =products>
            <!--toner hp laser monochrome-->
            <div class="product">
                <img src="" alt="HP W1106A">
                <h3>HP W1106A</h3>
                <h3>2990 DA</h3>
                <h4>LaserJet 107 Series, 107a, 107w, MFP 130 Series, MFP 135a, MFP 137fnw, MFP 138fnw.</h4>
                <button onclick="addToCart(386)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP W1107A">
                <h3>HP W1107A</h3>
                <h3>2990 DA</h3>
                <h4>LaserJet 107 Series, 107a, 107w, MFP 130 Series, MFP 135a, MFP 137fnw, MFP 138fnw.</h4>
                <button onclick="addToCart(387)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF217">
                <h3>CF217</h3>
                <h3>1290 DA</h3>
                <h4>TONER HP LaserJet Pro M102w, HP LaserJet Pro MFP M130fn/M130fw/M130nw/M130a</h4>
                <button onclick="addToCart(388)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF226A">
                <h3>CF226A</h3>
                <h3>1490 DA</h3>
                <h4>TONER HP LaserJet Pro M400/M402dn/M402dw/M402n, HP LaserJet Pro MFP M426fdn/M426fdw</h4>
                <button onclick="addToCart(389)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF230/CRG051">
                <h3>CF230/CRG051</h3>
                <h3>1390 DA</h3>
                <h4>TONER HP LaserJet Pro M203d/M203dn/M203dw, HP LaserJet Pro MFP M227fdn/M227fdw/M227sdn, CANON MageClass lbp162dw</h4>
                <button onclick="addToCart(390)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF244">
                <h3>CF244</h3>
                <h3>Arr</h3>
                <h4>LBP</h4>
                <button onclick="addToCart(391)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE255">
                <h3>CE255</h3>
                <h3>Arr</h3>
                <h4>TONER HP Laserjet Enterprise P3015/P3015d/P3015dn/P3015x, CANON LBP6750dn</h4>
                <button onclick="addToCart(392)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE260A">
                <h3>CE260A</h3>
                <h3>4900 DA</h3>
                <h4>TONER HP CM 4540, CM4540 MFP, HP Color LaserJet CM4540, CM4540 MFP, CM4540f, CM4540fskm, CP4025, CP4520, CP4525, CP4525xh, HP ColorJet Enterprise CM4540, HP CP 4025, 4525, HP LaserJet Enterprise CM4540 mfp.</h4>
                <button onclick="addToCart(393)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF279A">
                <h3>CF279A</h3>
                <h3>Arr</h3>
                <h4>TONER HP laserJet Pro M12a/M12w/MFPM26a/MFPM26nw</h4>
                <button onclick="addToCart(394)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF283X/LC137/337/737">
                <h3>CF283X/LC137/337/737</h3>
                <h3>1290 DA</h3>
                <h4>TONER HP LaserJet Pro MFP M125/M125nw/M125rnw/M127fn/M127fw/M127fp, HP LaserJet Pro M201n/M201dw/Pro MFP M225dn/M225dw, CANON i-SENSYS F211w/MF212w/MF216n/MF217w/MF226dn/MF229dw, CANON image CLASS MF215</h4>
                <button onclick="addToCart(395)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE435/436/285/CE278">
                <h3>CE435/436/285/CE278</h3>
                <h3>1290 DA</h3>
                <h4>CANON i-Sensys LBP6200, LBP6230dw, MF4410, MF4430, MF4450, MF4500 Series, MF4550, MF4550d, MF4570, MF4570dn, MF4580, MF4580dn, MF4730, MF4750, MF-4870dn, Canon LBP 6200d, Canon MF 4410, 4430, 4450, 4500 Series, 4550, 4550d, 4570, 4570dn, 4580, 4580dn, Fax L150, Fax L170, FAX L410D, TONER HP LaserJet P1566, P1606, P1606dn, HP LaserJet Pro M1536, M1536dnf, HP P 1566, 1606, 1606dn.</h4>
                <button onclick="addToCart(396)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB436A">
                <h3>CB436A</h3>
                <h3>890 DA</h3>
                <h4>Canon i-Sensys LBP3250, Canon LBP 3250, HP LaserJet M1120, M1120 mfp, M1120n, M1522 mfp, M1522n, M1522nf, P1505, P1505N, P1506, TONER HP M 1120, 1120 mfp, 1120N, 1522 mfp, 1522N, 1522NF, HP P 1505, 1505N, 1506.</h4>
                <button onclick="addToCart(397)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE390A">
                <h3>CE390A</h3>
                <h3>3200 DA</h3>
                <h4>TONER HP LaserJet M4555MFP/M601/M601n/M602n/M602dn/M602x/M603/M603n/M603dn/M603xh</h4>
                <button onclick="addToCart(398)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE505A/280A">
                <h3>CE505A/280A</h3>
                <h3>1390 DA</h3>
                <h4>HP LaserJet P2030 series, P2035, P2035N, P2050 series, P2055, P2055D, P2055DN, P2055X, HP P 2030 series, 2035, 2035N, 2050 series, 2055, 2055D, 2055DN, 2055X, Canon i-Sensys LBP6300dn, LBP6310dn, LBP6650dn, LBP6670dn, MF411dw, MF416dw, MF418x, MF419x, MF5840dn, MF5880dn, MF5940dn, MF5980dw, MF6140dn, MF6180dw, Canon LBP 251dw, 252dw, 253x, 6300dn, 6650dn, Canon MF 411dw, 416dw, 418x, 419x, 5840dn, 5880dn, 6140dn, 6180dw.</h4>
                <button onclick="addToCart(399)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q1339A">
                <h3>Q1339A</h3>
                <h3>3290 DA</h3>
                <h4>HP LaserJet P4300 (12000 pages)</h4>
                <button onclick="addToCart(400)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2612A/FX10">
                <h3>Q2612A/FX10</h3>
                <h3>1290 DA</h3>
                <h4>CANON LBP 2900/3000/MF4010/4120/4122/4150/6570/FX10, LaserJet HP 1010, HP LaserJet 1010, 1010W, 1012, 1012W, 1015, 1015W, 1018, 1020, 1022, 3015, 3020, 3030, 3050, 3052, 3055, M1005, M1319f, HP M 1005, 1319F</h4>
                <button onclick="addToCart(401)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2613A">
                <h3>Q2613A</h3>
                <h3>1190 DA</h3>
                <h4>LaserJet HP 1300 SERIES</h4>
                <button onclick="addToCart(402)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2624A">
                <h3>Q2624A</h3>
                <h3>1190 DA</h3>
                <h4>HP LaserJet 1150 (6000 Pages)</h4>
                <button onclick="addToCart(403)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C3906A">
                <h3>C3906A</h3>
                <h3>1190 DA</h3>
                <h4>Canon LBP 440, 460, 465, 660, 665, AX, HP LaserJet 3100 Series, 3100XI, 3150, 3150 Series, 3150XI, 5L, 5L Xtra, 5LFS, 5ML, 6L, 6L Series, 6LXI, ML, Plus</h4>
                <button onclick="addToCart(404)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C4092A EP22">
                <h3>C4092A EP22</h3>
                <h3>1590 DA</h3>
                <h4>HP LaserJet 1100/1100SE/1100XI/1100A/1100A SE/1100A XI/3200/3200SE, Canon LBP-800/810/1110/1120</h4>
                <button onclick="addToCart(405)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C4096A">
                <h3>C4096A</h3>
                <h3>1790 DA</h3>
                <h4>Canon LBP 1000, 32X, Canon P 100, HP LaserJet 2000, 2100, 2100M, 2100N, 2100SE, 2100T, 2100TN, 2100XI, 2200, 2200D, 2200DN, 2200DSE, 2200DT, 2200DTN, 2200N</h4>
                <button onclick="addToCart(406)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C4127A/EP52">
                <h3>C4127A/EP52</h3>
                <h3>2950 DA</h3>
                <h4>Toner HP LaserJet 4000, 4000N, 4000T, 4000TN, 4000se, 4050, 4050N, 4050T, 4050TN, 4050se, CANON LBP-1760, 1760e, 52X, BROTHER HL-2460, HL-2460N</h4>
                <button onclick="addToCart(407)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C4129/EP62">
                <h3>C4129/EP62</h3>
                <h3>3290 DA</h3>
                <h4>Toner HP LaserJet 5000/5000g/5000GN/5000LE/5100/5100DTN/5100TN, Canon LBP-840/850/870/880/910/1610/1620/1810/1820, Canon Image Class 2200/2210/2220/LP-3000/3010</h4>
                <button onclick="addToCart(408)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C4182/EP27">
                <h3>C4182/EP27</h3>
                <h3>3290 DA</h3>
                <h4>Toner HP LaserJet 8100, 8100DN, 8100N, 8150, 8150 MFP, 8150dn, 8150hn, 8150n, Mopier 320, CANON ImageCLASS 4000, 4000E, 4000ED, ImageRUNNER 3250, LBP-1910, 3260, 72X, 950</h4>
                <button onclick="addToCart(409)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q5949A/Q7553A">
                <h3>Q5949A/Q7553A</h3>
                <h3>1890 DA</h3>
                <h4>HP LaserJet 1160/1320/3390/3392 HP LaserJet P2010/P2015/P2014/M2727NF, CANON LBP 3300/LBP3310/3360/3370</h4>
                <button onclick="addToCart(410)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q6511X">
                <h3>Q6511X</h3>
                <h3>3900 DA</h3>
                <h4>Canon i-Sensys LBP3460, Canon LBP 3460, HP LaserJet 2410, 2420, 2420D, 2420DN, 2420DTN, 2420N, 2420TN, 2430, 2430DTN, 2430T, 2430TN</h4>
                <button onclick="addToCart(411)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C7115A">
                <h3>C7115A</h3>
                <h3>1290 DA</h3>
                <h4>HP LaserJet 1000/1005/1200/1200N/1200SE/1220/1220SE/3300MFP/3320n MFP/3320MFP/3330 MFP, Canon LBP 1210</h4>
                <button onclick="addToCart(412)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q7551A">
                <h3>Q7551A</h3>
                <h3>2490 DA</h3>
                <h4>HP LaserJet M3027, M3027 mfp, M3027x, M3035, M3035 mfp, M3035xs, P3005, P3005d, P3005dn, P3005n, P3005X, P3005xdtn, HP M 3027, 3027 mfp, 3035, 3035 mfp, HP P 3005, 3005D, 3005DN, 3005N, 3005X, 3005XDTN</h4>
                <button onclick="addToCart(413)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C8061A">
                <h3>C8061A</h3>
                <h3>2190 DA</h3>
                <h4>HP LaserJet 4100, 4100MFP, 4100dtn, 4100n, 4100tn, 4101MFP</h4>
                <button onclick="addToCart(414)">Ajouter au panier</button>
            </div>
            <!--toner hp laser couleur-->
            <div class="product">
                <img src="" alt="CE250X /251/252/253  B">
                <h3>CE250X /251/252/253  B</h3>
                <h3>4490 DA</h3>
                <h4>Toner HP Color LaserJet CP3525/CP3525X/CP3525DN/CP3525N/CM3530/CM3530FS</h4>
                <button onclick="addToCart(415)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE250X /251/252/253  C">
                <h3>CE250X /251/252/253  C</h3>
                <h3>4490 DA</h3>
                <h4>Toner HP Color LaserJet CP3525/CP3525X/CP3525DN/CP3525N/CM3530/CM3530FS</h4>
                <button onclick="addToCart(416)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE250X /251/252/253  M">
                <h3>CE250X /251/252/253  M</h3>
                <h3>4490 DA</h3>
                <h4>Toner HP Color LaserJet CP3525/CP3525X/CP3525DN/CP3525N/CM3530/CM3530FS</h4>
                <button onclick="addToCart(417)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE250X /251/252/253  Y">
                <h3>CE250X /251/252/253  Y</h3>
                <h3>4490 DA</h3>
                <h4>Toner HP Color LaserJet CP3525/CP3525X/CP3525DN/CP3525N/CM3530/CM3530FS</h4>
                <button onclick="addToCart(418)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE310/CF350A   (C729)">
                <h3>CE310/CF350A   (C729)</h3>
                <h3>1290 DA</h3>
                <h4>HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot. Laser Canon i-Sensys LBP7010C, LBP7018C</h4>
                <button onclick="addToCart(419)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE311-312-313">
                <h3>CE311-312-313</h3>
                <h3>1290 DA</h3>
                <h4>HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot. Laser Canon i-Sensys LBP7010C, LBP7018C</h4>
                <button onclick="addToCart(420)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE320A">
                <h3>CE320A</h3>
                <h3>1490 DA</h3>
                <h4>LaserJet laser HP CM 1415, 1415fn, 1415fnw, 1415fw, HP CP 1525, 1525n, 1525nw, HP LaserJet Pro CM1415, CM1415fn, CM1415fnw, CM1415fw, CP1525, CP1525n, CP1525nw, HP Pro 1415fnw, CM1415, CM1415fn, CM1415fw, CP1525, CP1525n, CP1525nw.</h4>
                <button onclick="addToCart(421)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE321-322-323">
                <h3>CE321-322-323</h3>
                <h3>1490 DA</h3>
                <h4>LaserJet laser HP CM 1415, 1415fn, 1415fnw, 1415fw, HP CP 1525, 1525n, 1525nw, HP LaserJet Pro CM1415, CM1415fn, CM1415fnw, CM1415fw, CP1525, CP1525n, CP1525nw, HP Pro 1415fnw, CM1415, CM1415fn, CM1415fw, CP1525, CP1525n, CP1525nw.</h4>
                <button onclick="addToCart(422)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF400/CANON 045">
                <h3>CF400/CANON 045</h3>
                <h3>2090 DA</h3>
                <h4>HP LaserJet Enterprise 500, M551, M551dn, M551n, M551xh, M575c. Canon i-Sensys LBP610C, LBP611, LBP611Cn, LBP612, LBP613, LBP613Cdw, MF630/MF631/MF632/MF633</h4>
                <button onclick="addToCart(423)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF401/402/403">
                <h3>CF401/402/403</h3>
                <h3>2090 DA</h3>
                <h4>HP LaserJet Enterprise 500, M551, M551dn, M551n, M551xh, M575c. Canon i-Sensys LBP610C, LBP611, LBP611Cn, LBP612, LBP613, LBP613Cdw, MF630/MF631/MF632/MF633</h4>
                <button onclick="addToCart(424)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE400/CE205A">
                <h3>CE400/CE205A</h3>
                <h3>4990 DA</h3>
                <h4>LaserJet Enterprise 500, M551, M551dn, M551n, M551xh, M575c</h4>
                <button onclick="addToCart(425)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CE401/402/403">
                <h3>CE401/402/403</h3>
                <h3>4990 DA</h3>
                <h4>LaserJet Enterprise 500, M551, M551dn, M551n, M551xh, M575c</h4>
                <button onclick="addToCart(426)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF510A">
                <h3>CF510A</h3>
                <h3>1890 DA</h3>
                <h4>HP laserjet Pro M154A/M154nw/M180/M181/M181fw</h4>
                <button onclick="addToCart(427)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF511">
                <h3>CF511</h3>
                <h3>1890 DA</h3>
                <h4>HP laserjet Pro M154A/M154nw/M180/M181/M181fw</h4>
                <button onclick="addToCart(428)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF512">
                <h3>CF512</h3>
                <h3>1890 DA</h3>
                <h4>HP laserjet Pro M154A/M154nw/M180/M181/M181fw</h4>
                <button onclick="addToCart(429)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF513">
                <h3>CF513</h3>
                <h3>1890 DA</h3>
                <h4>HP laserjet Pro M154A/M154nw/M180/M181/M181fw</h4>
                <button onclick="addToCart(430)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC530A">
                <h3>CC530A/CE410A/CF380/C718</h3>
                <h3>1690 DA</h3>
                <h4>HP Color LaserJet CP2020/CP2025/CM2320, HP LaserJet 2410, 2420, 2420d, 2420dn, 2420n, 2430dtn, 2430tn, 2430n, Pro 300 M351a, 300 MFP M375nw, 400 M451dn, 400 M451dw, 400 M451nw, 400 MFP M475dn, 400 MFP M475dw, Canon LBP 7200/7200cn/iC MF8330/8350Cdn</h4>
                <button onclick="addToCart(431)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC531">
                <h3>CC531</h3>
                <h3>1690 DA</h3>
                <h4>HP Color LaserJet CP2020/CP2025/CM2320, HP LaserJet 2410, 2420, 2420d, 2420dn, 2420n, 2430dtn, 2430tn, 2430n, Pro 300 M351a, 300 MFP M375nw, 400 M451dn, 400 M451dw, 400 M451nw, 400 MFP M475dn, 400 MFP M475dw, Canon LBP 7200/7200cn/iC MF8330/8350Cdn</h4>
                <button onclick="addToCart(432)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC532">
                <h3>CC532</h3>
                <h3>1690 DA</h3>
                <h4>HP Color LaserJet CP2020/CP2025/CM2320, HP LaserJet 2410, 2420, 2420d, 2420dn, 2420n, 2430dtn, 2430tn, 2430n, Pro 300 M351a, 300 MFP M375nw, 400 M451dn, 400 M451dw, 400 M451nw, 400 MFP M475dn, 400 MFP M475dw, Canon LBP 7200/7200cn/iC MF8330/8350Cdn</h4>
                <button onclick="addToCart(433)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CC533">
                <h3>CC533</h3>
                <h3>1690 DA</h3>
                <h4>HP Color LaserJet CP2020/CP2025/CM2320, HP LaserJet 2410, 2420, 2420d, 2420dn, 2420n, 2430dtn, 2430tn, 2430n, Pro 300 M351a, 300 MFP M375nw, 400 M451dn, 400 M451dw, 400 M451nw, 400 MFP M475dn, 400 MFP M475dw, Canon LBP 7200/7200cn/iC MF8330/8350Cdn</h4>
                <button onclick="addToCart(434)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF530HP205A">
                <h3>CF530HP205A</h3>
                <h3>2290 DA</h3>
                <h4>LaserJet Pro M154, M180, M180n, M180nw, M181, M181fw</h4>
                <button onclick="addToCart(435)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CF531/532/533">
                <h3>CF531/532/533</h3>
                <h3>2290 DA</h3>
                <h4>LaserJet Pro M154, M180, M180n, M180nw, M181, M181fw</h4>
                <button onclick="addToCart(436)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB540A/CE320A/CF210/LC131/331/731A">
                <h3>CB540A/CE320A/CF210/LC131/331/731A</h3>
                <h3>1950 DA</h3>
                <h4>HP Color LaserJet CP1213/CP1214/CP1215/CP1216/CP1217/CP1513n/CP1514n, HP Color LaserJet CM1300MFP/CM1312MFP Series, HP LaserJet Pro 200 color M251nw, HP LaserJet Pro 200 color M276n/nw, CP1522/CP1523/CP1525/CP1525nw/CP1526nw/CP1527nw/CP1528nw, Canon LBP5050/8050/MF8230CN</h4>
                <button onclick="addToCart(437)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB541">
                <h3>CB541</h3>
                <h3>1950 DA</h3>
                <h4>HP Color LaserJet CP1213/CP1214/CP1215/CP1216/CP1217/CP1513n/CP1514n, HP Color LaserJet CM1300MFP/CM1312MFP Series, HP LaserJet Pro 200 color M251nw, HP LaserJet Pro 200 color M276n/nw, CP1522/CP1523/CP1525/CP1525nw/CP1526nw/CP1527nw/CP1528nw, Canon LBP5050/8050/MF8230CN</h4>
                <button onclick="addToCart(438)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB542">
                <h3>CB542</h3>
                <h3>1950 DA</h3>
                <h4>HP Color LaserJet CP1213/CP1214/CP1215/CP1216/CP1217/CP1513n/CP1514n, HP Color LaserJet CM1300MFP/CM1312MFP Series, HP LaserJet Pro 200 color M251nw, HP LaserJet Pro 200 color M276n/nw, CP1522/CP1523/CP1525/CP1525nw/CP1526nw/CP1527nw/CP1528nw, Canon LBP5050/8050/MF8230CN</h4>
                <button onclick="addToCart(439)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CB543">
                <h3>CB543</h3>
                <h3>1950 DA</h3>
                <h4>HP Color LaserJet CP1213/CP1214/CP1215/CP1216/CP1217/CP1513n/CP1514n, HP Color LaserJet CM1300MFP/CM1312MFP Series, HP LaserJet Pro 200 color M251nw, HP LaserJet Pro 200 color M276n/nw, CP1522/CP1523/CP1525/CP1525nw/CP1526nw/CP1527nw/CP1528nw, Canon LBP5050/8050/MF8230CN</h4>
                <button onclick="addToCart(440)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2670">
                <h3>Q2670</h3>
                <h3>3790 DA</h3>
                <h4>TONER HP Color LaserJet 3500/3500n/3550, HP Color LaserJet 3700/3700n/3700dn/3700dtn</h4>
                <button onclick="addToCart(441)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2671">
                <h3>Q2671</h3>
                <h3>3790 DA</h3>
                <h4>TONER HP Color LaserJet 3500/3500n/3550, HP Color LaserJet 3700/3700n/3700dn/3700dtn</h4>
                <button onclick="addToCart(442)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2672">
                <h3>Q2672</h3>
                <h3>3790 DA</h3>
                <h4>TONER HP Color LaserJet 3500/3500n/3550, HP Color LaserJet 3700/3700n/3700dn/3700dtn</h4>
                <button onclick="addToCart(443)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q2673">
                <h3>Q2673</h3>
                <h3>3790 DA</h3>
                <h4>TONER HP Color LaserJet 3500/3500n/3550, HP Color LaserJet 3700/3700n/3700dn/3700dtn</h4>
                <button onclick="addToCart(444)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="HP3960 BLACK">
                <h3>HP3960 BLACK</h3>
                <h3>2900 DA</h3>
                <h4>HP Color LaserJet 2550L/2550Ln/2550n, HP Color LaserJet 2820/2840/2830, Canon LBP 5200</h4>
                <button onclick="addToCart(445)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q6000 BCMY">
                <h3>Q6000 BCMY</h3>
                <h3>1990 DA</h3>
                <h4>HP Color LaserJet 1600, 2600, 2600N, 2605, 2605DN, 2605DTN, CM1015, CM1017, HP LaserJet 1600, 2600, 2600N, Canon LBP 5000, 5100, HP CM 1015, 1017</h4>
                <button onclick="addToCart(446)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q6001 BCMY">
                <h3>Q6001 BCMY</h3>
                <h3>1990 DA</h3>
                <h4>HP Color LaserJet 1600, 2600, 2600N, 2605, 2605DN, 2605DTN, CM1015, CM1017, HP LaserJet 1600, 2600, 2600N, Canon LBP 5000, 5100, HP CM 1015, 1017</h4>
                <button onclick="addToCart(447)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q6002 BCMY">
                <h3>Q6002 BCMY</h3>
                <h3>1990 DA</h3>
                <h4>HP Color LaserJet 1600, 2600, 2600N, 2605, 2605DN, 2605DTN, CM1015, CM1017, HP LaserJet 1600, 2600, 2600N, Canon LBP 5000, 5100, HP CM 1015, 1017</h4>
                <button onclick="addToCart(448)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="Q6003 BCMY">
                <h3>Q6003 BCMY</h3>
                <h3>1990 DA</h3>
                <h4>HP Color LaserJet 1600, 2600, 2600N, 2605, 2605DN, 2605DTN, CM1015, CM1017, HP LaserJet 1600, 2600, 2600N, Canon LBP 5000, 5100, HP CM 1015, 1017</h4>
                <button onclick="addToCart(449)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C6460 BCMY">
                <h3>C6460 BCMY</h3>
                <h3>5500 DA</h3>
                <h4>HP Color LaserJet 4730mfp/4730xmfp, HP Color LaserJet CM4730f/CM4730fm/CM4730fsk</h4>
                <button onclick="addToCart(450)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C6461 BCMY">
                <h3>C6461 BCMY</h3>
                <h3>5500 DA</h3>
                <h4>HP Color LaserJet 4730mfp/4730xmfp, HP Color LaserJet CM4730f/CM4730fm/CM4730fsk</h4>
                <button onclick="addToCart(451)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C6462 BCMY">
                <h3>C6462 BCMY</h3>
                <h3>5500 DA</h3>
                <h4>HP Color LaserJet 4730mfp/4730xmfp, HP Color LaserJet CM4730f/CM4730fm/CM4730fsk</h4>
                <button onclick="addToCart(452)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C6463 BCMY">
                <h3>C6463 BCMY</h3>
                <h3>5500 DA</h3>
                <h4>HP Color LaserJet 4730mfp/4730xmfp, HP Color LaserJet CM4730f/CM4730fm/CM4730fsk</h4>
                <button onclick="addToCart(453)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C9720 BCMY">
                <h3>C9720 BCMY</h3>
                <h3>5900 DA</h3>
                <h4>HP Color LaserJet 4600/4600n/4600dn/4600dtn/4610n, HP Color LaserJet 4650/4650n/4650dn/4650dtn/4650hdn, Canon LBP 2510</h4>
                <button onclick="addToCart(454)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C9721 BCMY">
                <h3>C9721 BCMY</h3>
                <h3>5900 DA</h3>
                <h4>HP Color LaserJet 4600/4600n/4600dn/4600dtn/4610n, HP Color LaserJet 4650/4650n/4650dn/4650dtn/4650hdn, Canon LBP 2510</h4>
                <button onclick="addToCart(455)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C9722 BCMY">
                <h3>C9722 BCMY</h3>
                <h3>5900 DA</h3>
                <h4>HP Color LaserJet 4600/4600n/4600dn/4600dtn/4610n, HP Color LaserJet 4650/4650n/4650dn/4650dtn/4650hdn, Canon LBP 2510</h4>
                <button onclick="addToCart(456)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C9723 BCMY">
                <h3>C9723 BCMY</h3>
                <h3>5900 DA</h3>
                <h4>HP Color LaserJet 4600/4600n/4600dn/4600dtn/4610n, HP Color LaserJet 4650/4650n/4650dn/4650dtn/4650hdn, Canon LBP 2510</h4>
                <button onclick="addToCart(457)">Ajouter au panier</button>
            </div>
            <!--toner canon-->
            <div class="product">
                <img src="" alt="CRG047">
                <h3>CRG047</h3>
                <h3>1390 DA</h3>
                <h4>TONER CANON LBP110/LBP112/LBP113/LBP113W</h4>
                <button onclick="addToCart(458)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CRG052">
                <h3>CRG052</h3>
                <h3>1690 DA</h3>
                <h4>TONER CANON LBP212DW/LBP214DW/LBP215X</h4>
                <button onclick="addToCart(459)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CRG054 BK/C/M/Y">
                <h3>CRG054 BK/C/M/Y</h3>
                <h3>0 DA</h3>
                <h4>TONER CANON LASER MF541/643/645 LBP621/623</h4>
                <button onclick="addToCart(460)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CRG057 BK/C/M/Y">
                <h3>CRG057 BK/C/M/Y</h3>
                <h3>1990 DA</h3>
                <h4>Canon i-Sensys LBP220 Series, LBP223dw, LBP226dw, LBP228dw, LBP228x, MF440 Series, MF443dw, MF445dw, MF446x, MF449dw, MF449x.</h4>
                <button onclick="addToCart(461)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV5 NPG-20/GPR-8">
                <h3>EXV5 NPG-20/GPR-8</h3>
                <h3>1190 DA</h3>
                <h4>TONER CANON IR1600/1610F/2000/2010F/2016/2016i/2018/2018i/2020/2020i/2022/2022i/2025i/2030i</h4>
                <button onclick="addToCart(462)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV14/EXV5/GPR-18/NPG-28">
                <h3>EXV14/EXV5/GPR-18/NPG-28</h3>
                <h3>1190 DA</h3>
                <h4>Canon imageRUNNER 2016, 2016i, 2016j, 2018i, 2020, 2022, 2025, 2030, 2318, 2420, 2422, Canon IR 2016, 2016i, 2016j, 2018i, 2020, 2022, 2025, 2030, 2318, 2420, 2422.</h4>
                <button onclick="addToCart(463)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV18/GPR-22/NPG-32">
                <h3>EXV18/GPR-22/NPG-32</h3>
                <h3>1490 DA</h3>
                <h4>Toner Canon IR1018/1018J/1022A/1022F/1022I/1022iF/1023/1023N/1023iF/1024A/1024F/1024I/1024IF</h4>
                <button onclick="addToCart(464)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV33/NPG51/GPR35">
                <h3>EXV33/NPG51/GPR35</h3>
                <h3>1590 DA</h3>
                <h4>TONER Canon image RUNNER 2520/2520i/2525/2525i/2530/2530i</h4>
                <button onclick="addToCart(465)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV36/NPG54/GPR38">
                <h3>EXV36/NPG54/GPR38</h3>
                <h3>6990 DA</h3>
                <h4>Toner Canon IR6055/6255</h4>
                <button onclick="addToCart(466)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV40">
                <h3>EXV40</h3>
                <h3>1390 DA</h3>
                <h4>Toner Canon imageRUNNER 1133, 1133A, 1133IF Canon IR 1133, 1133A, 1133iF.</h4>
                <button onclick="addToCart(467)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E-XV42/NPG-59/GPR45">
                <h3>E-XV42/NPG-59/GPR45</h3>
                <h3>1190 DA</h3>
                <h4>TONER Canon image RUNNER IR2202DN/2202N/2202L/2002G/2002L/IR2204F</h4>
                <button onclick="addToCart(468)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EXV60">
                <h3>EXV60</h3>
                <h3>1590 DA</h3>
                <h4>TONER Canon image RUNNER IR2425</h4>
                <button onclick="addToCart(469)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TC045 BCMY">
                <h3>TC045 BCMY</h3>
                <h3>0 DA</h3>
                <h4>Canon i-Sensys LBP610C Series, LBP611, LBP611Cn, LBP612, LBP613, LBP613Cdw, MF630C Series, MF631, MF631Cn, MF632, MF633, MF633Cdw, MF634, MF635, MF635Cx.</h4>
                <button onclick="addToCart(470)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TC119">
                <h3>TC119</h3>
                <h3>1690 DA</h3>
                <h4>Canon i-Sensys LBP6300dn, LBP6310dn, LBP6650dn, LBP6670dn, MF411dw, MF416dw, MF418x, MF419x, MF5840dn, MF5880dn, MF5940dn, MF5980dw, MF6140dn, MF6180dw, Canon LBP 251dw, 252dw, 253x, 6300dn, 6650dn, Canon MF 411dw, 416dw, 418x, 419x, 5840dn, 5880dn, 6140dn, 6180dw, HP LaserJet P2050 series, P2055, P2055D, P2055DN, P2055X, HP P 2050 series, 2055, 2055D, 2055DN, 2055X.</h4>
                <button onclick="addToCart(471)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TC319">
                <h3>TC319</h3>
                <h3>1690 DA</h3>
                <h4>Canon i-Sensys LBP6300dn, LBP6310dn, LBP6650dn, LBP6670dn, MF411dw, MF416dw, MF418x, MF419x, MF5840dn, MF5880dn, MF5940dn, MF5980dw, MF6140dn, MF6180dw, Canon LBP 251dw, 252dw, 253x, 6300dn, 6650dn, Canon MF 411dw, 416dw, 418x, 419x, 5840dn, 5880dn, 6140dn, 6180dw, HP LaserJet P2050 series, P2055, P2055D, P2055DN, P2055X, HP P 2050 series, 2055, 2055D, 2055DN, 2055X.</h4>
                <button onclick="addToCart(472)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TC719H">
                <h3>TC719H</h3>
                <h3>1690 DA</h3>
                <h4>Canon i-Sensys LBP6300dn, LBP6310dn, LBP6650dn, LBP6670dn, MF411dw, MF416dw, MF418x, MF419x, MF5840dn, MF5880dn, MF5940dn, MF5980dw, MF6140dn, MF6180dw, Canon LBP 251dw, 252dw, 253x, 6300dn, 6650dn, Canon MF 411dw, 416dw, 418x, 419x, 5840dn, 5880dn, 6140dn, 6180dw, HP LaserJet P2050 series, P2055, P2055D, P2055DN, P2055X, HP P 2050 series, 2055, 2055D, 2055DN, 2055X.</h4>
                <button onclick="addToCart(473)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TCCE505">
                <h3>TCCE505</h3>
                <h3>1690 DA</h3>
                <h4>Canon i-Sensys LBP6300dn, LBP6310dn, LBP6650dn, LBP6670dn, MF411dw, MF416dw, MF418x, MF419x, MF5840dn, MF5880dn, MF5940dn, MF5980dw, MF6140dn, MF6180dw, Canon LBP 251dw, 252dw, 253x, 6300dn, 6650dn, Canon MF 411dw, 416dw, 418x, 419x, 5840dn, 5880dn, 6140dn, 6180dw, HP LaserJet P2050 series, P2055, P2055D, P2055DN, P2055X, HP P 2050 series, 2055, 2055D, 2055DN, 2055X.</h4>
                <button onclick="addToCart(474)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC129/329/729B (CE310)">
                <h3>LC129/329/729B (CE310)</h3>
                <h3>1290 DA</h3>
                <h4>Laser Canon i-Sensys LBP7010C, LBP7018C HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot.</h4>
                <button onclick="addToCart(475)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC129/329/729C (CE310)">
                <h3>LC129/329/729C (CE310)</h3>
                <h3>1290 DA</h3>
                <h4>Laser Canon i-Sensys LBP7010C, LBP7018C HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot.</h4>
                <button onclick="addToCart(476)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC129/329/729M (CE310)">
                <h3>LC129/329/729M (CE310)</h3>
                <h3>1290 DA</h3>
                <h4>Laser Canon i-Sensys LBP7010C, LBP7018C HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot.</h4>
                <button onclick="addToCart(477)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC129/329/729Y (CE310)">
                <h3>LC129/329/729Y (CE310)</h3>
                <h3>1290 DA</h3>
                <h4>Laser Canon i-Sensys LBP7010C, LBP7018C HP Color LaserJet CP1025, CP1025nw, HP CP 1025, 1025nw, HP LaserJet Pro 100 M175a, 100 M175nw, 100 MFP M175nw, CP1025, CP1025nw, M275 mfp, TopShot.</h4>
                <button onclick="addToCart(478)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC118/318/718BK">
                <h3>LC118/318/718BK</h3>
                <h3>2690 DA</h3>
                <h4>Canon LBP 7200/7200cn/iC MF8330/8350Cdn;</h4>
                <button onclick="addToCart(479)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC118/318/718C">
                <h3>LC118/318/718C</h3>
                <h3>2690 DA</h3>
                <h4>Canon LBP 7200/7200cn/iC MF8330/8350Cdn;</h4>
                <button onclick="addToCart(480)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC118/318/718M">
                <h3>LC118/318/718M</h3>
                <h3>2690 DA</h3>
                <h4>Canon LBP 7200/7200cn/iC MF8330/8350Cdn;</h4>
                <button onclick="addToCart(481)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC118/318/718Y">
                <h3>LC118/318/718Y</h3>
                <h3>2690 DA</h3>
                <h4>Canon LBP 7200/7200cn/iC MF8330/8350Cdn;</h4>
                <button onclick="addToCart(482)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC116/316/716BK">
                <h3>LC116/316/716BK</h3>
                <h3>1990 DA</h3>
                <h4>CANON LBP5050/5050n/MF8030/8050 HP Laserjet CP1215</h4>
                <button onclick="addToCart(483)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC116/316/716C">
                <h3>LC116/316/716C</h3>
                <h3>1990 DA</h3>
                <h4>CANON LBP5050/5050n/MF8030/8050 HP Laserjet CP1215</h4>
                <button onclick="addToCart(484)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC116/316/716M">
                <h3>LC116/316/716M</h3>
                <h3>1990 DA</h3>
                <h4>CANON LBP5050/5050n/MF8030/8050 HP Laserjet CP1215</h4>
                <button onclick="addToCart(485)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LC116/316/716Y">
                <h3>LC116/316/716Y</h3>
                <h3>1990 DA</h3>
                <h4>CANON LBP5050/5050n/MF8030/8050 HP Laserjet CP1215</h4>
                <button onclick="addToCart(486)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E30/31/40">
                <h3>E30/31/40</h3>
                <h3>2490 DA</h3>
                <h4>Toner CANON FC 200/208/210/226/230/300/310/320/325/330/330L /400/420/430/530/550 CANON PC 300/310/320/325/330/400/420/430/530/550/710/720/740/745/770/790/795/920/921/950/980</h4>
                <button onclick="addToCart(487)">Ajouter au panier</button>
            </div>
            <!--toner samsung-->
            <div class="product">
                <img src="" alt="T101-2160">
                <h3>T101-2160</h3>
                <h3>0 DA</h3>
                <h4>TONER Samsung ML 2160, 2164, 2165, 2165W, 2168w, Samsung SCX 3400, 3400F, 3405, 3405F, 3405FW, 3405W, Samsung SF 760P.</h4>
                <button onclick="addToCart(488)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="T104-1660">
                <h3>T104-1660</h3>
                <h3>0 DA</h3>
                <h4>TONER Samsung ML 1660, 1665, 1670, 1674, 1675, 1860, 1865, 1865W, Samsung SCX 3200, 3205, 3205W, 3207.</h4>
                <button onclick="addToCart(489)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="T105-1910">
                <h3>T105-1910</h3>
                <h3>1690 DA</h3>
                <h4>TONER Samsung ML 1910, 1915, 2525, 2525W, 2540, 2540R, 2545, 2580, Samsung SCX 4600, 4610, 4605K, 4623, 4623F, 4623FW, 4623G, Samsung CF650/650F, SF650/650P.</h4>
                <button onclick="addToCart(490)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="T108-1640">
                <h3>T108-1640</h3>
                <h3>1790 DA</h3>
                <h4>Toner Samsung ML1640/1641/2240/2241.</h4>
                <button onclick="addToCart(491)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LT111">
                <h3>LT111</h3>
                <h3>1690 DA</h3>
                <h4>TONER Samsung SL M2020, M2020W, M2022, M2022W, M2070, M2070 MFP, M2070W, M2070W MFP, M2078W, Samsung XPress M2026W, SLM2020, SL-M2020W, SL-M2022, SL-M2022W, SLM2070, SL-M2070 MFP, SL-M2070W, SL-M2070W.</h4>
                <button onclick="addToCart(492)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="T205S">
                <h3>T205S</h3>
                <h3>2790 DA</h3>
                <h4>Laser Samsung ML 3310D, 3710D, 3710ND, Samsung SCX 4833, 4833FD, 4833FR, 5637, 5639, 5737FW, 5739.</h4>
                <button onclick="addToCart(493)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML1210">
                <h3>ML1210</h3>
                <h3>2090 DA</h3>
                <h4>TONER SAMSUNG ML1010/1020M/1210/1220M/1250/1430, SF-515/530/531P/535E, SF-5100/5100P, MSYS-5100P/ML-808.</h4>
                <button onclick="addToCart(494)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML1610">
                <h3>ML1610</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung ML 1610, 1610D2, 1615, 1620, 1625, 2010, 2010D3, 2010R, 2015, 2020, 2510, 2570, 2571, 2571N, Samsung SCX 4321, 4521, 4521D3, 4521F, Xerox Phaser 3122, Dell Laser1100, 1110.</h4>
                <button onclick="addToCart(495)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML1710">
                <h3>ML1710</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung ML 1410, 1500, 1510, 1510B, 1520, 1710, 1710B, 1710D, 1710P, 1740, 1750, 1755, Lexmark X 215, Ricoh Aficio FX16, Ricoh Fax 1130L, Xerox Phaser 3115, 3116, 3120, 3121, 3130, 3131, 3132, Xerox WorkCentre PE 16.</h4>
                <button onclick="addToCart(496)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML2010">
                <h3>ML2010</h3>
                <h3>2390 DA</h3>
                <h4>TONER SAMSUNG ML2150.</h4>
                <button onclick="addToCart(497)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML2150">
                <h3>ML2150</h3>
                <h3>2990 DA</h3>
                <h4>TONER SAMSUNG ML2150.</h4>
                <button onclick="addToCart(498)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML2250">
                <h3>ML2250</h3>
                <h3>1790 DA</h3>
                <h4>Toner Samsung ML2250/2252/4520/4720/PE120/DELL 1600N.</h4>
                <button onclick="addToCart(499)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML4100">
                <h3>ML4100</h3>
                <h3>1690 DA</h3>
                <h4>TONER SAMSUNG ML1911, 1910, 2525, 2581, 2580.</h4>
                <button onclick="addToCart(500)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML4500">
                <h3>ML4500</h3>
                <h3>1790 DA</h3>
                <h4>TONER SAMSUNG ML 4500, 4600.</h4>
                <button onclick="addToCart(501)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="ML5800">
                <h3>ML5800</h3>
                <h3>2690 DA</h3>
                <h4>TONER SAMSUNG SF5800 /5600P.</h4>
                <button onclick="addToCart(502)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SCX4300-T109">
                <h3>SCX4300-T109</h3>
                <h3>1590 DA</h3>
                <h4>TONER SAMSUNG SCX-4300/4300F/4300R.</h4>
                <button onclick="addToCart(503)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SCX4520">
                <h3>SCX4520</h3>
                <h3>2690 DA</h3>
                <h4>TONER SAMSUNG SCX4520.</h4>
                <button onclick="addToCart(504)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SCX4720">
                <h3>SCX4720</h3>
                <h3>2490 DA</h3>
                <h4>TONER SAMSUNG SCX4720 /4720FN.</h4>
                <button onclick="addToCart(505)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CLP300 B">
                <h3>CLP300 B</h3>
                <h3>390 DA</h3>
                <h4>TONER Samsung CLP-300/300N, Samsung CLX2160/2160N/2161K/2161NK/3160N/3160FN.</h4>
                <button onclick="addToCart(506)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CLP300 C">
                <h3>CLP300 C</h3>
                <h3>390 DA</h3>
                <h4>TONER Samsung CLP-300/300N, Samsung CLX2160/2160N/2161K/2161NK/3160N/3160FN.</h4>
                <button onclick="addToCart(507)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CLP300 M">
                <h3>CLP300 M</h3>
                <h3>390 DA</h3>
                <h4>TONER Samsung CLP-300/300N, Samsung CLX2160/2160N/2161K/2161NK/3160N/3160FN.</h4>
                <button onclick="addToCart(508)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="CLP300 Y">
                <h3>CLP300 Y</h3>
                <h3>390 DA</h3>
                <h4>TONER Samsung CLP-300/300N, Samsung CLX2160/2160N/2161K/2161NK/3160N/3160FN.</h4>
                <button onclick="addToCart(509)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SK510BK">
                <h3>SK510BK</h3>
                <h3>3990 DA</h3>
                <h4>TONER Samsung CLP 510, 510N, 511, 515.</h4>
                <button onclick="addToCart(510)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SK510C">
                <h3>SK510C</h3>
                <h3>3990 DA</h3>
                <h4>TONER Samsung CLP 510, 510N, 511, 515.</h4>
                <button onclick="addToCart(511)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SK510M">
                <h3>SK510M</h3>
                <h3>3990 DA</h3>
                <h4>TONER Samsung CLP 510, 510N, 511, 515.</h4>
                <button onclick="addToCart(512)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="SK510Y">
                <h3>SK510Y</h3>
                <h3>3990 DA</h3>
                <h4>TONER Samsung CLP 510, 510N, 511, 515.</h4>
                <button onclick="addToCart(513)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC404 B">
                <h3>LSC404 B</h3>
                <h3>2190 DA</h3>
                <h4>TONER SAMSUNG CLT-P404C, SL C430, C430FW, C430W, C480, C480FN, C480FW, C480W, C483W.</h4>
                <button onclick="addToCart(514)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC404 C">
                <h3>LSC404 C</h3>
                <h3>2190 DA</h3>
                <h4>TONER SAMSUNG CLT-P404C, SL C430, C430FW, C430W, C480, C480FN, C480FW, C480W, C483W.</h4>
                <button onclick="addToCart(515)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC404 M">
                <h3>LSC404 M</h3>
                <h3>2190 DA</h3>
                <h4>TONER SAMSUNG CLT-P404C, SL C430, C430FW, C430W, C480, C480FN, C480FW, C480W, C483W.</h4>
                <button onclick="addToCart(516)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC404 Y">
                <h3>LSC404 Y</h3>
                <h3>2190 DA</h3>
                <h4>TONER SAMSUNG CLT-P404C, SL C430, C430FW, C430W, C480, C480FN, C480FW, C480W, C483W.</h4>
                <button onclick="addToCart(517)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC406 B">
                <h3>LSC406 B</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 360, 362, 363, 364, 365, 365W, 367W, 368, Samsung CLX 3300, 3302, 3303, 3303FW, 3304, 3305, 3305FN, 3305FW, 3305W, 3307FW, 3307W, Samsung XPress SL-C410, SL-C410W, SLC460FW, SL-C460W, SL-C467W.</h4>
                <button onclick="addToCart(518)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC406 C">
                <h3>LSC406 C</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 360, 362, 363, 364, 365, 365W, 367W, 368, Samsung CLX 3300, 3302, 3303, 3303FW, 3304, 3305, 3305FN, 3305FW, 3305W, 3307FW, 3307W, Samsung XPress SL-C410, SL-C410W, SLC460FW, SL-C460W, SL-C467W.</h4>
                <button onclick="addToCart(519)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC406 M">
                <h3>LSC406 M</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 360, 362, 363, 364, 365, 365W, 367W, 368, Samsung CLX 3300, 3302, 3303, 3303FW, 3304, 3305, 3305FN, 3305FW, 3305W, 3307FW, 3307W, Samsung XPress SL-C410, SL-C410W, SLC460FW, SL-C460W, SL-C467W.</h4>
                <button onclick="addToCart(520)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LSC406 Y">
                <h3>LSC406 Y</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 360, 362, 363, 364, 365, 365W, 367W, 368, Samsung CLX 3300, 3302, 3303, 3303FW, 3304, 3305, 3305FN, 3305FW, 3305W, 3307FW, 3307W, Samsung XPress SL-C410, SL-C410W, SLC460FW, SL-C460W, SL-C467W.</h4>
                <button onclick="addToCart(521)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LST409 B">
                <h3>LST409 B</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 310/315, Samsung CLX 310, 3175.</h4>
                <button onclick="addToCart(522)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LST409 C">
                <h3>LST409 C</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 310/315, Samsung CLX 310, 3175.</h4>
                <button onclick="addToCart(523)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LST409 M">
                <h3>LST409 M</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 310/315, Samsung CLX 310, 3175.</h4>
                <button onclick="addToCart(524)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LST409 Y">
                <h3>LST409 Y</h3>
                <h3>1490 DA</h3>
                <h4>TONER Samsung CLP 310/315, Samsung CLX 310, 3175.</h4>
                <button onclick="addToCart(525)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TST407/409 B">
                <h3>TST407/409 B</h3>
                <h3>1590 DA</h3>
                <h4>TONER Samsung CLP 310/315/315W/320/325/325W, Samsung CLX 3180, 3185/3175FN/3285.</h4>
                <button onclick="addToCart(526)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TST407/409 C">
                <h3>TST407/409 C</h3>
                <h3>1590 DA</h3>
                <h4>TONER Samsung CLP 310/315/315W/320/325/325W, Samsung CLX 3180, 3185/3175FN/3285.</h4>
                <button onclick="addToCart(527)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TST407/409 M">
                <h3>TST407/409 M</h3>
                <h3>1590 DA</h3>
                <h4>TONER Samsung CLP 310/315/315W/320/325/325W, Samsung CLX 3180, 3185/3175FN/3285.</h4>
                <button onclick="addToCart(528)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TST407/409 Y">
                <h3>TST407/409 Y</h3>
                <h3>1590 DA</h3>
                <h4>TONER Samsung CLP 310/315/315W/320/325/325W, Samsung CLX 3180, 3185/3175FN/3285.</h4>
                <button onclick="addToCart(529)">Ajouter au panier</button>
            </div>
            <!--toner mita-->
            <div class="product">
                <img src="" alt="TK17">
                <h3>TK17</h3>
                <h3>1090 DA</h3>
                <h4>Kyocera ECOSYS P2135, P2135d, P2135dn, Kyocera FS 1320, 1320D, 1320DN, 1370DN.</h4>
                <button onclick="addToCart(530)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK100/TK113">
                <h3>TK100/TK113</h3>
                <h3>990 DA</h3>
                <h4>Kyocera Mita FS-1018MFP/1020D/KM-1500/1820/1815, Kyocera MITA FS-1016.</h4>
                <button onclick="addToCart(531)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK113">
                <h3>TK113</h3>
                <h3>990 DA</h3>
                <h4>Kyocera MITA FS-1016.</h4>
                <button onclick="addToCart(532)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK120/122">
                <h3>TK120/122</h3>
                <h3>990 DA</h3>
                <h4>Kyocera MITA FS-1030.</h4>
                <button onclick="addToCart(533)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK130/132/134">
                <h3>TK130/132/134</h3>
                <h3>1090 DA</h3>
                <h4>Kyocera MITA FS-1300D/1300DN/1350DN/1028/1128MFP.</h4>
                <button onclick="addToCart(534)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK170">
                <h3>TK170</h3>
                <h3>1090 DA</h3>
                <h4>Toner Mita TK170.</h4>
                <button onclick="addToCart(535)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK410/420/435">
                <h3>TK410/420/435</h3>
                <h3>2390 DA</h3>
                <h4>TONER Kyocera Mita KM-1620/1635/1650/2020/2035/2050, Aurora AD-165/169/203/205, Kyocera Mita KM-2550.</h4>
                <button onclick="addToCart(536)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK418">
                <h3>TK418</h3>
                <h3>2190 DA</h3>
                <h4>Kyocera MITA FS-1620/1650/2050.</h4>
                <button onclick="addToCart(537)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK428">
                <h3>TK428</h3>
                <h3>2590 DA</h3>
                <h4>Kyocera MITA FS-1635/2035/2550.</h4>
                <button onclick="addToCart(538)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK435/437/439/458/448h">
                <h3>TK435/437/439/458/448h</h3>
                <h3>2490 DA</h3>
                <h4>Kyocera MITA TASKalfa 180/220/181/221.</h4>
                <button onclick="addToCart(539)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1110/1112">
                <h3>TK1110/1112</h3>
                <h3>990 DA</h3>
                <h4>Kyocera MITA FS-1040/1120MFP/1020MFP.</h4>
                <button onclick="addToCart(540)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1120">
                <h3>TK1120</h3>
                <h3>890 DA</h3>
                <h4>Kyocera MITA FS-1060DN/1125MFP/1025MFP.</h4>
                <button onclick="addToCart(541)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1130/1132">
                <h3>TK1130/1132</h3>
                <h3>1090 DA</h3>
                <h4>Kyocera FS-1030MFP/FS-1130MFP/FS-1525MFP.</h4>
                <button onclick="addToCart(542)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1140">
                <h3>TK1140</h3>
                <h3>1290 DA</h3>
                <h4>TONER KYOCERA FS1035 MFP/M2035/ECOSYS M2030dn.</h4>
                <button onclick="addToCart(543)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1150">
                <h3>TK1150</h3>
                <h3>1490 DA</h3>
                <h4>Laser Kyocera ECOSYS M2135, M2635, M2735 et P2235.</h4>
                <button onclick="addToCart(544)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1170">
                <h3>TK1170</h3>
                <h3>1290 DA</h3>
                <h4>Kyocera ECOSYS M2040dn/2540dn.</h4>
                <button onclick="addToCart(545)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK4105">
                <h3>TK4105</h3>
                <h3>2490 DA</h3>
                <h4>TASKALFA 1800/1801/2200/2201.</h4>
                <button onclick="addToCart(546)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK1525/1530">
                <h3>TK1525/1530</h3>
                <h3>2090 DA</h3>
                <h4>Kyocera MITA KM1525/1530/2030.</h4>
                <button onclick="addToCart(547)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TK3160">
                <h3>TK3160</h3>
                <h3>2290 DA</h3>
                <h4>Kyocera M3145DN/M3645DN/P3045DN/P3050.</h4>
                <button onclick="addToCart(548)">Ajouter au panier</button>
            </div>
            <!--toner epson-->
            <div class="product">
                <img src="" alt="M2000">
                <h3>M2000</h3>
                <h3>1090 DA</h3>
                <h4>Toner Epson Aaculaser M2000.</h4>
                <button onclick="addToCart(549)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="M2300/2400">
                <h3>M2300/2400</h3>
                <h3>1290 DA</h3>
                <h4>Toner Epson Aaculaser M2300/M2400.</h4>
                <button onclick="addToCart(550)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="M300">
                <h3>M300</h3>
                <h3>1390 DA</h3>
                <h4>Epson WorkForce AL M300D, AL M300DN, AL MX300DN, AL MX300DNF, AL MX300DTN, AL MX300DTNF.</h4>
                <button onclick="addToCart(551)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1100 B">
                <h3>C1100 B</h3>
                <h3>1090 DA</h3>
                <h4>Toner Epson AcculaSer C1100.</h4>
                <button onclick="addToCart(552)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1100 C">
                <h3>C1100 C</h3>
                <h3>1090 DA</h3>
                <h4>Toner Epson AcculaSer C1100.</h4>
                <button onclick="addToCart(553)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1100 M">
                <h3>C1100 M</h3>
                <h3>1090 DA</h3>
                <h4>Toner Epson AcculaSer C1100.</h4>
                <button onclick="addToCart(554)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1100 Y">
                <h3>C1100 Y</h3>
                <h3>1090 DA</h3>
                <h4>Toner Epson AcculaSer C1100.</h4>
                <button onclick="addToCart(555)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1600B">
                <h3>C1600B</h3>
                <h3>1350 DA</h3>
                <h4>Toner Epson AcculaSer C1600.</h4>
                <button onclick="addToCart(556)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1600C">
                <h3>C1600C</h3>
                <h3>1350 DA</h3>
                <h4>Toner Epson AcculaSer C1600.</h4>
                <button onclick="addToCart(557)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1600M">
                <h3>C1600M</h3>
                <h3>1350 DA</h3>
                <h4>Toner Epson AcculaSer C1600.</h4>
                <button onclick="addToCart(558)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="C1600Y">
                <h3>C1600Y</h3>
                <h3>1350 DA</h3>
                <h4>Toner Epson AcculaSer C1600.</h4>
                <button onclick="addToCart(559)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EP5700/5900 -50010">
                <h3>EP5700/5900 -50010</h3>
                <h3>2190 DA</h3>
                <h4>Epson EPL 5700, 5700L, 5800, 5800L, 5800PTX, 5800TX, 5900, 5900L, 5900N, 5900PS, 6100, 6100L, 6100N, 6100PS, Konica Minolta PagePro 1200, 1200 Series, 1200W, 1250 Series, 1250E, 1250W, 8, 8E, 8L.</h4>
                <button onclick="addToCart(560)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EP6200 -50167">
                <h3>EP6200 -50167</h3>
                <h3>0 DA</h3>
                <h4>Toner Epson EPL 6200.</h4>
                <button onclick="addToCart(561)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="EP5900 -50087">
                <h3>EP5900 -50087</h3>
                <h3>1890 DA</h3>
                <h4>Toner Epson EPL 5900/6100.</h4>
                <button onclick="addToCart(562)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="RBLQ1170">
                <h3>RBLQ1170</h3>
                <h3>120 DA</h3>
                <h4>Ruban Epson LQ1170.</h4>
                <button onclick="addToCart(563)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="RBDFX5/8">
                <h3>RBDFX5/8</h3>
                <h3>290 DA</h3>
                <h4>Ruban Epson DFX5000/8000.</h4>
                <button onclick="addToCart(564)">Ajouter au panier</button>
            </div>
            <!--toner brother-->
            <div class="product">
                <img src="" alt="TBTN360">
                <h3>TBTN360</h3>
                <h3>1490 DA</h3>
                <h4>Brother DCP7030, DCP7040, HL2140, HL2170W, MFC7340, MFC7345N, MFC7440N, MFC7840W.</h4>
                <button onclick="addToCart(565)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB1000/1030/1050/1060/1070">
                <h3>TB1000/1030/1050/1060/1070</h3>
                <h3>990 DA</h3>
                <h4>Brother HL 1110/1110R/HL1112/1112R/MFC1810/1810R/1815/1815R Brother DCP1510/1510R/1512/1512RTN450/2220/2225/2250/2275/2280/27J.</h4>
                <button onclick="addToCart(566)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB580">
                <h3>TB580</h3>
                <h3>1590 DA</h3>
                <h4>Toner Brother DCP-1200/1400/8040/8045D/8045DN; MFC-2500/4750/5750/8220/8300/8300J/8440/8500/8600/8700/8460N/8860DN/8870DW; HL-1030/1200/1240/1250/1270N/1440/1450/1430/8350P/8350NLT/9650/9650N/9750/1650/1670N/1850/1870N/5130/5140/5150D/5150DN/5240/5250DN/5250DNT/5280DW Brother HL-5340D/5350DN/5380DN; MFC-8480DN; KONICA BIZHUB 20/20P (Worldwide); Lenovo LJ2500/2312P/2412P/8212N/6012MFP/6112MFC/6212 Lenovo LJ3500/LJ3600D/LJ3650DN/M7900NF.</h4>
                <button onclick="addToCart(567)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB670">
                <h3>TB670</h3>
                <h3>1590 DA</h3>
                <h4>Brother 6050 TN670/4100/4150/47J.</h4>
                <button onclick="addToCart(568)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB315/325/310/230B">
                <h3>TB315/325/310/230B</h3>
                <h3>1890 DA</h3>
                <h4>Brother HL4140CN/4140CDN/HL4570CDWT 4570CDW/ MFC9465/CMFV 9560CDFW/ 1510R/ 1512/1512RTN450/2220/2225/2250/2275/2280/27J.</h4>
                <button onclick="addToCart(569)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB315/325/310/230C">
                <h3>TB315/325/310/230C</h3>
                <h3>1890 DA</h3>
                <h4>Brother HL4140CN/4140CDN/HL4570CDWT 4570CDW/ MFC9465/CMFV 9560CDFW/ 1510R/ 1512/1512RTN450/2220/2225/2250/2275/2280/27J.</h4>
                <button onclick="addToCart(570)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB315/325/310/230M">
                <h3>TB315/325/310/230M</h3>
                <h3>1890 DA</h3>
                <h4>Brother HL4140CN/4140CDN/HL4570CDWT 4570CDW/ MFC9465/CMFV 9560CDFW/ 1510R/ 1512/1512RTN450/2220/2225/2250/2275/2280/27J.</h4>
                <button onclick="addToCart(571)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB315/325/310/230Y">
                <h3>TB315/325/310/230Y</h3>
                <h3>1890 DA</h3>
                <h4>Brother HL4140CN/4140CDN/HL4570CDWT 4570CDW/ MFC9465/CMFV 9560CDFW/ 1510R/ 1512/1512RTN450/2220/2225/2250/2275/2280/27J.</h4>
                <button onclick="addToCart(572)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB210/230/240/270/290B">
                <h3>TB210/230/240/270/290B</h3>
                <h3>1790 DA</h3>
                <h4>Toner Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370, MFC-9010CN/9120CN/9320CW/9325CW, DCP-9010CN.</h4>
                <button onclick="addToCart(573)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB210/230/240/270/290C">
                <h3>TB210/230/240/270/290C</h3>
                <h3>1790 DA</h3>
                <h4>Toner Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370, MFC-9010CN/9120CN/9320CW/9325CW, DCP-9010CN.</h4>
                <button onclick="addToCart(574)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB210/230/240/270/290M">
                <h3>TB210/230/240/270/290M</h3>
                <h3>1790 DA</h3>
                <h4>Toner Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370, MFC-9010CN/9120CN/9320CW/9325CW, DCP-9010CN.</h4>
                <button onclick="addToCart(575)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TB210/230/240/270/290Y">
                <h3>TB210/230/240/270/290Y</h3>
                <h3>1790 DA</h3>
                <h4>Toner Brother HL-3040CN/3045CN/3070CW/3075CW/8070/8370, MFC-9010CN/9120CN/9320CW/9325CW, DCP-9010CN.</h4>
                <button onclick="addToCart(576)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TN247 B">
                <h3>TN247 B</h3>
                <h3>2490 DA</h3>
                <h4>Brother DCP L3510CDW, L3550CDW, Brother HL L3210CW, L3230CDW, L3270CDW, Brother MFC L3710CW, L3730CDN, L3750CDW, L3770CDW.</h4>
                <button onclick="addToCart(577)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TN247 C">
                <h3>TN247 C</h3>
                <h3>2490 DA</h3>
                <h4>Brother DCP L3510CDW, L3550CDW, Brother HL L3210CW, L3230CDW, L3270CDW, Brother MFC L3710CW, L3730CDN, L3750CDW, L3770CDW.</h4>
                <button onclick="addToCart(578)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TN247 M">
                <h3>TN247 M</h3>
                <h3>2490 DA</h3>
                <h4>Brother DCP L3510CDW, L3550CDW, Brother HL L3210CW, L3230CDW, L3270CDW, Brother MFC L3710CW, L3730CDN, L3750CDW, L3770CDW.</h4>
                <button onclick="addToCart(579)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TN247 Y">
                <h3>TN247 Y</h3>
                <h3>2490 DA</h3>
                <h4>Brother DCP L3510CDW, L3550CDW, Brother HL L3210CW, L3230CDW, L3270CDW, Brother MFC L3710CW, L3730CDN, L3750CDW, L3770CDW.</h4>
                <button onclick="addToCart(580)">Ajouter au panier</button>
            </div>
            <!--toner lexmark-->
            <div class="product">
                <img src="" alt="E210">
                <h3>E210</h3>
                <h3>1690 DA</h3>
                <h4>SAMSUNG ML1010/1020/1210/1250/1431.</h4>
                <button onclick="addToCart(581)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E250/N">
                <h3>E250/N</h3>
                <h3>1390 DA</h3>
                <h4>Lexmark E 250, 250D, 250DN, 350, 350D, 352, 352DN, 450DN.</h4>
                <button onclick="addToCart(582)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E260">
                <h3>E260</h3>
                <h3>3290 DA</h3>
                <h4>E260D/260DN/360D/360DN/460DN/460DW/462DTN.</h4>
                <button onclick="addToCart(583)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E260 DRUM">
                <h3>E260 DRUM</h3>
                <h3>ND</h3>
                <h4>E260D/260DN/360D/360DN/460DN/460DW/462DTN.</h4>
                <button onclick="addToCart(584)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E230/232">
                <h3>E230/232</h3>
                <h3>1950 DA</h3>
                <h4>E230/330/DELL 1700/IBM 1412.</h4>
                <button onclick="addToCart(585)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="MS310">
                <h3>MS310</h3>
                <h3>4900 DA</h3>
                <h4>MS310/410/510/610.</h4>
                <button onclick="addToCart(586)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="E450/N">
                <h3>E450/N</h3>
                <h3>1950 DA</h3>
                <h4>E450.</h4>
                <button onclick="addToCart(587)">Ajouter au panier</button>
            </div>
            <!--toner dell-->
            <div class="product">
                <img src="" alt="TDEL1160">
                <h3>TDEL1160</h3>
                <h3>1590 DA</h3>
                <h4>Toner Dell B1160/ B1163W/B1160w/B1165nfw.</h4>
                <button onclick="addToCart(588)">Ajouter au panier</button>
            </div>
            <!--toner oki-->
            <div class="product">
                <img src="" alt="LOB4600">
                <h3>LOB4600</h3>
                <h3>1690 DA</h3>
                <h4>TONER LASER OKI B4400/B4400N/4600/4600N.</h4>
                <button onclick="addToCart(589)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="LOB410">
                <h3>LOB410</h3>
                <h3>1490 DA</h3>
                <h4>TONER LASER OKI B410dn/B420dn/MB430/MB440/MB460/MB470/MB480.</h4>
                <button onclick="addToCart(590)">Ajouter au panier</button>
            </div>
            <!--toner ricoh-->
            <div class="product">
                <img src="" alt="TRSP200/201">
                <h3>TRSP200/201</h3>
                <h3>2590 DA</h3>
                <h4>RICO RICOSP201N/SP201NW/SP203S/SP204S.</h4>
                <button onclick="addToCart(591)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TRSP310/311">
                <h3>TRSP310/311</h3>
                <h3>2390 DA</h3>
                <h4>RICOH SP310/311DNW/SP311DN/SP311SFN.</h4>
                <button onclick="addToCart(592)">Ajouter au panier</button>
            </div>
            <!--toner xerox-->
            <div class="product">
                <img src="" alt="TX5020">
                <h3>TX5020</h3>
                <h3>1090 DA</h3>
                <h4>XEROX WORKCENTER 5016/5020.</h4>
                <button onclick="addToCart(593)">Ajouter au panier</button>
            </div>
            <!--toner panasonic-->
            <div class="product">
                <img src="" alt="TP83E">
                <h3>TP83E</h3>
                <h3>790 DA</h3>
                <h4>KX-FL511/512/513/612.</h4>
                <button onclick="addToCart(594)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TPKX-FAT411E">
                <h3>TPKX-FAT411E</h3>
                <h3>890 DA</h3>
                <h4>TONER ANASONIC KXFAT411E MB2000.</h4>
                <button onclick="addToCart(595)">Ajouter au panier</button>
            </div>
            <div class="product">
                <img src="" alt="TPFA84E DRUM">
                <h3>TPFA84E DRUM</h3>
                <h3>6900 DA</h3>
                <h4>DRUM KX-FL511/512/513/612.</h4>
                <button onclick="addToCart(596)">Ajouter au panier</button>
            </div>
        </div>
    </div> 
    </main>
    <script>
        function addToCart(productId) {
            window.location.href = `toner.php?addToCart=${productId}`;
        }
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
