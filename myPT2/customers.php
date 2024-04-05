<?php
  include_once 'customers_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>My Book Ordering System : Customers</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="customers.php" method="post">
      Customer ID
      <input name="cid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['ID']; ?>"> <br>
      Name
      <input name="Name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['Name']; ?>"> <br>
      Gender
      <input name="Gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['Gender']=="Male") echo "checked"; ?>> Male
      <input name="Gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['Gender']=="Female") echo "checked"; ?>> Female <br>
      It is member or not?
      <input name="Member" type="radio" value="yes" <?php if(isset($_GET['edit'])) if($editrow['Member']=="yes") echo "checked"; ?>> Yes
      <input name="Member" type="radio" value="no" <?php if(isset($_GET['edit'])) if($editrow['Member']=="no") echo "checked"; ?>> No <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Customer ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Gender</td>
        <td>Phone Number</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a184539_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['ID']; ?></td>
        <td><?php echo $readrow['Name']; ?></td>
        <td><?php echo $readrow['Gender']; ?></td>
        <td><?php echo $readrow['Member']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['ID']; ?>">Edit</a>
          <a href="customers.php?delete=<?php echo $readrow['ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
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