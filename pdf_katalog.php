<?php
require('fpdf/fpdf.php'); // Adjust the path as necessary

// Database connection
include 'config.php';

// Create instance of FPDF class
$pdf = new FPDF();
$pdf->AddPage(); // Add a page to the PDF
$pdf->SetFont('Arial', 'B', 16);

// Title
// Image path
$imagePath = 'assets/gambar/title_anekaBotol.jpg';


// Get image dimensions
list($width, $height) = getimagesize($imagePath);

// $pdf->Image($imagePath, 10, 10, 150, 20,);
// $pdf->Ln(100); 

$pdf->Cell(0, 10, 'Product Catalog', 0, 1, 'C');
$pdf->Ln(10); // Line break

// Fetch product details
$query = $config->query("SELECT * FROM barang");
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Set font for the product list
$pdf->SetFont('Arial', '', 12);

foreach ($products as $product) {
    // Product Name

    $pdf->Cell(0, 10, 'Product Name: ' . $product['nama_barang'] . " (".$product['satuan_barang'].")", 0, 1);

    // Description
    $pdf->Cell(0, 10, 'Description: ' );
    $pdf->Ln();

    $pdf->Cell(0, 10,  "\t".$product['deskripsi']);

    $pdf->Ln();

    // Price and Size
    $ukuran_dan_harga = json_decode($product['ukuran_dan_harga'], true);
    $pdf->Cell(0,10,'Size: ');
    $pdf->Ln();
    foreach ($ukuran_dan_harga as $size => $price) {
        $pdf->Cell(0, 10, "* ". $size . ' - Price: ' . number_format($price, 2, ',', '.'), 0, 1);
    }

    $pdf->Ln(10); // Line break
}

// Output the PDF
$pdf->Output();
?>
