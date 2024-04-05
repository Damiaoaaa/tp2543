<?php
include_once 'database.php';

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to the welcome page
if (!isset($_SESSION["loggedin"])) {
  header("location: index.php");
  exit;
}
?>

<?php
$readrow = []; // Initialize $readrow as an empty array

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2 WHERE fld_product_num = :pid");
  $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
  $pid = $_GET['pid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
      <?php if ($readrow && $readrow['fld_product_num'] != "") { ?>
        <img src="products/<?php echo $readrow['fld_product_num'] ?>.jpg" class="img-responsive">
      <?php } else {
        echo "No image";
      } ?>
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
            <td><?php echo $readrow['fld_product_num'] ?></td>
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
            <td><strong>Author</strong></td>
            <td><?php echo $readrow['fld_product_author'] ?></td>
          </tr>
          <tr>
            <td><strong>Language</strong></td>
            <td><?php echo $readrow['fld_product_language'] ?></td>
          </tr>
          <tr>
            <td><strong>Published</strong></td>
            <td><?php echo $readrow['fld_product_published'] ?></td>
          </tr>
          <tr>
            <td><strong>Type</strong></td>
            <td><?php echo $readrow['fld_product_type'] ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
