<?php
session_start();
require_once '../vendor/autoload.php'; 
include '../includes/header.php';
// Initialisez Stripe avec votre clé secrète
\Stripe\Stripe::setApiKey('clé secrete');

// Initialise le panier s'il n'existe pas encore dans la session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fonction pour récupérer les détails d'un produit à partir de l'ID
function getProductDetails($productId) {
    $storeItems = [
        //product1
        1  => ['name' => 'Carte PCI 4 USB +1   XLT0005', 'priceInCents' => 69000],
        2  => ['name' => 'Carte PCI to 2 DB9   XLT0001', 'priceInCents' => 39000],
        3  => ['name' => 'Carte PCI to Parallèle+DB9', 'priceInCents' => 89000],
        4  => ['name' => 'Carte PCI to SATA+IDE    XLT010', 'priceInCents' => 79000],
        5  => ['name' => 'Carte PCI to 5 USB+3 Firwire', 'priceInCents' => 99000],
        6  => ['name' => 'Carte PCI To PCMCIA', 'priceInCents' => 60000],
        7  => ['name' => 'Carte Son PCI 8 Sorties', 'priceInCents' => 69000],
        8  => ['name' => 'Carte son USB  7,1', 'priceInCents' => 25000],
        9  => ['name' => 'Carte PCI Controleur RAID2 IDE', 'priceInCents' => 135000],
        10 => ['name' => 'Carte PCI Controleur RAID2 SATA', 'priceInCents' => 135000],
        11 => ['name' => 'Carte PCI Controleur RAID4 SATA', 'priceInCents' => 175000],
        12 => ['name' => 'Carte PCI Controleur RAID4 SATAII', 'priceInCents' => 450000],
        13 => ['name' => 'Carte PCI-E to parallèle+DB9', 'priceInCents' => 175000],
        14 => ['name' => 'Carte PCI-E 2SATA-II RAID', 'priceInCents' => 185000],
        15 => ['name' => 'Carte PCI-E to modem', 'priceInCents' => 115000],
        //product2
        16 => ['name' => 'PcmciaTo ExpressCard - PCM002', 'priceInCents' => 125000],
        17 => ['name' => 'PCMCIA To Firware 2 ports - PCM010', 'priceInCents' => 85000],
        18 => ['name' => 'PCMCIA To DB9 RS232 - PCM011', 'priceInCents' => 115000],
        19 => ['name' => 'PCMCIA To Parallèle - PCM012', 'priceInCents' => 235000],
        20 => ['name' => 'PCMCIA To Réseau 10/100Mo -PCM013', 'priceInCents' => 75000],
        21 => ['name' => 'PCMCIA To Sata', 'priceInCents' => 125000],
        22 => ['name' => 'PCMCIA To 4USB', 'priceInCents' => 00],
        23 => ['name' => 'USB To ExpressCard - PCM001', 'priceInCents' => 139000],
        24 => ['name' => 'ExpressCard To ESSATA II -PCM003', 'priceInCents' => 119000],
        25 => ['name' => 'ExpressCard To USB2,0 + Firware -PCM004', 'priceInCents' => 159000],
        26 => ['name' => 'ExpressCard To Réseau 1000m-PCM005', 'priceInCents' => 139000],
        27 => ['name' => 'ExpressCard To Firware', 'priceInCents' => 95000],
        28 => ['name' => 'ExpressCard To USB3,0', 'priceInCents' => 195000],
        29 => ['name' => 'ExpressCard To Parallèle-PCM006', 'priceInCents' => 155000],
        30 => ['name' => 'ExpressCard To Port DB9 RS232', 'priceInCents' => 95000],
        31 => ['name' => 'ExpressCard Lecteur de carte 24 in1-PCM9', 'priceInCents' => 115000],
        //carte tv
        32 => ['name' => 'Carte TV PCI + Acquisition', 'priceInCents' => 115000],
        33 => ['name' => 'Carte TV PCMCIA Witch FM + Acquisition', 'priceInCents' => 189000],
        34 => ['name' => 'Boitier TV DB9 (TV2005)', 'priceInCents' => 159000],
        35 => ['name' => 'Boitier TV Box Tuner (Pour Ecran CRT)', 'priceInCents' => 159000],
        36 => ['name' => 'Boitier TV Box Tuner (Pour Ecran TFT)', 'priceInCents' => 199000],
        37 => ['name' => 'TV peritel Svideo 90 TV10V', 'priceInCents' => 189000],
        38 => ['name' => 'TV USB + antenne DVBT', 'priceInCents' => 179000],
        39 => ['name' => 'TV USB With FM Interne UTV02', 'priceInCents' => 199000],
        //souris clavier
        40 => ['name' => 'Souris Optique USB 001/010/012/067', 'priceInCents' => 19000],
        41 => ['name' => 'Souris Optique USB Elvision M85', 'priceInCents' => 19000],
        42 => ['name' => 'Souris étanche', 'priceInCents' => 25000],
        43 => ['name' => 'Souris ergonomique USB DM001', 'priceInCents' => 225000],
        44 => ['name' => 'Souris ergonomique Wireless DM001', 'priceInCents' => 275000],
        45 => ['name' => 'Clavier PS2 401', 'priceInCents' => 32000],
        46 => ['name' => 'Adaptateur Ps2/2 USB', 'priceInCents' => 7000],
        47 => ['name' => 'Clavier +Souris sans fil 2,4G HK3960', 'priceInCents' => 179000],
        48 => ['name' => 'Clavier +Souris sans fil 2,4G HK3900', 'priceInCents' => 229000],
        49 => ['name' => 'Clavier  bluetooth Mini HB2000', 'priceInCents' => 179000],
        50 => ['name' => 'Clavier bluetooth BK3001 Métalique', 'priceInCents' => 179000],
        //casque micro
        51 => ['name' => 'Casque Micro SX87 CD610', 'priceInCents' => 15000],
        52 => ['name' => 'Casque TM608', 'priceInCents' => 10000],
        53 => ['name' => 'Casque micro TM602', 'priceInCents' => 15000],
        54 => ['name' => 'Casque Micro TM564', 'priceInCents' => 35000],
        55 => ['name' => 'Casque Micro TM201', 'priceInCents' => 29000],
        56 => ['name' => 'Casque Micro SX908 K91', 'priceInCents' => 35000],
        57 => ['name' => 'Casque Micro 360', 'priceInCents' => 35000],
        58 => ['name' => 'Casque FM SD668', 'priceInCents' => 179000],
        59 => ['name' => 'Microphone ecran SR02', 'priceInCents' => 7000],
        60 => ['name' => 'Ecouteur M110/117/121', 'priceInCents' => 15000],
        //Webcam
        61 => ['name' => 'Webcam B002/024/075/045 3MPS', 'priceInCents' => 49000],
        62 => ['name' => 'Webcam 31/49/78/95/92', 'priceInCents' => 49000],
        63 => ['name' => 'WebCam WCED006/091/69/087/004', 'priceInCents' => 59000],
        64 => ['name' => 'WebCam  WCH288', 'priceInCents' => 69000],
        65 => ['name' => 'WebCam  W097 3MPS', 'priceInCents' => 79000],
        66 => ['name' => 'WebCam YH25/22/ED820   8MPS ', 'priceInCents' => 89000],
        //haut parleur
        67 => ['name' => 'Haut parleur 2,0 HP2031', 'priceInCents' => 25000],
        68 => ['name' => 'Haut parleur 2,1 HP2050', 'priceInCents' => 39000],
        69 => ['name' => 'Speaker Bleutooth FY06', 'priceInCents' => 69000],
        70 => ['name' => 'haut parleur 101FM +USB+LSD+Batterie', 'priceInCents' => 139000],
        //disk
        71 => ['name' => 'Rack 2,5" SATA', 'priceInCents' => 69000],
        72 => ['name' => 'Rack 2,5" SATA NHD18', 'priceInCents' => 95000],
        73 => ['name' => 'Rack 2,5" IDE Empreinte Digitale 25UK', 'priceInCents' => 59000],
        74 => ['name' => 'Rack 3,5" Interne IDE MR001', 'priceInCents' => 29000],
        //nettoyage
        75 => ['name' => 'Kit de nettoyage 4Pcs 4IN1', 'priceInCents' => 12000],
        76 => ['name' => 'Kit de nettoyage 2 Pcs EP05', 'priceInCents' => 15000],
        77 => ['name' => 'Kit de nettoyage 2 Pcs EP07', 'priceInCents' => 25000],
        78 => ['name' => 'Nettoyant bus imprimante', 'priceInCents' => 12000],
        //sacoche
        79 => ['name' => 'Saccoche Tablette 7" REF 1062', 'priceInCents' => 65000],
        80 => ['name' => 'Saccoche Tablette 7" REF 1073', 'priceInCents' => 75000],
        81 => ['name' => 'Saccoche Tablette 7" REF 1089-1', 'priceInCents' => 75000],
        82 => ['name' => 'Saccoche Tablette 7" REF 1065', 'priceInCents' => 79000],
        83 => ['name' => 'Saccoche Tablette 10,1" REF 103', 'priceInCents' => 65000],
        84 => ['name' => 'Saccoche Tablette 10,1" REF 096', 'priceInCents' => 85000],
        85 => ['name' => 'Saccoche Tablette 10,1" REF 1089R1', 'priceInCents' => 95000],
        86 => ['name' => 'Range CD J-05/J04/J03/J02', 'priceInCents' => 11000],
        //chargeur
        87 => ['name' => 'Chargeur universel Allume Cigare 100W', 'priceInCents' => 79000],
        88 => ['name' => 'Chargeur universel Allume Cigare 120W', 'priceInCents' => 79000],
        89 => ['name' => 'Chargeur Universel 90W (614)', 'priceInCents' => 139000],
        90 => ['name' => 'Chargeur Universel 120w (616)', 'priceInCents' => 139000],
        91 => ['name' => 'Chargeur Universel 90W Auto (615)', 'priceInCents' => 189000],
        //reseau
        92 => ['name' => 'Chercheur Signal WIFI', 'priceInCents' => 25000],
        93 => ['name' => 'Routeur MR804  4 port', 'priceInCents' => 99000],
        94 => ['name' => 'Routeur ADSL Wirless 54Mb/s neolink', 'priceInCents' => 150000],
        95 => ['name' => 'Bouchon de protection', 'priceInCents' => 300],
        96 => ['name' => 'Prise mural RJ45 +RJ11', 'priceInCents' => 22000],
        97 => ['name' => 'Pince à sertir RJ45 RJ11', 'priceInCents' => 29000],
        98 => ['name' => 'Testeur Câble réseau', 'priceInCents' => 35000],
        99 => ['name' => 'VGA Splitter 4sorties auto 1PC/4EC', 'priceInCents' => 99000],
        100=> ['name' => 'IRDA full speed A11S/A880', 'priceInCents' => 9000],
        //speaker ipod
        101=> ['name' => 'Haut Parleur LJ-800A Sacoche', 'priceInCents' => 39000],
        102=> ['name' => 'Haut Parleur LJ-824A', 'priceInCents' => 59000],
        103=> ['name' => 'Haut Parleur LJ-858A', 'priceInCents' => 59000],
        104=> ['name' => 'Haut Parleur LJ-805', 'priceInCents' => 79000],
        105=> ['name' => 'Haut parleur mini speaker', 'priceInCents' => 39000],
        106=> ['name' => 'Haut Parleur LJ-668A', 'priceInCents' => 79000],
        // lecteur de carte
        107=> ['name' => 'Lecteur de carte flash CR101', 'priceInCents' => 8000],
        108=> ['name' => 'Lecteur de carte flash CR102A', 'priceInCents' => 12000],
        109=> ['name' => 'Lecteur de carte CR6371B', 'priceInCents' => 19000],
        110=> ['name' => 'Lecteur de carte interne 5,25', 'priceInCents' => 30000],
        111=> ['name' => 'lecteur de Carte+lecteur disquette', 'priceInCents' => 20000],
        112=> ['name' => 'lecteur DISQUETTE', 'priceInCents' => 10000],
        //jeux
        113=> ['name' => 'Volant USB U783', 'priceInCents' => 135000],
        114=> ['name' => 'Kit jeux WII W005', 'priceInCents' => 89000],
        115=> ['name' => 'Kit Arts Martiaux W006', 'priceInCents' => 89000],
        116=> ['name' => 'Kit Jeux WII W019', 'priceInCents' => 89000],
        117=> ['name' => 'Range Etui Télécommande W009', 'priceInCents' => 29000],
        118=> ['name' => 'Gant Boxe WII W021', 'priceInCents' => 59000],
        119=> ['name' => 'Saccoche WII W020', 'priceInCents' => 99000],
        //accessoire
        120=> ['name' => 'Lampe USB 896-3', 'priceInCents' => 35000],
        121=> ['name' => 'Lampe USB 898A', 'priceInCents' => 55000],
        122=> ['name' => 'Support ventilateur Laptop 8503', 'priceInCents' => 79000],
        123=> ['name' => 'Support ventilateur Laptop 769', 'priceInCents' => 89000],
        124=> ['name' => 'Copy Holder Click Type', 'priceInCents' => 1500],
        125=> ['name' => 'Housse de protection écran TFT22"', 'priceInCents' => 12000],
        126=> ['name' => 'Support tablette LS100', 'priceInCents' => 39000],
        127=> ['name' => 'Support tablette P6', 'priceInCents' => 49000],
        128=> ['name' => 'Hub USB 4Ports H2042/2044', 'priceInCents' => 19000],
        //onduleur
        129=> ['name' => 'BACK UPS BK650-AS', 'priceInCents' => 00],
        130=> ['name' => 'SMAT UPS SUA750I', 'priceInCents' => 1890000],
        131=> ['name' => 'SMART UPS SUA 1000I', 'priceInCents' => 2890000],
        132=> ['name' => 'SMART UPS SUA 1500I', 'priceInCents' => 5490000],
        133=> ['name' => 'SMART UPS SUA 3000I', 'priceInCents' => 10950000],
        134=> ['name' => 'SMART UPS SMT    750VA -  RMI2U', 'priceInCents' => 4890000],
        135=> ['name' => 'SMART UPS SMT  3000VA -  RMI2U', 'priceInCents' => 15990000],
        136=> ['name' => 'Multiprise cyber power 5 sorties', 'priceInCents' => 99000],
        //cable
        //vga
        137=> ['name' => 'Câble VGA M/F  1,5M ', 'priceInCents' => 9000],
        138=> ['name' => 'Câble VGA M/F  3M ', 'priceInCents' => 15000],
        139=> ['name' => 'Câble VGA M/F 5M', 'priceInCents' => 25000],
        140=> ['name' => 'Câble VGA M/M 1,5M FLAT', 'priceInCents' => 29000],
        141=> ['name' => 'Câble VGA M/M  10M', 'priceInCents' => 49000],
        142=> ['name' => 'Câble VGA TO VGA Spliter', 'priceInCents' => 29000],
        //HDMI
        143=> ['name' => 'Câble HDMI 1,5M Tréssé', 'priceInCents' => 15000],
        144=> ['name' => 'Câble HDMI 3M  Tréssé', 'priceInCents' => 24000],
        145=> ['name' => 'Câble HDMI 5M  Tréssé', 'priceInCents' => 42000],
        146=> ['name' => 'Câble HDMI 1,5M FLAT', 'priceInCents' => 19000],
        147=> ['name' => 'Câble HDMI 3M FLAT', 'priceInCents' => 29000],
        148=> ['name' => 'Câble HDMI 5M FLAT', 'priceInCents' => 47000],
        //HDMI DVI
        149=> ['name' => 'Câble HDMI to DVI 5M', 'priceInCents' => 49000],
        150=> ['name' => 'Câble HDMI to DVI 10M', 'priceInCents' => 79000],
        151=> ['name' => 'Câble HDMI to DVI 15M', 'priceInCents' => 129000],
        //DVI
        152=> ['name' => 'Câble DVI to 3RCA' , 'priceInCents' => 25000],
        //3RCA
        153=> ['name' => 'Câble 3RCA to 3RCA 3M', 'priceInCents' => 6000],
        154=> ['name' => 'Câble 3RCA to 3RCA 5M', 'priceInCents' => 12000],
        155=> ['name' => 'Câble 3RCA to 3RCA 10M', 'priceInCents' => 21000],
        156=> ['name' => 'Câble 3RCA to 3RCA 20M', 'priceInCents' => 39000],
        //Cable reseau
        157=> ['name' => 'Câble Réseau Cat5 15M', 'priceInCents' => 19000],
        158=> ['name' => 'Câble Réseau Cat5 20M UTP NOIR', 'priceInCents' => 15000],
        159=> ['name' => 'Câble Réseau Cat5 20M', 'priceInCents' => 21000],
        160=> ['name' => 'Câble Réseau Cat6 20M', 'priceInCents' => 39000],
        161=> ['name' => 'Câble Réseau Cat5 40M', 'priceInCents' => 45000],
        162=> ['name' => 'Câble Réseau Cat6 40M', 'priceInCents' => 69000],
        163=> ['name' => 'Câble Réseau Cat5 50M', 'priceInCents' => 69000],
        164=> ['name' => 'Câble Réseau Cat6 50M', 'priceInCents' => 79000],
        165=> ['name' => 'Câble Réseau Cat6 70M', 'priceInCents' => 95000],
        166=> ['name' => 'Câble Réseau Cat5 100M', 'priceInCents' => 119000],
        //cable firewire
        167=> ['name' => 'Câble Firewire 1394 USB/4P 1,5M', 'priceInCents' => 9000],
        168=> ['name' => 'Câble Firewire 1394 USB/6P 1,5M', 'priceInCents' => 9000],
        169=> ['name' => 'Câble Firewire 1394 6P/4P 1,5M', 'priceInCents' => 9000],
        //cable db9
        170=> ['name' => 'Câble DB9/RJ45', 'priceInCents' => 19000],
        171=> ['name' => 'Câble DB9/DB9 F/F 1,5 Croisé', 'priceInCents' => 9000],
        172=> ['name' => 'Câble DB9/DB9 M/M 1,5M', 'priceInCents' => 8000],
        //cable kvm
        173=> ['name' => 'Câble KVM (VGA+Clav+Souris) M/F 1,5M', 'priceInCents' => 15000],
        174=> ['name' => 'Câble KVM (VGA+Clav+Souris) M/M 1,5M', 'priceInCents' => 15000],
        175=> ['name' => 'Câble KVM (VGA+Clav+Souris) M/M 5M', 'priceInCents' => 25000],
        //Cable reseau
        176=> ['name' => 'Câble Audio Male/2RCA 5M', 'priceInCents' => 8500],
        177=> ['name' => 'Câble Audio Male/2RCA 10M', 'priceInCents' => 19000],
        178=> ['name' => 'Câble Audio Male/2RCA 15M', 'priceInCents' => 29000],
        179=> ['name' => 'Câble Audio Male/2RCA 20M', 'priceInCents' => 39000],
        180=> ['name' => 'Câble Audio M/F Ralonge 10M', 'priceInCents' => 19000],
        181=> ['name' => 'Câble Audio M/M 3M', 'priceInCents' => 7500],
        182=> ['name' => 'Câble Audio Y M/2F', 'priceInCents' => 8900],
        //Cable USB
        183=> ['name' => 'Câble Imprimante USB 1,8M Noir', 'priceInCents' => 2500],
        184=> ['name' => 'Câble Ralonge USB 1,5M FLAT', 'priceInCents' => 12000],
        185=> ['name' => 'Câble Ralonge USB 3M', 'priceInCents' => 10500],
        186=> ['name' => 'Câble Ralonge USB 3M FLAT', 'priceInCents' => 17000],
        187=> ['name' => 'Câble USB / 4Pin M/M', 'priceInCents' => 2000],
        188=> ['name' => 'Câble USB / 5Pin M/M 1,8m', 'priceInCents' => 3000],
        189=> ['name' => 'Câble USB To Parallèle', 'priceInCents' => 39000],
        190=> ['name' => 'Câble USB To Parallèle New', 'priceInCents' => 49000],
        191=> ['name' => 'Câble USB To DB25', 'priceInCents' => 25000],
        192=> ['name' => 'Câble USB Netlink 1M/DIRECT LINK 1M', 'priceInCents' => 35000],
        193=> ['name' => 'Câble Imprimante HP1100', 'priceInCents' => 25000],
        194=> ['name' => 'Câble Imprimante Parallel', 'priceInCents' => 29000],
        //cable alimentation/onduleur
        195=> ['name' => 'Câble Alimentation 3M', 'priceInCents' => 15000],
        196=> ['name' => 'Câble Alimentation 5M', 'priceInCents' => 25000],
        197=> ['name' => 'Câble Alim 2 sorties 1,5M', 'priceInCents' => 35000],
        198=> ['name' => 'Câble Onduleur 2 sortie', 'priceInCents' => 35000],
        199=> ['name' => 'Câble onduleur Trefle 3S', 'priceInCents' => 11000],
        200=> ['name' => 'Câble Alimentation laptop Dell', 'priceInCents' => 6000],
        201=> ['name' => 'Câble Alimentation SATA 15P ', 'priceInCents' => 2500],
        202=> ['name' => 'Câble donné SATA 10cm', 'priceInCents' => 1000],
        203=> ['name' => 'Câble donné SATA 30cm', 'priceInCents' => 2000],
        204=> ['name' => 'Câble DVD PS2  5 con', 'priceInCents' => 14500],
        //Cable autre
        205=> ['name' => 'Câble Extension Antenne 3m', 'priceInCents' => 39000],
        206=> ['name' => 'Câble Péritelle', 'priceInCents' => 3900],
        207=> ['name' => 'Câble Véroyage laptop', 'priceInCents' => 29000],
        208=> ['name' => 'Kit Usb 7pcs', 'priceInCents' => 29000],
        209=> ['name' => 'Kit USB 14 pcs', 'priceInCents' => 69000],
        //drum photoconducteur
        210=> ['name' => 'CF219A  Drum  CRG049', 'priceInCents' => 190000],
        211=> ['name' => 'CE314 DRUM', 'priceInCents' => 390000],
        212=> ['name' => 'OPCM2000', 'priceInCents' => 209000],
        213=> ['name' => 'SFS51099', 'priceInCents' => 00],
        214=> ['name' => 'SAF51055B', 'priceInCents' => 259000],
        215=> ['name' => 'SFS51055A', 'priceInCents' => 259000],
        216=> ['name' => 'OPCDR1000', 'priceInCents' => 139000],
        217=> ['name' => 'OPC TK4105', 'priceInCents' => 329000],
        218=> ['name' => 'OPCTK1150', 'priceInCents' => 229000],
        219=> ['name' => 'OPCTK410', 'priceInCents' => 319000],
        220=> ['name' => 'OPC EXV33', 'priceInCents' => 219000],
        221=> ['name' => 'Drum3040', 'priceInCents' => 219000],
        222=> ['name' => 'DRUM 210', 'priceInCents' => 219000],
        223=> ['name' => 'DRUM 230', 'priceInCents' => 219000],
        224=> ['name' => 'DRUM 240', 'priceInCents' => 219000],
        225=> ['name' => 'DRUM 270', 'priceInCents' => 219000],
        226=> ['name' => 'DRUM 290', 'priceInCents' => 219000],
        227=> ['name' => 'MSD310 DRUM0', 'priceInCents' => 790000],
        //Bouteille d'Encre
        228=> ['name'=> '30 ML Black', 'priceInCents'=> 2900],
        229=> ['name'=> 'PACK 4 CARTOUCHES 30 ML Black/Cyan/Yellow','priceInCents'=> 10000],
        230=> ['name'=> '100ML Black', 'priceInCents'=> 14900],
        231=> ['name'=> '100ML Black', 'priceInCents'=> 14900],
        232=> ['name'=> '100ML Cyan', 'priceInCents'=> 14900],
        233=> ['name'=> '100ML Magenta', 'priceInCents'=> 14900],
        234=> ['name'=> '100ML Yellow', 'priceInCents'=> 14900],
        235=> ['name'=> 'Sublimation 100ML Black/Cyan Light/Magenta Light','priceInCents'=> 35000],
        236=> ['name'=> '1L Black', 'priceInCents'=> 110000],
        237=> ['name'=> '1L Cyan', 'priceInCents'=> 110000],
        238=> ['name'=> '1L Magenta', 'priceInCents'=> 110000],
        239=> ['name'=> '1L Yellow', 'priceInCents'=> 110000],
        240=> ['name'=> '1L Sublimation Black', 'priceInCents'=> 439000],
        241=> ['name'=> '1L Sublimation Cyan', 'priceInCents'=> 439000],
        242=> ['name'=> '1L Sublimation Magenta', 'priceInCents'=> 439000],
        243=> ['name'=> '1L Sublimation Yellow', 'priceInCents'=> 439000],
        //Bouteille nettoyage 100ML
        244=> ['name'=> 'Bouteille Nettoyage 100ML P690260', 'priceInCents'=> 12000],
        //Papier
        245=> ['name'=> 'Papier P690260', 'priceInCents'=> 29000],
        246=> ['name'=> 'Papier P370110', 'priceInCents'=> 15000],
        247=> ['name'=> 'Papier 661260S', 'priceInCents'=> 9000],
        //Sytème continue epson
        248=> ['name'=> 'Système Continue Epson CISE0709', 'priceInCents'=> 25000],
        249=> ['name'=> 'Système Continue Epson CIS1718', 'priceInCents'=> 25000],
        250=> ['name'=> 'Système Continue Epson CISE3637', 'priceInCents'=> 25000],
        251=> ['name'=> 'Système Continue Epson CISE6667', 'priceInCents'=> 25000],
        252=> ['name'=> 'Système Continue Epson CISE4041', 'priceInCents'=> 25000],
        253=> ['name'=> 'Système Continue Epson CISE2829', 'priceInCents'=> 25000],
        254=> ['name'=> 'Système Continue Epson CISE601', 'priceInCents'=> 25000],
        255=> ['name'=> 'Système Continue Epson CISE321', 'priceInCents'=> 25000],
        256=> ['name'=> 'Système Continue Epson CISE471', 'priceInCents'=> 25000],
        257=> ['name'=> 'Système Continue Epson CISE771', 'priceInCents'=> 35000],
        258=> ['name'=> 'Système Continue Epson CISE901', 'priceInCents'=> 35000],
        259=> ['name'=> 'Système Continue Epson CISE561', 'priceInCents'=> 35000],
        260=> ['name'=> 'Système Continue Epson CISE481', 'priceInCents'=> 35000],
        261=> ['name'=> 'Système Continue Epson CISE491', 'priceInCents'=> 35000],
        262=> ['name'=> 'Système Continue Epson CISE591', 'priceInCents'=> 35000],
        263=> ['name'=> 'Système Continue Epson CISE801', 'priceInCents'=> 69000],
        264=> ['name'=> 'Système Continue Epson CISE811', 'priceInCents'=> 69000],
        265=> ['name'=> 'Système Continue Epson CISE1281', 'priceInCents'=> 69000],
        //Sytème continue HP
        266=> ['name'=> 'Système Continue HP CIS02/01', 'priceInCents'=> 85000],
        267=> ['name'=> 'Système Continue HP CIS21/22', 'priceInCents'=> 85000],
        268=> ['name'=> 'Système Continue HP CIS27/28', 'priceInCents'=> 85000],
        269=> ['name'=> 'Système Continue HP CIS56/57', 'priceInCents'=> 85000],
        //Sytème continue canon
        270=> ['name'=> 'Système Continue Canon CISBJ4', 'priceInCents'=> 25000],
        271=> ['name'=> 'Système Continue Canon CISBJ5', 'priceInCents'=> 25000],
        272=> ['name'=> 'Système Continue Canon CIS24', 'priceInCents'=> 25000],
        273=> ['name'=> 'Système Continue Canon CIS4840', 'priceInCents'=> 25000],
        // Pack cartouche vide
        274 => ['name'=> 'Pack Cartouche Vide 921--924', 'priceInCents'=> 25000],
        275 => ['name'=> '(D78/D92DX4500) + 4 Bouteille 30ML', 'priceInCents'=> 35000],
        276 => ['name'=> 'Pack Cartouche Vide 1281--1284', 'priceInCents'=> 25000],
        277 => ['name'=> '(sx125/130/230) + 4 Bouteille 30ML', 'priceInCents'=> 35000],
        278 => ['name'=> 'Pack Cartouche Vide 801--806', 'priceInCents'=> 25000],
        279 => ['name'=> '(P50/R265/R360)', 'priceInCents'=> 49000],
        //Cartouche epson
        280 => ['name'=> 'ET1802… 1804', 'priceInCents'=> 0],
        281 => ['name'=> 'ET1811….1814', 'priceInCents'=> 0],
        282 => ['name'=> 'ET1281….1284', 'priceInCents'=> 0],
        283 => ['name'=> 'ET2991… 2994', 'priceInCents'=> 13900],
        284 => ['name'=> 'ET0711/712', 'priceInCents'=> 0],
        285 => ['name'=> 'ET0921…..924', 'priceInCents'=> 0],
        286 => ['name'=> 'ET0731…..734', 'priceInCents'=> 7900],
        287 => ['name'=> 'ET073C/M/Y', 'priceInCents'=> 7900],
        288 => ['name'=> 'T01171N', 'priceInCents'=> 8500],
        289 => ['name'=> 'ET073N C/M/Y', 'priceInCents'=> 8500],
        290 => ['name'=> 'ET090N', 'priceInCents'=> 6900],
        291 => ['name'=> 'ET007-N ET009-C', 'priceInCents'=> 2000],
        292 => ['name'=> 'ET017-N ET018-C', 'priceInCents'=> 1500],
        293 => ['name'=> 'ET019-N ET020-C', 'priceInCents'=> 2000],
        294 => ['name'=> 'ET026-N ET027-C', 'priceInCents'=> 1900],
        295 => ['name'=> 'ET028-N ET029-C', 'priceInCents'=> 2000],
        296 => ['name'=> 'ET036-N ET037-C', 'priceInCents'=> 3500],
        297 => ['name'=> 'ET038-N ET039-C', 'priceInCents'=> 3500],
        298 => ['name'=> 'ET040-N ET041-C', 'priceInCents'=> 2500],
        299 => ['name'=> 'ET066-N ET067-C', 'priceInCents'=> 2500],
        300 => ['name'=> 'ET1001-N', 'priceInCents'=> 5900],
        301 => ['name'=> 'ET711H', 'priceInCents'=> 9500],
        302 => ['name'=> 'ET1002-1003-1004', 'priceInCents'=> 9500],
        303 => ['name'=> 'ET0187-N/050', 'priceInCents'=> 4500],
        304 => ['name'=> 'ET0193-C /53', 'priceInCents'=> 6500],
        305 => ['name'=> 'ET1 91-C/052', 'priceInCents'=> 6500],
        306 => ['name'=> 'ET0321 …..324', 'priceInCents'=> 2500],
        307 => ['name'=> 'ET0422 ….424', 'priceInCents'=> 2500],
        308 => ['name'=> 'ET0441 …..444', 'priceInCents'=> 3500],
        309 => ['name'=> 'ET0461…...474', 'priceInCents'=> 3500],
        310 => ['name'=> 'ET0481 …..486', 'priceInCents'=> 3500],
        311 => ['name'=> 'ET0491 …..496', 'priceInCents'=> 4500],
        312 => ['name'=> 'ET0551 …..554', 'priceInCents'=> 3500],
        313 => ['name'=> 'ET0601 …..604', 'priceInCents'=> 3500],
        314 => ['name'=> 'ET0611 …..614', 'priceInCents'=> 3000],
        315 => ['name'=> 'ET0631 …..634', 'priceInCents'=> 3000],
        316 => ['name'=> 'ET0771 …..776', 'priceInCents'=> 3000],
        317 => ['name'=> 'ET0801 …..806', 'priceInCents'=> 3500],
        318 => ['name'=> 'ET0811 …..816', 'priceInCents'=> 3500],
        //cartouche hp
        319 => ['name'=> 'CHP932BK', 'priceInCents'=> 97000],
        320 => ['name'=> 'CHP932C', 'priceInCents'=> 97000],
        321 => ['name'=> 'CHP932M', 'priceInCents'=> 97000],
        322 => ['name'=> 'CHP932Y', 'priceInCents'=> 97000],
        323 => ['name'=> 'HP920bXL', 'priceInCents'=> 29000],
        324 => ['name'=> 'HP920C/M/Y', 'priceInCents'=> 29000],
        325 => ['name'=> 'HP51629A', 'priceInCents'=> 69000],
        326 => ['name'=> 'CH49A/N', 'priceInCents'=> 69000],
        327 => ['name'=> 'CH14A/20 N', 'priceInCents'=> 65000],
        328 => ['name'=> 'HP 51626A', 'priceInCents'=> 65000],
        329 => ['name'=> 'HP1823D', 'priceInCents'=> 85000],
        330 => ['name'=> 'HP 6617D/25', 'priceInCents'=> 79000],
        331 => ['name'=> 'HP130', 'priceInCents'=> 109000],
        332 => ['name'=> 'HP131 C8765', 'priceInCents'=> 109000],
        333 => ['name'=> 'HP135 C8766', 'priceInCents'=> 109000],
        334 => ['name'=> 'HP121BK/640 XL', 'priceInCents'=> 119000],
        335 => ['name'=> 'CH10BK', 'priceInCents'=> 29000],
        336 => ['name'=> 'CH82C', 'priceInCents'=> 29000],
        337 => ['name'=> 'CH82M', 'priceInCents'=> 29000],
        338 => ['name'=> 'CH82Y', 'priceInCents'=> 29000],
        339 => ['name'=> 'CH11C /4836', 'priceInCents'=> 19000],
        340 => ['name'=> 'CH11M /4836', 'priceInCents'=> 19000],
        341 => ['name'=> 'CH11Y /4836', 'priceInCents'=> 19000],
        //cartouche canon
        342 => ['name'=> 'PGI270BK', 'priceInCents'=> 13500],
        343 => ['name'=> 'CL271C', 'priceInCents'=> 13500],
        344 => ['name'=> 'CL271M', 'priceInCents'=> 13500],
        345 => ['name'=> 'CL271Y', 'priceInCents'=> 13500],
        346 => ['name'=> 'CL271GY', 'priceInCents'=> 13500],
        347 => ['name'=> 'PGI470BK', 'priceInCents'=> 12900],
        348 => ['name'=> 'CL471C', 'priceInCents'=> 12900],
        349 => ['name'=> 'CL471M', 'priceInCents'=> 12900],
        350 => ['name'=> 'CL471Y', 'priceInCents'=> 12900],
        351 => ['name'=> 'CL471BK', 'priceInCents'=> 12900],
        352 => ['name'=> 'CC520BK', 'priceInCents'=> 11900],
        353 => ['name'=> 'CC521BC', 'priceInCents'=> 11900],
        354 => ['name'=> 'CC521BM', 'priceInCents'=> 11900],
        355 => ['name'=> 'CC521BY', 'priceInCents'=> 11900],
        356 => ['name'=> 'CC521BK', 'priceInCents'=> 11900],
        357 => ['name'=> 'PGI550BK', 'priceInCents'=> 9500],
        358 => ['name'=> 'CL551C', 'priceInCents'=> 9500],
        359 => ['name'=> 'CL551M', 'priceInCents'=> 9500],
        360 => ['name'=> 'CL551Y', 'priceInCents'=> 9500],
        361 => ['name'=> 'CL551BK', 'priceInCents'=> 9500],
        362 => ['name'=> 'CCPGI-1500 B', 'priceInCents'=> 45000],
        363 => ['name'=> 'CCPGI-1500 C', 'priceInCents'=> 45000],
        364 => ['name'=> 'CCPGI-1500 M', 'priceInCents'=> 45000],
        365 => ['name'=> 'CCPGI-1500 Y', 'priceInCents'=> 45000],
        366 => ['name'=> 'C24BK-N C24C-C', 'priceInCents'=> 1500],
        367 => ['name'=> 'C3E B/C/M/Y', 'priceInCents'=> 1500],
        368 => ['name'=> 'CLI8 BC/M/Y', 'priceInCents'=> 4900],
        //cartouche brother
        369 => ['name'=> 'CB11/16 B', 'priceInCents'=> 23000],
        370 => ['name'=> 'CB11/16 C', 'priceInCents'=> 23000],
        371 => ['name'=> 'CB11/16 M', 'priceInCents'=> 23000],
        372 => ['name'=> 'CB11/16 Y', 'priceInCents'=> 23000],
        373 => ['name'=> 'CB12 B/C/M/Y', 'priceInCents'=> 8900],
        374 => ['name'=> 'CB39/985 B/C/M/Y', 'priceInCents'=> 7500],
        375 => ['name'=> 'CB103 BK/C/M/Y', 'priceInCents'=> 7900],
        376 => ['name'=> 'CB123BK/121 B', 'priceInCents'=> 37000],
        377 => ['name'=> 'CB123BK/121 C', 'priceInCents'=> 37000],
        378 => ['name'=> 'CB123BK/121 M', 'priceInCents'=> 37000],
        379 => ['name'=> 'CB123BK/121 Y', 'priceInCents'=> 37000],
        380 => ['name'=> 'CB221/223 BK', 'priceInCents'=> 15900],
        381 => ['name'=> 'CB221/223 C', 'priceInCents'=> 15900],
        382 => ['name'=> 'CB221/223 M', 'priceInCents'=> 15900],
        383 => ['name'=> 'CB221/223 Y', 'priceInCents'=> 15900],
        384 => ['name'=> 'CB3213', 'priceInCents'=> 43000],
        385 => ['name'=> 'CB3219BK/C/M/Y', 'priceInCents'=> 49000],
        //toner hp laser monochrome
        386 => ['name'=> 'HP W1106A', 'priceInCents'=> 299000],
        387 => ['name'=> 'HP W1107A', 'priceInCents'=> 299000],
        388 => ['name'=> 'CF217', 'priceInCents'=> 129000],
        389 => ['name'=> 'CF226A', 'priceInCents'=> 149000],
        390 => ['name'=> 'CF230/CRG051', 'priceInCents'=> 139000],
        391 => ['name'=> 'CF244', 'priceInCents'=> 0],  
        392 => ['name'=> 'CE255', 'priceInCents'=> 0],  
        393 => ['name'=> 'CE260A', 'priceInCents'=> 490000],
        394 => ['name'=> 'CF279A', 'priceInCents'=> 0],  
        395 => ['name'=> 'CF283X/LC137/337/737', 'priceInCents'=> 129000],
        396 => ['name'=> 'CE435/436/285/CE278', 'priceInCents'=> 129000],
        397 => ['name'=> 'CB436A', 'priceInCents'=> 89000],
        398 => ['name'=> 'CE390A', 'priceInCents'=> 320000],
        399 => ['name'=> 'CE505A/280A', 'priceInCents'=> 139000],
        400 => ['name'=> 'Q1339A', 'priceInCents'=> 329000],
        401 => ['name'=> 'Q2612A/FX10', 'priceInCents'=> 129000],
        402 => ['name'=> 'Q2613A', 'priceInCents'=> 119000],
        403 => ['name'=> 'Q2624A', 'priceInCents'=> 119000],
        404 => ['name'=> 'C3906A', 'priceInCents'=> 119000],
        405 => ['name'=> 'C4092A EP22', 'priceInCents'=> 159000],
        406 => ['name'=> 'C4096A', 'priceInCents'=> 179000],
        407 => ['name'=> 'C4127A/EP52', 'priceInCents'=> 295000],
        408 => ['name'=> 'C4129/EP62', 'priceInCents'=> 329000],
        409 => ['name'=> 'C4182/EP27', 'priceInCents'=> 329000],
        410 => ['name'=> 'Q5949A/Q7553A', 'priceInCents'=> 189000],
        411 => ['name'=> 'Q6511X', 'priceInCents'=> 390000],
        412 => ['name'=> 'C7115A', 'priceInCents'=> 129000],
        413 => ['name'=> 'Q7551A', 'priceInCents'=> 249000],
        414 => ['name'=> 'C8061A', 'priceInCents'=> 219000],
        //Toner hp laser couleur
        415 => ['name'=> 'CE250X/251/252/253 B', 'priceInCents'=> 449000],
        416 => ['name'=> 'CE250X/251/252/253 C', 'priceInCents'=> 449000],
        417 => ['name'=> 'CE250X/251/252/253 M', 'priceInCents'=> 449000],
        418 => ['name'=> 'CE250X/251/252/253 Y', 'priceInCents'=> 449000],
        419 => ['name'=> 'CE310/CF350A (C729)', 'priceInCents'=> 129000],
        420 => ['name'=> 'CE311-312-313', 'priceInCents'=> 129000],
        421 => ['name'=> 'CE320A', 'priceInCents'=> 149000],
        422 => ['name'=> 'CE321-322-323', 'priceInCents'=> 149000],
        423 => ['name'=> 'CF400/CANON 045', 'priceInCents'=> 209000],
        424 => ['name'=> 'CF401/402/403', 'priceInCents'=> 209000],
        425 => ['name'=> 'CE400/CE205A', 'priceInCents'=> 499000],
        426 => ['name'=> 'CE401/402/403', 'priceInCents'=> 499000],
        427 => ['name'=> 'CF510A', 'priceInCents'=> 189000],
        428 => ['name'=> 'CF511', 'priceInCents'=> 189000],
        429 => ['name'=> 'CF512', 'priceInCents'=> 189000],
        430 => ['name'=> 'CF513', 'priceInCents'=> 189000],
        431 => ['name'=> 'CC530A/CE410A/CF380/C718', 'priceInCents'=> 169000],
        432 => ['name'=> 'CC531', 'priceInCents'=> 169000],
        433 => ['name'=> 'CC532', 'priceInCents'=> 169000],
        434 => ['name'=> 'CC533', 'priceInCents'=> 169000],
        435 => ['name'=> 'CF530HP205A', 'priceInCents'=> 229000],
        436 => ['name'=> 'CF531/532/533', 'priceInCents'=> 229000],
        437 => ['name'=> 'CB540A/CE320A/CF210/LC131/331/731A', 'priceInCents'=> 195000],
        438 => ['name'=> 'CB541', 'priceInCents'=> 195000],
        439 => ['name'=> 'CB542', 'priceInCents'=> 195000],
        440 => ['name'=> 'CB543', 'priceInCents'=> 195000],
        441 => ['name'=> 'Q2670', 'priceInCents'=> 379000],
        442 => ['name'=> 'Q2671', 'priceInCents'=> 379000],
        443 => ['name'=> 'Q2672', 'priceInCents'=> 379000],
        444 => ['name'=> 'Q2673', 'priceInCents'=> 379000],
        445 => ['name'=> 'HP3960 BLACK', 'priceInCents'=> 290000],
        446 => ['name'=> 'Q6000 BCMY', 'priceInCents'=> 199000],
        447 => ['name'=> 'Q6001 BCMY', 'priceInCents'=> 199000],
        448 => ['name'=> 'Q6002 BCMY', 'priceInCents'=> 199000],
        449 => ['name'=> 'Q6003 BCMY', 'priceInCents'=> 199000],
        450 => ['name'=> 'C6460 BCMY', 'priceInCents'=> 550000],
        451 => ['name'=> 'C6461 BCMY', 'priceInCents'=> 550000],
        452 => ['name'=> 'C6462 BCMY', 'priceInCents'=> 550000],
        453 => ['name'=> 'C6463 BCMY', 'priceInCents'=> 550000],
        454 => ['name'=> 'C9720 BCMY', 'priceInCents'=> 590000],
        455 => ['name'=> 'C9721 BCMY', 'priceInCents'=> 590000],
        456 => ['name'=> 'C9722 BCMY', 'priceInCents'=> 590000],
        457 => ['name'=> 'C9723 BCMY', 'priceInCents'=> 590000],
        //toner canon
        458 => ['name'=> 'CRG047', 'priceInCents'=> 139000],
        459 => ['name'=> 'CRG052', 'priceInCents'=> 169000],
        460 => ['name'=> 'CRG054 BK/C/M/Y', 'priceInCents'=> 00], 
        461 => ['name'=> 'CRG057 BK/C/M/Y', 'priceInCents'=> 199000],
        462 => ['name'=> 'EXV5 NPG-20/GPR-8', 'priceInCents'=> 119000],
        463 => ['name'=> 'EXV14/EXV5/GPR-18/NPG-28', 'priceInCents'=> 119000],
        464 => ['name'=> 'EXV18/ GPR-22/NPG-32', 'priceInCents'=> 149000],
        465 => ['name'=> 'EXV33/NPG51/ GPR35', 'priceInCents'=> 159000],
        466 => ['name'=> 'EXV36 -/NPG54/GPR38', 'priceInCents'=> 699000],
        467 => ['name'=> 'EXV40', 'priceInCents'=> 139000],
        468 => ['name'=> 'E-XV42/ NPG-59/GPR45', 'priceInCents'=> 119000],
        469 => ['name'=> 'EXV60', 'priceInCents'=> 159000],
        470 => ['name'=> 'TC045 BCMY', 'priceInCents'=> 00],
        471 => ['name'=> 'TC119', 'priceInCents'=> 169000],
        472 => ['name'=> 'TC319', 'priceInCents'=> 169000],
        473 => ['name'=> 'TC719H', 'priceInCents'=> 169000],
        474 => ['name'=> 'TCCE505', 'priceInCents'=> 169000],
        475 => ['name'=> 'LC129/329/729B (CE310)', 'priceInCents'=> 129000],
        476 => ['name'=> 'LC129/329/729C (CE310)', 'priceInCents'=> 129000],
        477 => ['name'=> 'LC129/329/729M (CE310)', 'priceInCents'=> 129000],
        478 => ['name'=> 'LC129/329/729Y (CE310)', 'priceInCents'=> 129000],
        479 => ['name'=> 'LC118/318/718BK', 'priceInCents'=> 269000],
        480 => ['name'=> 'LC118/318/718C', 'priceInCents'=> 269000],
        481 => ['name'=> 'LC118/318/718M', 'priceInCents'=> 269000],
        482 => ['name'=> 'LC118/318/718Y', 'priceInCents'=> 269000],
        483 => ['name'=> 'LC116/316/716BK', 'priceInCents'=> 199000],
        484 => ['name'=> 'LC116/316/716C', 'priceInCents'=> 199000],
        485 => ['name'=> 'LC116/316/716M', 'priceInCents'=> 199000],
        486 => ['name'=> 'LC116/316/716Y', 'priceInCents'=> 199000],
        487 => ['name'=> 'E30/31/40', 'priceInCents'=> 249000],
        //toner samsung
        488 => ['name'=> 'T101-2160', 'priceInCents'=> 00], 
        489 => ['name'=> 'T104-1660', 'priceInCents'=> 00], 
        490 => ['name'=> 'T105-1910', 'priceInCents'=> 169000],
        491 => ['name'=> 'T108-1640', 'priceInCents'=> 179000],
        492 => ['name'=> 'LT111', 'priceInCents'=> 169000],
        493 => ['name'=> 'T205S', 'priceInCents'=> 279000],
        494 => ['name'=> 'ML1210', 'priceInCents'=> 209000],
        495 => ['name'=> 'ML1610', 'priceInCents'=> 149000],
        496 => ['name'=> 'ML1710', 'priceInCents'=> 149000],
        497 => ['name'=> 'ML2010', 'priceInCents'=> 239000],
        498 => ['name'=> 'ML2150', 'priceInCents'=> 299000],
        499 => ['name'=> 'ML2250', 'priceInCents'=> 179000],
        500 => ['name'=> 'ML4100', 'priceInCents'=> 169000],
        501 => ['name'=> 'ML4500', 'priceInCents'=> 179000],
        502 => ['name'=> 'ML5800', 'priceInCents'=> 269000],
        503 => ['name'=> 'SCX4300-T109', 'priceInCents'=> 159000],
        504 => ['name'=> 'SCX4520', 'priceInCents'=> 269000],
        505 => ['name'=> 'SCX4720', 'priceInCents'=> 249000],
        506 => ['name'=> 'CLP300 B', 'priceInCents'=> 39000],
        507 => ['name'=> 'CLP300 C', 'priceInCents'=> 39000],
        508 => ['name'=> 'CLP300 M', 'priceInCents'=> 39000],
        508 => ['name'=> 'CLP300 M', 'priceInCents'=> 39000],
        509 => ['name'=> 'CLP300 Y', 'priceInCents'=> 39000],
        510 => ['name'=> 'SK510BK', 'priceInCents'=> 399000],
        511 => ['name'=> 'SK510C', 'priceInCents'=> 399000],
        512 => ['name'=> 'SK510M', 'priceInCents'=> 399000],
        513 => ['name'=> 'SK510Y', 'priceInCents'=> 399000],
        514 => ['name'=> 'LSC404 B', 'priceInCents'=> 219000],
        515 => ['name'=> 'LSC404 C', 'priceInCents'=> 219000],
        516 => ['name'=> 'LSC404 M', 'priceInCents'=> 219000],
        517 => ['name'=> 'LSC404 Y', 'priceInCents'=> 219000],
        518 => ['name'=> 'LSC406 B', 'priceInCents'=> 149000],
        519 => ['name'=> 'LSC406 C', 'priceInCents'=> 149000],
        520 => ['name'=> 'LSC406 M', 'priceInCents'=> 149000],
        521 => ['name'=> 'LSC406 Y', 'priceInCents'=> 149000],
        522 => ['name'=> 'LST409 B', 'priceInCents'=> 149000],
        523 => ['name'=> 'LST409 C', 'priceInCents'=> 149000],
        524 => ['name'=> 'LST409 M', 'priceInCents'=> 149000],
        525 => ['name'=> 'LST409 Y', 'priceInCents'=> 149000],
        526 => ['name'=> 'TST407/409 B', 'priceInCents'=> 159000],
        527 => ['name'=> 'TST407/409 C', 'priceInCents'=> 159000],
        528 => ['name'=> 'TST407/409 M', 'priceInCents'=> 159000],
        529 => ['name'=> 'TST407/409 Y', 'priceInCents'=> 159000],
        //toner mita
        530 => ['name'=> 'TK17', 'priceInCents'=> 109000],
        531 => ['name'=> 'TK100/TK113', 'priceInCents'=> 99000],
        532 => ['name'=> 'TK113', 'priceInCents'=> 99000],
        533 => ['name'=> 'TK120/122', 'priceInCents'=> 99000],
        534 => ['name'=> 'TK130/132/134', 'priceInCents'=> 109000],
        535 => ['name'=> 'TK170', 'priceInCents'=> 109000],
        536 => ['name'=> 'TK410/420/435', 'priceInCents'=> 239000],
        537 => ['name'=> 'TK418', 'priceInCents'=> 219000],
        538 => ['name'=> 'TK428', 'priceInCents'=> 259000],
        539 => ['name'=> 'TK435/437/439/458/448h', 'priceInCents'=> 249000],
        540 => ['name'=> 'TK1110/1112', 'priceInCents'=> 99000],
        541 => ['name'=> 'TK1120', 'priceInCents'=> 89000],
        542 => ['name'=> 'TK1130/1132', 'priceInCents'=> 109000],
        543 => ['name'=> 'TK1140', 'priceInCents'=> 129000],
        544 => ['name'=> 'TK1150', 'priceInCents'=> 149000],
        545 => ['name'=> 'TK1170', 'priceInCents'=> 129000],
        546 => ['name'=> 'TK4105', 'priceInCents'=> 249000],
        547 => ['name'=> 'TK1525/1530', 'priceInCents'=> 209000],
        548 => ['name'=> 'TK3160', 'priceInCents'=> 229000],
        //Toner epson
        549 => ['name'=> 'M2000', 'priceInCents'=> 109000],
        550 => ['name'=> 'M2300/2400', 'priceInCents'=> 129000],
        551 => ['name'=> 'M300', 'priceInCents'=> 139000],
        552 => ['name'=> 'C1100 B', 'priceInCents'=> 109000],
        553 => ['name'=> 'C1100 C', 'priceInCents'=> 109000],
        554 => ['name'=> 'C1100 M', 'priceInCents'=> 109000],
        555 => ['name'=> 'C1100 Y', 'priceInCents'=> 109000],
        556 => ['name'=> 'C1600B', 'priceInCents'=> 135000],
        557 => ['name'=> 'C1600C', 'priceInCents'=> 135000],
        558 => ['name'=> 'C1600M', 'priceInCents'=> 135000],
        559 => ['name'=> 'C1600Y', 'priceInCents'=> 135000],
        560 => ['name'=> 'EP5700/5900 -50010', 'priceInCents'=> 219000],
        561 => ['name'=> 'EP6200 -50167', 'priceInCents'=> 00],  
        562 => ['name'=> 'EP5900 -50087', 'priceInCents'=> 189000],
        563 => ['name'=> 'RBLQ1170', 'priceInCents'=> 12000],
        564 => ['name'=> 'RBDFX5/8', 'priceInCents'=> 29000],
        //toner brother
        565 => ['name'=> 'TBTN360', 'priceInCents'=> 149000],
        566 => ['name'=> 'TB1000/1030/1050/1060/1070', 'priceInCents'=> 99000],
        567 => ['name'=> 'TB580', 'priceInCents'=> 159000],
        568 => ['name'=> 'TB670', 'priceInCents'=> 159000],
        569 => ['name'=> 'TB315/325/310/230B', 'priceInCents'=> 189000],
        570 => ['name'=> 'TB315/325/310/230C', 'priceInCents'=> 189000],
        571 => ['name'=> 'TB315/325/310/230M', 'priceInCents'=> 189000],
        572 => ['name'=> 'TB315/325/310/230Y', 'priceInCents'=> 189000],
        573 => ['name'=> 'TB210/230/240/270/290B', 'priceInCents'=> 179000],
        574 => ['name'=> 'TB210/230/240/270/290C', 'priceInCents'=> 179000],
        575 => ['name'=> 'TB210/230/240/270/290M', 'priceInCents'=> 179000],
        576 => ['name'=> 'TB210/230/240/270/290Y', 'priceInCents'=> 179000],
        577 => ['name'=> 'TN247 B', 'priceInCents'=> 249000],
        578 => ['name'=> 'TN247 C', 'priceInCents'=> 249000],
        579 => ['name'=> 'TN247 M', 'priceInCents'=> 249000],
        580 => ['name'=> 'TN247 Y', 'priceInCents'=> 249000],
        //toner lexmark
        581 => ['name'=> 'E210', 'priceInCents'=> 169000],
        582 => ['name'=> 'E250/N', 'priceInCents'=> 139000],
        583 => ['name'=> 'E260', 'priceInCents'=> 329000],
        584 => ['name'=> 'E260 DRUM', 'priceInCents'=> 00], 
        585 => ['name'=> 'E230/232', 'priceInCents'=> 195000],
        586 => ['name'=> 'MS310', 'priceInCents'=> 490000],
        587 => ['name'=> 'E450/N', 'priceInCents'=> 195000],
        //toner dell
        588 => ['name'=> 'TDEL1160', 'priceInCents'=> 159000],
        //toner oki
        589 => ['name'=> 'LOB4600', 'priceInCents'=> 169000],
        590 => ['name'=> 'LOB410', 'priceInCents'=> 149000],
        //toner ricoh
        591 => ['name'=> 'TRSP200/201', 'priceInCents'=> 259000],
        592 => ['name'=> 'TRSP310/311', 'priceInCents'=> 239000],
        //toner xerox
        593 => ['name'=> 'TX5020', 'priceInCents'=> 109000],
        //toner panasonic
        594 => ['name'=> 'TP83E', 'priceInCents'=> 79000],
        595 => ['name'=> 'TPKX-FAT411E', 'priceInCents'=> 89000],
        596 => ['name'=> 'TPFA84E DRUM', 'priceInCents'=> 690000],
    ];
    return isset($storeItems[$productId]) ? $storeItems[$productId] : null;
}

