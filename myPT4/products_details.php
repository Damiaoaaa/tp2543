  <?php include_once "database.php"; ?>

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>My Tea Ordering System: Products Details</title>
      <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>



      <?php
      try {
          $conn = new PDO(
              "mysql:host=$servername;dbname=$dbname",
              $username,
              $password
          );
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare(
              "SELECT * FROM tbl_products_a178816_fpt WHERE fld_product_id = :pid"
          );
          $stmt->bindParam(":pid", $pid, PDO::PARAM_STR);
          $pid = $_GET["pid"];
          $stmt->execute();
          $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>

      <table border="0">

        <tr>
          <td>

            <div class="panel panel-default">
              <?php if ($readrow["fld_product_image"] == "") {
                  echo "No image";
              } else {
                   ?>
              <img src="products/<?php echo $readrow["fld_product_image"]; ?>" class="img-responsive"/>
              <?php
              } ?>
            </div>

          </td>
        </tr>

        <tr>
          <td>

              <div class="panel panel-default">
                <div class="panel-heading"><strong>Product Details</strong></div>
                <div class="panel-body">
                  Below are specifications of the product.
                </div>

                <table class="table">

                  <tr>
                    <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
                    <td>
                      <?php echo $readrow["fld_product_id"]; ?>
                    </td>
                  </tr>

                  <tr>
                    <td><strong>Name</strong></td>
                    <td>
                      <?php echo $readrow["fld_product_name"]; ?>
                    </td>
                  </tr>

                  <tr>
                    <td><strong>Price</strong></td>
                    <td>
                      $<?php echo $readrow["fld_product_price"]; ?>.00
                    </td>
                  </tr>

                  <tr>
                    <td><strong>Gender</strong></td>
                    <td>
                      <?php echo $readrow["fld_product_gender"]; ?>
                    </td>
                  </tr>

                  <tr>
                    <td><strong>Age</strong></td>
                    <td>
                      <?php echo $readrow["fld_product_age"]; ?>
                    </td>
                  </tr>

                  

                </table>

              </div>

          </td>
        </tr>

      </table>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>

    </body>
  </html>