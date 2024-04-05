<?php 
include_once 'database.php'; 
// Initialize the session
session_start();

if (!isset($_SESSION["loggedin"])) {
  header("location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    .row.equal {
        display: flex;
        flex-wrap: wrap;
    }   
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Book Ordering : Search</title>
<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

    <?php include_once 'nav_bar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="page-header">
                    <h1><strong>Search Form</strong></h1>
                    <h3>You can search the product by Name, Type or Author</h3>
                </div>
                <form action="search.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input name="keyword" type="text" class="form-control" id="filter" placeholder="Search" required>
                        </div>
                        <button class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname" , $username, $password);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e -> getMessage();
        }

        if(isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $mkeyword = explode(" ", $keyword);
            $pattern_name = "/[a-zA-Z ]*/i";
            $pattern_number = "/[0-9.]*/";
            $pattern_author = "/[a-zA-Z]*/i";

            preg_match($pattern_name, $keyword, $matches_name, PREG_OFFSET_CAPTURE);
            if (count($matches_name) > 0) {
                $keyword = substr($keyword, $matches_name[0][1] + strlen($matches_name[0][0]));
            }
            preg_match($pattern_number, $keyword, $matches_type, PREG_OFFSET_CAPTURE);
            if (count($matches_type) > 0) {
                $keyword = substr($keyword, $matches_type[0][1] + strlen($matches_type[0][0]));
            }
            preg_match($pattern_name, trim($keyword), $matches_brand, PREG_OFFSET_CAPTURE);

            $_name = $matches_name[0][0];
            $_type = $matches_type[0][0];
            $_author = $matches_brand[0][0];

            $conditions = "";

            if ($_name != "") {
                $conditions .= "fld_product_name LIKE '%$_name%' OR fld_product_type LIKE '%$_name%' OR fld_product_author LIKE '%$_name%' AND ";
            }

            if ($_type != "") {
                $conditions .= "fld_product_name LIKE '%$_type%' OR fld_product_type LIKE '%$_type%' OR fld_product_author LIKE '%$_type%' AND ";
            }

            if ($_author != "") {
                $conditions .= "fld_product_name LIKE '%$_author%' OR fld_product_type LIKE '%$_author%' OR fld_product_author LIKE '%$_author%' AND ";
            }

            $conditions = substr($conditions, 0, -4);

            $stmt = $conn -> prepare("SELECT * FROM tbl_products_a184539_pt2 WHERE $conditions");
            $stmt -> execute();
            $result = $stmt -> fetchAll();            
            if ($stmt->rowCount()>0) {?>
                <div class="row equal">
                    <?php foreach($result as $readrow) { ?>
                        <div class="col-sm-3 col-lg-3 col-md-3">
                            <div class="thumbnail" height="80px">
                                <?php if ($readrow['fld_product_num'] == "" || $readrow['fld_product_num'] == null) {
                                    echo "products/none.jpg";
                                }
                                else { ?>
                                    <img src="products/<?php echo $readrow['fld_product_num'] ?>.jpg" class="img-responsive" width="60%" height="60%">
                                <?php } ?>
                                <!-- caption -->
                                <div class="caption pb-4">
                                    <center><h4><?php echo $readrow['fld_product_name']; ?></h4></center>
                                    <p style="height: 70px; font-size:110%;">
                                        <strong>Product Name:</strong> <?php echo $readrow['fld_product_name']; ?><br>
                                        <strong>type:    </strong><?php echo $readrow['fld_product_type'] ?><br>
                                        <strong>Author :      </strong> <?php echo $readrow['fld_product_author']; ?><br>
                                    </p>
                                </div>
                                <!-- product details -->
                                <a id="detail" data-href="search_detail.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-primary btn-block" role="button"><h4>View Product</h4></a>
                            </div>
                        </div>
                    <?php } }
                    else { ?>
                        <div class="row">
                            <div class="col">
                                <h2 style="color: red;"><center>Record Not Found!</center></h2>
                            </div>
                        </div> 
                    <?php }
                }?>
                <div class="modal" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Product Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" />
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('[id*="detail"]').on('click',function(){
                        var dataURL = $(this).attr('data-href');
                        $('.modal-body').load(dataURL,function(){
                            $('#myModal').modal({show:true});
                        });
                    }); 
                });
            </script>
        </body>
        </html>