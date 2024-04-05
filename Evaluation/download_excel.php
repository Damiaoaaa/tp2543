<?php
include_once 'database.php';
if (isset($_POST['download_excel'])) {
    // Define the CSV file name
    $filename = 'products.csv';

    // Fetch data from your database and populate the CSV file
    // Replace this with your database query
    $result = array(); // Fetch your data here

    // Create a file handle
    $file = fopen($filename, 'w');

    try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
    // Add headers to the CSV file
    fputcsv($file, ['Product ID', 'Name', 'Type', 'Published', 'Language', 'Author', 'Price']);

    foreach ($result as $readrow) {
        // Add each row of data to the CSV file
        fputcsv($file, [
            $readrow['fld_product_num'],
            $readrow['fld_product_name'],
            $readrow['fld_product_type'],
            $readrow['fld_product_published'],
            $readrow['fld_product_language'],
            $readrow['fld_product_author'],
            $readrow['fld_product_price'],
        ]);
    }

    // Close the file handle
    fclose($file);

    // Set headers for the CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Output the CSV file contents
    readfile($filename);

    // Remove the CSV file after download
    unlink($filename);

    exit;
}
?>
