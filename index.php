<?php
include 'config.php';

// Fetch products
$query = $config->query("SELECT id,  satuan_barang, stok, nama_barang FROM barang");
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Fetch alamat details

$query_alamat = $config->query("SELECT id, isi FROM alamat");
$alamats = $query_alamat->fetchAll(PDO::FETCH_ASSOC);

// Fetch kontak details

$query_kontak = $config->query("SELECT id, isi,info FROM kontak");
$kontaks = $query_kontak->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($queryToko['nama_toko'], ENT_QUOTES, 'UTF-8'); ?></title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section row align-items-center justify-content-between">
            <div class="col-8 col-md-4 d-flex align-items-center">
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











        <!-- Carousel -->
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/gambar/images.png" alt="Los Angeles" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="chicago.jpg" alt="Chicago" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="ny.jpg" alt="New York" class="d-block w-100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="container-fluid mt-3">
        <div class="product-grid row">
    <?php foreach ($products as $product): ?>
        <div class="product-card col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <center>
            <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" >
    </center>

            <div class="product-info">
                <h3><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <!-- <p class="merk"> -->
                    <?php 
                    // echo htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8'); 
                    ?>
                    <!-- </p> -->
                <!-- <p class="price">Rp  -->
                    <?php 
                    // echo htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8'); 
                    ?>
                <!-- </p> -->
                <!-- <p class="satuan"> -->
                    <?php 
                    // echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); 
                    ?>
                <!-- </p> -->
                 <br>
                <a href="product_detail.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline-secondary">Selengkapnya</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
        </div>
        <a href="https://wa.me/6281802134040" class="wa-button">
            <img src="assets/gambar/WhatsApp_icon.png" alt="WhatsApp Logo">
        </a>
        <!-- Footer -->
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
                        <a href=" <?php echo htmlspecialchars($kontak['isi'], ENT_QUOTES, 'UTF-8'); ?>" class="text-reset">
                        <?php echo htmlspecialchars($kontak['info'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>

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
</body>
</html>
