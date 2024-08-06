<?php
session_start();

include 'config.php';

// Initialize the cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
}

// Handle removing items from the cart
if (isset($_POST['remove_from_cart'])) {
    $product_id = intval($_POST['product_id']);
    unset($_SESSION['cart'][$product_id]);
}

// Fetch cart details
$cart_items = $_SESSION['cart'];

// Generate WhatsApp message
$wa_message = "Halo, saya tertarik untuk membeli produk berikut:\n\n";
foreach ($cart_items as $product_id => $quantity) {
    // Fetch product details
    $query = $config->prepare("SELECT nama_barang, merk, harga_jual, satuan_barang FROM barang WHERE id = ?");
    $query->execute([$product_id]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $wa_message .= "Nama Barang: " . htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8') . "\n";
        $wa_message .= "Merk: " . htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8') . "\n";
        $wa_message .= "Harga: Rp " . number_format($product['harga_jual'], 2, ',', '.') . "\n";
        $wa_message .= "Satuan: " . htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8') . "\n";
        $wa_message .= "Jumlah: " . htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8') . "\n\n";
    }
}

$wa_message = urlencode($wa_message);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sumberAnekaBotol.css">
    <style>
        .btn-chat {
            background-color: #25D366;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .btn-chat:hover {
            background-color: #1DA851;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Shopping Cart</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                $item_number = 1;

                foreach ($cart_items as $product_id => $quantity) {
                    // Fetch product details
                    $query = $config->prepare("SELECT nama_barang, harga_jual FROM barang WHERE id = ?");
                    $query->execute([$product_id]);
                    $product = $query->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $price = $product['harga_jual'];
                        $total = $price * $quantity;
                        $total_price += $total;
                ?>
                <tr>
                    <td><?php echo $item_number++; ?></td>
                    <td><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($price, 2, ',', '.'); ?></td>
                    <td><?php echo number_format($total, 2, ',', '.'); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" name="remove_from_cart" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Price</strong></td>
                    <td colspan="2"><strong><?php echo number_format($total_price, 2, ',', '.'); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <a href="https://wa.me/6285158242422?text=<?php echo $wa_message; ?>" class="btn-chat" target="_blank">Chat with us on WhatsApp</a>
    </div>
</body>
</html>
