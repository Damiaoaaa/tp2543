<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a184539_pt2(fld_product_num,
        fld_product_name, fld_product_type,fld_product_published,fld_product_language,fld_product_author,fld_product_price) VALUES(:pid, :name, :type,:published,:language,:author,:price)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_INT);
      $stmt->bindParam(':published', $published, PDO::PARAM_STR);
      $stmt->bindParam(':language', $language, PDO::PARAM_STR);
      $stmt->bindParam(':author', $author, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $published =  $_POST['published'];
    $language = $_POST['language'];
    $author = $_POST['author'];
    $price = $_POST['price'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
 
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a184539_pt2 SET fld_product_num = :pid,
        fld_product_name = :name,fld_product_type = :type,fld_product_published = :published,fld_product_language = :language,fld_product_author = :author, fld_product_price = :price
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_INT);
      $stmt->bindParam(':published', $published, PDO::PARAM_STR);
      $stmt->bindParam(':language', $language, PDO::PARAM_STR);
      $stmt->bindParam(':author', $author, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $published =  $_POST['published'];
    $language = $_POST['language'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a184539_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a184539_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>