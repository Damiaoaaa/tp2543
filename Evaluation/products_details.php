<?php include_once 'database.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Book Ordering System: Products Details</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
  /* Existing styles */
  .center-content {
    text-align: center;
    margin: 0 auto;
  } 

  /* New styles for image and table centering */
  .panel img {
    display: block;
    margin: 0 auto; /* This centers the image */
  }

  .table {
    margin: 0 auto; /* This centers the table */
  }
</style>

</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-xs-10 col-sm-6">
      <h2>Product Details</h2>

      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2 WHERE fld_product_num = :pid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $pid = $_GET['pid'];
        $stmt->execute();
        $readrow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$readrow) {
          echo "No product found with the provided ID.";
          // You might want to add further handling if the product doesn't exist.
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>

      <div class="panel panel-default">
        <?php if (isset($readrow) && $readrow["fld_product_num"] != "") { ?>
          <img src="products/<?php echo $readrow["fld_product_num"]; ?>.jpg" class="img-responsive"/>
        <?php } else { ?>
          <p>No image</p>
        <?php } ?>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading"><strong>Product Details</strong></div>
        <div class="panel-body">
          Below are specifications of the product.
        </div>
        <table class="table">
          <tr>
            <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_num'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Name</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_name'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Type</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_type'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Published</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_published'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Language</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_language'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Author</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_author'] : ""; ?></td>
          </tr>
          <tr>
            <td><strong>Price: RM</strong></td>
            <td><?php echo isset($readrow) ? $readrow['fld_product_price'] : ""; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
