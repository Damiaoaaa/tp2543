<?php
  include_once 'staffs_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>My Book Ordering System : Staffs</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="staffs.php" method="post">
      Customer ID
      <input name="sid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['ID']; ?>"> <br>
      First Name
      <input name="fname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['First_Name']; ?>"> <br>
      Name
      <input name="lname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['Name']; ?>"> <br>
      
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>First Name</td>
        <td>Name</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a184539_pt2");
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
        <td><?php echo $readrow['First_Name']; ?></td>
        <td><?php echo $readrow['Name']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['ID']; ?>">Edit</a>
          <a href="staffs.php?delete=<?php echo $readrow['ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
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