// Charger les données de stock depuis le fichier JSON
$products = json_decode(file_get_contents('stock.json'), true);

// Ajoute un produit au panier
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    
    if ($products[$productId]['stock'] > 0) {
        if (array_key_exists($productId, $_SESSION['cart'])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            $productDetails = getProductDetails($productId);
            if ($productDetails) {
                $_SESSION['cart'][$productId] = [
                    'name' => $productDetails['name'],
                    'price' => $productDetails['priceInCents'] / 100,
                    'quantity' => 1
                ];
            }
        }
        
        // Décrémenter le stock du produit
        $products[$productId]['stock']--;
        
        // Sauvegarder les nouvelles données de stock
        file_put_contents('stock.json', json_encode($products));
    } else {
        echo "Le produit est en rupture de stock.";
    }
}

// Retire un produit du panier
if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    if (array_key_exists($productId, $_SESSION['cart'])) {
        $quantity = $_SESSION['cart'][$productId]['quantity'];
        
        // Supprimer le produit du panier
        unset($_SESSION['cart'][$productId]);
        
        // Réajuster le stock
        $products[$productId]['stock'] += $quantity;
        
        // Sauvegarder les nouvelles données de stock
        file_put_contents('stock.json', json_encode($products));
    }
}

// Calcul du montant total du panier
$totalAmount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}
$_SESSION['totalAmount'] = $totalAmount; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>


    <main class="cart-container">
        <h2>Votre Panier</h2>

        <div class="cart-items">
            <?php if (empty($_SESSION['cart'])) : ?>
                <p>Votre panier est vide.</p>
            <?php else : ?>
                <?php foreach ($_SESSION['cart'] as $productId => $item) : ?>
                    <div class="cart-item">
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p>Prix: <?php echo number_format($item['price'], 2); ?> DA</p>
                            <p>Quantité: <?php echo $item['quantity']; ?></p>
                        </div>
                        <div class="product-actions">
                            <form action="cart.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                <button type="submit" name="remove_from_cart">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <h3>Résumé du panier</h3>
            <p>Total: <?php echo $totalAmount; ?> DA</p>
        </div>

        <button id="checkout-button">Payer</button>

        <script>
            var stripe = Stripe('clé public');
            var checkoutButton = document.getElementById('checkout-button');

            checkoutButton.addEventListener('click', function () {
                fetch('/project/client/create_checkout_session.php', {
                    method: 'POST',
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    return stripe.redirectToCheckout({ sessionId: data.id });
                })
                .then(function (result) {
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
            });
        </script>
    </main>
    <?php include '../includes/footer.php';?>
</body>
</html>
