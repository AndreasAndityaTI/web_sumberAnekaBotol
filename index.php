<?php
include 'config.php';

// Fetch products
$query = $config->query("SELECT id,  satuan_barang, nama_barang FROM barang");
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


        .cart-icon-red {
    filter: hue-rotate(0deg) saturate(4) brightness(0.7);
    /* Additional properties for better visibility */
    filter: sepia(1) saturate(5) hue-rotate(-50deg);
}
        
.cart-button {
    position: fixed;
    bottom: 20px; /* Adjusted to prevent any overlap with the white line */
    left: 20px;
    max-width: 768px;

    /* z-index: 2147483647; */
    width: 80px; /* Set a specific width for the button */
    height: 80px; /* Set a specific height for the button */
    background-color: white; /* WhatsApp green */
    display: flex;
    align-items: center; /* Center items vertically */
    justify-content: center; /* Center items horizontally */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Optional: add shadow for better visibility */
    text-decoration: none; /* Ensure no underline on the button */
    border-radius: 50%;

}

.cart-button:hover {
    background-color: grey; /* Darker WhatsApp green on hover */
}

.cart-button img {
    width: 70%; /* Make sure the image fits well inside the button */
    height: auto; /* Maintain aspect ratio */

    
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
                <li><a class="dropdown-item" href="pdf_katalog.php">PDF Katalog</a></li>
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
                <span class="col-12 col-md-4 text-end">
    <!-- Cart Icon -->
<!-- Cart Icon -->


        </span>
          
                    <button onclick="tampil_isiDropdown()" class="dropbtn" width="30px">
                        <img src="assets/gambar/dropdown.png" alt="dropdown" width="30px">
                        <a>Kategori</a>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                    <a class="dropdown-item" href="pdf_katalog.php"><b>PDF Katalog</b></a>
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
    <form action="search.php" method="GET" class="input-group">
        <input type="search" name="query" class="form-control rounded" placeholder="Cari Produk.." aria-label="Search" aria-describedby="search-addon">
        <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
        </button>
    </form>
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
`            <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" >
`    </center>

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
                <p class="satuan">
                    <?php 
                    echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); 
                    ?>
                </p>
                 <br>
                <a href="product_detail.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline-secondary">Selengkapnya</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
        </div>
        
        <a href="https://wa.me/6281703177070" class="wa-button">
            <img src="assets/gambar/WhatsApp_icon.png" alt="WhatsApp Logo">
        </a>
        <!-- Footer -->
        <footer class="text-center text-lg-start bg-body-tertiary text-muted">
      
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
          
                    <div class="col-md-2 col-lg-4 col-xl-3 mx-auto mb-4">
                        
                        <h6 class="text-uppercase fw-bold mb-4">Lokasi</h6>
    
                  
                        <p>
                        <iframe src="https://www.google.com/maps/d/embed?mid=1TM-8bCNNY5SWUSx9N465px9VZGzWvP8&ehbc=2E312F" width="300" height="250"></iframe>
                            </p>
            
            
                            </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        
                
                        <h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                        <?php foreach ($kontaks as $kontak):?>
                        <p class="fas fa-home me-3" >
                        <a href=" <?php echo htmlspecialchars($kontak['isi'], ENT_QUOTES, 'UTF-8'); ?>" class="text-reset">
                        <?php echo htmlspecialchars($kontak['info'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                        <?php endforeach; ?>

                        </div>

           

          

     
                        <a href="cart.php" class="cart-button">
        <img src="assets/gambar/cart_icon.png" alt="cart icon" >
    </a>
                        </p>

   

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
