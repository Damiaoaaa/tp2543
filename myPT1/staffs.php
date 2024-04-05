<!DOCTYPE html>
<html>
<head>
  <title>My Booking Ordering System : Staffs</title>
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
      Staff ID
      <input name="sid" type="text"> <br>
      First Name
      <input name="fname" type="text"> <br>
      Last Name
      <input name="lname" type="text"> <br>
      Gender
      <input name="gender" type="radio" value="Male"> Male
      <input name="gender" type="radio" value="Female"> Female <br>
      Phone Number
      <input name="phone" type="text"> <br>
      Email Address
      <input name="email" type="text"> <br>
      <button type="submit" name="create">Create</button>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Gender</td>
        <td>Phone Number</td>
        <td>Email</td>
      </tr>
      <tr>
        <td>A10000</td>
        <td>Wanda</td>
        <td>Maximoff</td>
        <td>Female</td>
        <td>+6018-3658914</td>
        <td>a184539@siswa.ukm.edu.my</td>
        <td>
          <a href="staffs.php">Edit</a>
          <a href="staffs.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>A10001</td>
        <td>Davin</td>
        <td>Ransom</td>
        <td>Male</td>
        <td>+86 152-7099-9050</td>
        <td>flin35024@gmail.com</td>
        <td>
          <a href="staffs.php">Edit</a>
          <a href="staffs.php">Delete</a>
        </td>
      </tr>
      <tr>
        <td>A10002</td>
        <td>Peter</td>
        <td>Park</td>
        <td>Male</td>
        <td>+86 138-0708-5949</td>
        <td>905872094@qq.com</td>
        <td>
          <a href="staffs.php">Edit</a>
          <a href="staffs.php">Delete</a>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>