<?php


include 'config.php';

// Fetch product details
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = $config->prepare("SELECT id, merk, harga_jual, satuan_barang, stok, nama_barang, deskripsi FROM barang WHERE id = ?");
    $query->execute([$product_id]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Invalid product ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/sumberAnekaBotol.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid">
        <p><strong>Merk:</strong> <?php echo htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Harga:</strong> Rp <?php echo htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Satuan:</strong> <?php echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Stok:</strong> <?php echo htmlspecialchars($product['stok'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($product['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="index.php" class="btn btn-secondary">Back to Products</a>
    </div>
</body>
</html>
