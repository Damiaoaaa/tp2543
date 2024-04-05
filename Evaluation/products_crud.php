<?php
 
include_once 'database.php';
 session_start();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
    $target_dir = "products/";
    $target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "<script>alert('Sorry, file already exists.')</script>";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10485760) {
      echo "<script>alert('Sorry, your file must be less than 10 MB.')</script>";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" ) {
      echo "<script>alert('Sorry, only jpg files are allowed.')</script>";
      $uploadOk = 0;
    }

    $target_file3 = $target_dir . $_POST['pid']. '.jpg';

    if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded.')</script>";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file3)) {
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
}
}
  else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['create']);
}
}
 
//Update
if (isset($_POST['update'])) {
 if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
  $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $uploadOk = 1;
      } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
      }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10485760) {
      echo "<script>alert('Sorry, your file must be less than 10 MB.')</script>";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" ) {
      echo "<script>alert('Sorry, only jpg files are allowed.')</script>";
      $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      unlink($target_file);
    }
    $target_file3 = $target_dir . sprintf("%s", $_POST['oldpid']).'.jpg';
    if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded.')</script>";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file3)) {
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
}
}
      else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['update']);
}
}
 
//Delete
if (isset($_GET['delete'])) {
 if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
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
  }else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['delete']);
}
}
//Edit
if (isset($_GET['edit'])) {
if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
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
  }else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['edit']);
}
}
$conn = null;
?>