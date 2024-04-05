<?php
  include_once 'products_crud.php';
  if (!isset($_SESSION["loggedin"])) {
  header("location: login.php");
  exit;
}
$per_page = 5;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $per_page = isset($_POST['rowsPerPage']) ? $_POST['rowsPerPage'] : '5';
    if ($per_page == '-1') {
        // Handle the 'All' case, perhaps by setting a very high limit
        $per_page = PHP_INT_MAX;
    }
  }
?>
 
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>My Book Ordering System : Products</title>
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

   <?php include_once 'nav_bar.php'; ?>

   <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>
    <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">

      <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">Product ID</label>
          <div class="col-sm-9">
      <input name="pid" type="text" class="form-control" id="productid" placeholder="Insert ID"  value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required> <br>

    </div>
        </div>
      <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
      <input name="name" type="text" class="form-control" id="productname" placeholder="Insert book's name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required> <br>

      </div>
        </div>
      <div class="form-group">
          <label for="producttype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
      <input name="type" type="text" class="form-control" id="producttype" placeholder="Insert book's type" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_type']; ?>" required> <br>

      </div>
        </div>
      <div class="form-group">
          <label for="productpublished" class="col-sm-3 control-label">Published</label>
          <div class="col-sm-9">
      <input name="published" type="text" class="form-control" id="productprice" placeholder="Insert book's published" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_published']; ?>" required> <br>

      </div>
        </div>
      <div class="form-group">
          <label for="productlanguage" class="col-sm-3 control-label">Language</label>
          <div class="col-sm-9">
      <select name="language" class="form-control" id="productlanguage" required>
        <option value="English" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="English") echo "selected"; ?> selected>English</option>
        <option value="French" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="French") echo "selected"; ?>>French</option>
        <option value="Russian" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Russian") echo "selected"; ?>>Russian</option>
        <option value="Malayisa" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Malayisa") echo "selected"; ?>>Malayisa</option>
        <option value="Chinese" <?php if(isset($_GET['edit'])) if($editrow['fld_product_language']=="Chinese") echo "selected"; ?>>Chinese</option>
      </select> <br>
      </div>
        </div>
      <div class="form-group">
          <label for="productauthor" class="col-sm-3 control-label">Author</label>
          <div class="col-sm-9">
      <input name="author" type="text" class="form-control" id="productauthor" placeholder="Insert book's author" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_author']; ?>" required> <br>

      </div>
        </div>
      <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
      <input name="price" type="text" class="form-control" id="productprice" placeholder="Insert book's price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> <br>
      </div>
        </div>
        <div class="form-group">
          <label for="productfile" class="col-sm-3 control-label">File</label>
          <div class="col-sm-9">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
              <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
            <?php } else { ?>
              <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
            <?php } ?>
            <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">

<div class="page-header">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                Please select the rows:
                <form action="" method="post">
                    <select id="rowsPerPage" name="rowsPerPage" class="form-control">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="-1">All</option>
                    </select>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>


        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Published</th>
          <th>Language</th>
          <th>Author</th>
          <th>Price</th>
          <th></th>
        </tr>
        <?php
        // Read
        $result = array();
        if (isset($_GET["page"]))
          $page = $_GET["page"];
        else
          $page = 1;
        $start_from = ($page-1) * $per_page;
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2 ORDER BY fld_product_name ASC LIMIT $start_from, $per_page");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
if(is_array($result)) {
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
         <button type="button" role="button" class="btn btn-warning btn-xs modalbtn" data-toggle="modal" data-target="#myModal" data-href="products_details.php?pid=<?php echo $readrow['fld_product_num'];?>">Details</button>

            <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>
        <?php
        }
      }
        $conn = null;
        ?>
      </table>
    </div>
  </div>

<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <form action="download_excel.php" method="post">
            <input type="submit" class="btn btn-primary" name="download_excel" value="Download as Excel">
        </form>
    </div>
</div>
  
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
        <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Product Details</h4>
      </div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>


<script> 
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

$(document).ready(function () {
    $('#example').DataTable({
        lengthMenu: [
            [-1,10, 20, 30],
            ['All',10, 20, 30],
        ],
    });
});
</script>

<script>  
     $(document).ready(function(){
    $(".modalbtn").click(function(){
     var dataURL = $(this).attr( "data-href" )
     $('.modal-body').load(dataURL,function(){
      $('#myModal').modal({show:true});
      $('#myModal').on('hidden.bs.modal', function () {
        location.reload(); // location.reload();
      })
    });
   });
  });

    </script>
</body>
</html>
