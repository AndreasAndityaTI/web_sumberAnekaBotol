<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

// Fetch products
$query = $config->query("SELECT *FROM barang");
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Fetch alamat details

$query_alamat = $config->query("SELECT id, isi FROM alamat");
$alamats = $query_alamat->fetchAll(PDO::FETCH_ASSOC);

// Fetch kontak details

$query_kontak = $config->query("SELECT id, isi,info FROM kontak");
$kontaks = $query_kontak->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Validate product ID
    if ($product_id <= 0) {
        die('Invalid product ID.');
    }
    
    try {
        $query = $config->prepare("SELECT * FROM barang WHERE id = ?");
        $query->execute([$product_id]);
        $product = $query->fetch(PDO::FETCH_ASSOC);

        // Check if product exists
        if (!$product) {
            die('Product not found!');
        }
    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    die('Product ID is not specified!');
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/sumberAnekaBotol.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dropdown.css">

    <script src="assets/js/dropdown.js"></script>

    <style>
        .title-section {
            padding: 10px 0;
        }
        .title-section img {
          max-width: 100%;
            height: auto;
        }
        .title-section .input-group {
            max-width: 300px;
        }
        .dropdown .dropdown-menu {
            display: none;
        }
        .dropdown.open .dropdown-menu {
            display: block;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .hamburger-menu {
          border: 0px solid transparent;


          background-color: rgba(255,255,255,0.6);
          margin-left: -55%; /* Adjust this value to set the desired left margin */
        }


        .product-info {
    display: flex;
    align-items: center;
}

.product-info img {
    margin-right: 20px;
}

.product-info .description {
    max-width: 600px;
}
    </style>
</head>
<body>
    <div class="container">
        
    
    <div class="title-section row align-items-center justify-content-between" >
            <div class="col-8 col-md-4 d-flex align-items-center" >
                <button class="btn btn-secondary d-md-none me-3 hamburger-menu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/gambar/dropdown.png" alt="dropdown" width="30px">
                </button>
                <img src="assets/gambar/logo_anekaBotol.jpg" alt="Logo Sumber Aneka Botol" width="50px">
                <img src="assets/gambar/title_anekaBotol.jpg" alt="Logo Sumber Aneka Botol" width="185px" class="ms-3">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#about">About</a></li>
                    <li><a class="dropdown-item" href="#base">Base</a></li>
                    <li><a class="dropdown-item" href="#blog">Blog</a></li>
                    <li><a class="dropdown-item" href="#contact">Contact</a></li>
                    <li><a class="dropdown-item" href="#custom">Custom</a></li>
                    <li><a class="dropdown-item" href="#support">Support</a></li>
                    <li><a class="dropdown-item" href="#tools">Tools</a></li>
                </ul>
            </div>
            <div class="col-md-4 d-none d-md-block text-end">
                <div class="dropdown">
                    <button onclick="tampil_isiDropdown()" class="dropbtn">
                        <img src="assets/gambar/dropdown.png" alt="dropdown" width="30px">
                        <a>Kategori</a>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="#about">About</a>
                        <a href="#base">Base</a>
                        <a href="#blog">Blog</a>
                        <a href="#contact">Contact</a>
                        <a href="#custom">Custom</a>
                        <a href="#support">Support</a>
                        <a href="#tools">Tools</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mt-3 mt-md-0 text-end">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                    <button type="button" class="btn btn-outline-primary" data-mdb-ripple-init>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>



        <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom overflow-hidden text-center bg-body-tertiary border rounded-3">
      <li class="breadcrumb-item">
        <a class="link-body-emphasis fw-semibold text-decoration-none" href="index.php">
          <svg class="bi" width="16" height="16"><use xlink:href="#house-door-fill"></use></svg>
          Home
        </a>
      </li>

      <li class="breadcrumb-item active" aria-current="page">
        Detail Produk
      </li>
    </ol>
  </nav>







        <div class="product-info">
    <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" 
         alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" 
         class="img-fluid" 
         style="width: 200px; height: 150px;">
    <div class="description">
        <h1><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><strong>Harga:</strong> Rp <?php echo htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Satuan:</strong> <?php echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Stok:</strong> <?php echo htmlspecialchars($product['stok'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($product['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</div>


        <footer class="text-center text-lg-start bg-body-tertiary text-muted">
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <div>
                    <a href="" class="me-4 text-reset"><i class="fab fa-facebook-f"></i></a>
                    <a href="" class="me-4 text-reset"><i class="fab fa-twitter"></i></a>
                    <a href="" class="me-4 text-reset"><i class="fab fa-google"></i></a>
                    <a href="" class="me-4 text-reset"><i class="fab fa-instagram"></i></a>
                    <a href="" class="me-4 text-reset"><i class="fab fa-linkedin"></i></a>
                    <a href="" class="me-4 text-reset"><i class="fab fa-github"></i></a>
                </div>
            </section>
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">

                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        
                
                        <h6 class="text-uppercase fw-bold mb-4">Alamat</h6>
                        <?php foreach ($alamats as $alamat):?>
                        <p class="fas fa-home me-3">
                            
                        <?php echo htmlspecialchars($alamat['isi'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <?php endforeach; ?>

                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        
                
                        <h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                        <?php foreach ($kontaks as $kontak):?>
                        <p class="fas fa-home me-3" >
                            <center>
                        <a href=" <?php echo htmlspecialchars($kontak['isi'], ENT_QUOTES, 'UTF-8'); ?>" class="text-reset">
                        <?php echo htmlspecialchars($kontak['info'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                        </center>

                        </p>
                        <?php endforeach; ?>

                    </div>
   

                    </div>
                </div>
            </section>
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Copyright:
                <a  >Sumber Aneka Botol</a>
            </div>
        </footer>
    </div>
    <a href="https://wa.me/6281802134040" class="wa-button">
            <img src="assets/gambar/WhatsApp_icon.png" alt="WhatsApp Logo">
        </a>
       
</body>
</html>