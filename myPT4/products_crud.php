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
    // $target_dir = "products/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    $stmt = $conn->prepare("INSERT INTO tbl_products_a178816_fpt(fld_product_id, fld_product_name, fld_product_price, fld_product_gender, fld_product_age,fld_product_image) VALUES(:pid, :name, :price, :gender, :age, :image)");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
      $stmt->bindParam(':age', $age, PDO::PARAM_STR);
    $stmt->bindParam(':image', $target_file2, PDO::PARAM_STR);

   $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $gender =  $_POST['gender'];
    $age = $_POST['age'];
    $target_file2 = sprintf("%s".'.jpg', $_POST['pid']);

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
    $stmt = $conn->prepare("UPDATE tbl_products_a178816_fpt SET fld_product_id = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_gender = :gender,
        fld_product_age = :age, fld_product_image = :image
      WHERE fld_product_id = :oldpid");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
      $stmt->bindParam(':age', $age, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
    $stmt->bindParam(':image', $target_file2, PDO::PARAM_STR);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $gender =  $_POST['gender'];
    $age = $_POST['age'];
    $oldpid = $_POST['oldpid'];
    $target_file2 = sprintf("%s".'.jpg', $_POST['oldpid']);

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
    $stmt = $conn->prepare("DELETE FROM tbl_products_a178816_fpt WHERE fld_product_id = :pid");

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

    $stmt = $conn->prepare("SELECT * FROM tbl_products_a178816_fpt WHERE fld_product_id = :pid");

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