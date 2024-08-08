<?php
require('fpdf/fpdf.php'); // Adjust the path as necessary

// Include database configuration
include('config.php');

// Establish database connection
$mysqli = new mysqli("localhost", "root", "", "sumberAnekaBotol"); // Adjust constants as needed

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Define product ID (example value, replace with actual ID)
// Ensure this value is valid and set before using it
$productId = 1; // Change this to the actual product ID

// Query to fetch the image BLOB data
$query = "SELECT gambar FROM barang WHERE id = 7"; // Ensure the query matches your database schema

// Prepare the statement
$stmt = $mysqli->prepare($query);

if ($stmt === false) {
    die("Failed to prepare the statement: " . $mysqli->error);
}

// Bind parameters
$stmt->bind_param("i", $productId);

// Execute the statement
$stmt->execute();

// Bind result variable
$stmt->bind_result($imageData);

// Fetch the result
$stmt->fetch();

// Check if image data is fetched
if ($imageData === null) {
    die("Image data not found for product ID " . $productId);
}

// Close the statement and connection
$stmt->close();
$mysqli->close();

// Create a temporary file and write image data to it
$tempFile = tempnam(sys_get_temp_dir(), 'img');
file_put_contents($tempFile, $imageData);

// Create PDF and add image
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image($tempFile, 10, 10, 100); // Adjust as needed

// Output the PDF
$pdf->Output();

// Clean up
?>
