<?php
  include_once 'products_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>My Book Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
      Product ID
      <input name="pid" type="text" placeholder="Insert ID"  value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required> <br>
      Name
      <input name="name" type="text" placeholder="Insert book's name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required> <br>
      Type
      <input name="type" type="text" placeholder="Insert book's type" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_type']; ?>" required> <br>
      Published
      <input name="published" type="text" placeholder="Insert book's published" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_published']; ?>" required> <br>
      Language
      <select name="language">
        <option value="English" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="English") echo "selected"; ?> selected>English</option>
        <option value="French" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="French") echo "selected"; ?>>French</option>
        <option value="Russian" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Russian") echo "selected"; ?>>Russian</option>
        <option value="Malayisa" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Malayisa") echo "selected"; ?>>Malayisa</option>
        <option value="Chinese" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Chinese") echo "selected"; ?>>Chinese</option>
      </select> <br>
      Author
      <input name="author" type="text" placeholder="Insert book's author" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_author']; ?>" required> <br>

      Price
      <input name="price" type="text" placeholder="Insert book's price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> <br>
      
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Type</td>
        <td>Published</td>
        <td>Language</td>
        <td>Author</td>
        <td>Price</td>
        <td></td>
      </tr>
      <?php
      // Read
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
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_type']; ?></td>
        <td><?php echo $readrow['fld_product_published']; ?></td>
        <td><?php echo $readrow['fld_product_language']; ?></td>
        <td><?php echo $readrow['fld_product_author']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>">Details</a>
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>">Edit</a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
 
    </table>
  </center>
</body>
</html>