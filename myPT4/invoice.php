<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION["loggedin"])) {
  header("location: login.php");
  exit;
}
?>
<?php
try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a178816_fpt, tbl_staffs_a178816_fpt,
      tbl_customers_a178816_fpt, tbl_orders_details_a178816_fpt WHERE
      tbl_orders_a178816_fpt.fld_staff_id = tbl_staffs_a178816_fpt.fld_staff_id AND
      tbl_orders_a178816_fpt.fld_customer_id = tbl_customers_a178816_fpt.fld_customer_id AND
      tbl_orders_a178816_fpt.fld_order_id = tbl_orders_details_a178816_fpt.fld_order_id AND
      tbl_orders_a178816_fpt.fld_order_id = :oid");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
    $oid = $_GET['oid'];
    $stmt->execute();
    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
<div class="col-xs-6 text-center">
  <br>
    <img src="logo.png" width="60%" height="60%">
</div>
<div class="col-xs-6 text-right">
  <h1>INVOICE</h1>
  <h5>Order: <?php echo $readrow['fld_order_id'] ?></h5> 
  <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>From: My Car Part Store</h4>
      </div>
      <div class="panel-body">
        <p>
        Malaysia<br>
        Selangor <br>
        43600 Bangi <br>
        UKM car part store<br>
        </p>
      </div>
    </div>
  </div>
    <div class="col-xs-6 text-right">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4>To : <?php echo $readrow['fld_customer_name']; ?></h4>
            </div>
            <div class="panel-body">
        <p>
        <?php echo $readrow['fld_customer_address']; ?>
        <br>
        <br>
        <br>
        <br>
        </p>
            </div>
        </div>
    </div>
</div>


<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Product</th>
    <th class="text-right">Quantity</th>
    <th class="text-right">Price/Unit</th>
    <th class="text-right">Total</th>
  </tr>
  <?php
  $grandtotal = 0;
  $counter = 1;
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a178816_fpt,
        tbl_products_a178816_fpt where 
        tbl_orders_details_a178816_fpt.fld_product_id = tbl_products_a178816_fpt.fld_product_id AND
        fld_order_id = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
      echo "Error: " . $e->getMessage();
    }
  foreach($result as $detailrow) {
  ?>
  <tr>
    <td><?php echo $counter; ?></td>
    <td><?php echo $detailrow['fld_product_name']; ?></td>
    <td class="text-right"><?php echo $detailrow['fld_quantity']; ?></td>
    <td class="text-right"><?php echo $detailrow['fld_product_price']; ?>$</td>
    <td class="text-right"><?php echo $detailrow['fld_product_price']*$detailrow['fld_quantity']; ?>$</td>
  </tr>
  <?php
    $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_quantity'];
    $counter++;
  } // while
  ?>
  <tr>
    <td colspan="4" class="text-right">Grand Total</td>
    <td class="text-right"><?php echo $grandtotal ?>$</td>
  </tr>
</table>
 
<div class="row">
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>Your Name: Chen YuHao</p>
        <p>Bank Name: CIMB</p>
        <p>SWIFT : AAAABBCCDDD</p>
        <p>Account Number : 0123456789</p>
        <p>IBAN : C123456789</p>
      </div>
    </div>
    </div>
  <div class="col-xs-6">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['fld_staff_name']; ?> </p>
          <p> Staff Email：<?php echo $readrow['fld_staff_email']; ?></p>
          <p><br></p>
          <p> Our Telephone Number : +60 123456789
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>