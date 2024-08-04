<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $config->prepare("SELECT gambar FROM barang WHERE id = ?");
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        header("Content-Type: image/jpeg");
        echo $result['gambar'];
    } else {
        echo 'Gambar tidak ditemukan.';
    }
} else {
    echo 'ID tidak valid.';
}
?>