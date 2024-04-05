<?php
include_once 'database.php';

  // Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"])) {
  header("location: index.php");
  exit;
}
?>

<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_products_a178816_fpt WHERE fld_product_id = :pid");
  $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
  $pid = $_GET['pid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
      <?php if ($readrow['fld_product_image'] == "" ) {
        echo "No image";
      }
      else { ?>
        <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-6">
      <div class="card">
        
        <div class="card-body">
          <div class="card-title"><strong>Product Details</strong></div>
          Below are specifications of the product.
        </div>
        <table class="table">
          <tr>
            <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
            <td><?php echo $readrow['fld_product_id'] ?></td>
          </tr>
          <tr>
            <td><strong>Name</strong></td>
            <td><?php echo $readrow['fld_product_name'] ?></td>
          </tr>
          <tr>
            <td><strong>Price</strong></td>
            <td>$<?php echo $readrow['fld_product_price'] ?></td>
          </tr>
          <tr>
            <td><strong>Brand</strong></td>
            <td><?php echo $readrow['fld_product_brand'] ?></td>
          </tr>
          <tr>
            <td><strong>Category</strong></td>
            <td><?php echo $readrow['fld_product_category'] ?></td>
          </tr>
          <tr>
            <td><strong>Quantity</strong></td>
            <td><?php echo $readrow['fld_product_quantity'] ?></td>
          </tr>
          <tr>
            <td><strong>WarrantyLength</strong></td>
            <td><?php echo $readrow['fld_product_warranty'] ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>