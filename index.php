<?php
include 'config.php';

$query = $config->query("SELECT id, merk, harga_jual, satuan_barang, stok, nama_barang FROM barang");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
$queryToko = $config->query("SELECT * FROM toko")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($queryToko['nama_toko'], ENT_QUOTES, 'UTF-8'); ?></title>
    
    <!-- Font Awesome for icons (without integrity) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="assets/css/toko.css"> -->
   
   <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Prevents horizontal scrolling */
            background-color: #f4f4f4; /* Background color to match the container */
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;
        }
        .title-section {
            border: 1px solid #ddd;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 50%;
            /* max-width: 230px; */
            height: 50%;
            margin-right: auto;
            margin-left: auto;
            margin-top: 10px;
            flex-grow: 1;
            flex-basis: calc(25% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            display: grid;
            grid-template-rows: auto 1fr auto;
            gap: 10px;
        }
        .product-card img {
            width: 200px;
            height: 200px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            align-self: center;
        }
        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #34495e;
        }
        .product-card p {
            margin: 5px 0;
            color: #555;
        }
        .product-card .price {
            color: #e74c3c;
            font-size: 16px;
            margin: 10px 0;
        }
        .product-card .btn-chat {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .product-card .btn-chat:hover {
            background-color: #2980b9;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            max-width: 200px;
            height: 200px;
        }
        @media (max-width: 768px) {
            .product-card {
                flex-basis: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .product-card {
                flex-basis: 100%;
            }
        }

        /* Style for the floating WhatsApp button */
        .wa-button {
            position: fixed;
            bottom: 20px; /* Adjusted to prevent any overlap with the white line */
            right: 20px;
            z-index: 2147483647;
            width: 65px;
            height: 65px;
            background-color: #25D366; /* WhatsApp green */
            color: #24D366;
            border-radius: 50%;
            display: flex;
  

        }
        .wa-button:hover {
            background-color: #128C7E; /* Darker WhatsApp green on hover */
            color: #128C7E;

        }
        .wa-button i {
            font-size: 30px;
    line-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%; /* Ensures the icon is centered */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section">
            <img src="assets/gambar/logo_anekaBotol.jpg" alt="Logo Sumber Aneka Botol" width="120px" height="100px" >
            <img src="assets/gambar/title_anekaBotol.jpg" alt="Logo Sumber Aneka Botol" width="200px" height="50px" >

            <!-- <a href="#nav" class="meanmenu-reveal" style="right: 0px; left: auto; text-align: center; text-indent: 0px; font-size: 18px;"><span></span><span></span><span></span></a> -->
        </div>
        



      








        
        <div class="product-grid">
            <?php foreach ($products as $product): 
                $message = urlencode("Halo, saya tertarik untuk membeli produk berikut:\n\nNama Barang: " . htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8') . "\nMerk: " . htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8') . "\nHarga: Rp " . htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8') . "\nSatuan: " . htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'));
            ?>
                <div class="product-card">
                    <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" class="center">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="merk"><?php echo htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="price">Rp <?php echo htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="satuan"><?php echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a href="https://wa.me/6285158242422?text=<?php echo $message; ?>" class="btn-chat">CHAT</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281802134040"  class="wa-button">
        <i class="fab fa-whatsapp" style="font-size:40px;color:white;"></i> <!-- Font Awesome WhatsApp icon -->
    </a>
</body>
</html>
