<?php
include_once 'staffs_crud.php';
if (!isset($_SESSION["loggedin"])) {
  header("location: login.php");
  exit;
}
if ($_SESSION['userposition'] == 'Normal Staff') {
  echo "<script>alert('You are not allowed!')</script>";
  header("location: index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>My Pet Bird store : Staffs</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      td{
        vertical-align: middle;
        text-align: center;  
      }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
   <?php include_once 'nav_bar.php'; ?>
   <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header">
             <center><h2>Create New Staff</h2></center>
          </div>
    <form action="staffs.php" method="post">
      <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
          <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="staffname" class="col-sm-3 control-label">Staff Name</label>
          <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="staffname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff Position</label>
          <div class="col-sm-9">
          <input name="position" type="text" class="form-control" id="staffposition" placeholder="Staff Position" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_position']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="staffgender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
            <select name="gender" class="form-control" id="staffgender" required>
              <option value="male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="male") echo "selected"; ?>>male</option>
              <option value="female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="female") echo "selected"; ?>>female</option>
            </select>
             </div>
        </div>
        <div class="form-group">
          <label for="staffpassword" class="col-sm-3 control-label">Staff Password</label>
          <div class="col-sm-9">
          <input name="staffpassword" type="text" class="form-control" id="staffpassword" placeholder="Staff Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Staff Email</label>
          <div class="col-sm-9">
          <input name="email" type="text" class="form-control" id="staffemail" placeholder="Staff Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required>
        

      <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
        <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
        <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
    </form> <br>
  </div>
</div>
    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
       <center> <h2>Staffs List</h2></center>
      </div>
      <table class="table table-striped table-bordered">
      <tr>
        <th>Staff ID</th>
        <th>Staff Name</th>
        <th>Staff Position</th>
        <th>Staff Gender</th>
        <th>Staff Password</th>
        <th>Staff Email</th>
        <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_staffs_a178816_fpt LIMIT $start_from, $per_page");
        // $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a178816_fpt");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>
        <tr>
          <td><?php echo $readrow['fld_staff_id']; ?></td>
          <td><?php echo $readrow['fld_staff_name']; ?></td>
          <td><?php echo $readrow['fld_staff_position']; ?></td>
          <td><?php echo $readrow['fld_staff_gender']; ?></td>
          <td><?php echo $readrow['fld_staff_password']; ?></td>
          <td><?php echo $readrow['fld_staff_email']; ?></td>

          <td>
            <a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>
        <?php
      }
      $conn = null;
      ?>
    </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a178816_fpt");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>