<?php
include_once 'database.php';
session_start();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Create
if (isset($_POST['create'])) {
if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
  try {

    $stmt = $conn->prepare("INSERT INTO tbl_customers_a178816_fpt(fld_customer_id, fld_customer_name,
      fld_customer_phone, fld_customer_gender) VALUES(:cid, :name, :phone, :gender)");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $stmt->execute();
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['create']);
}
}

//Update
if (isset($_POST['update'])) {
if ($_SESSION['userposition'] == 'Admin' || $_SESSION['userposition'] == "Supervisor") {
  try {

    $stmt = $conn->prepare("UPDATE tbl_customers_a178816_fpt SET fld_customer_id = :cid,
      fld_customer_name = :name,  fld_customer_phone = :phone, fld_customer_gender = :gender
      WHERE fld_customer_id = :oldcid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $oldcid = $_POST['oldcid'];

    $stmt->execute();

    header("Location: customers.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}
else{
     echo "<script>alert('You are not allowed!')</script>";
   unset($_GET['delete']);
}
}

//Delete
if (isset($_GET['delete'])) {
if ($_SESSION['userposition'] == 'Admin' || $_SESSION['userposition'] == "Supervisor") {
  try {

    $stmt = $conn->prepare("DELETE FROM tbl_customers_a178816_fpt WHERE fld_customer_id = :cid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $cid = $_GET['delete'];

    $stmt->execute();

    header("Location: customers.php");
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
if ($_SESSION['userposition'] == 'Admin' || $_SESSION['userposition'] == "Supervisor")  {
  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a178816_fpt WHERE fld_customer_id = :cid");

    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

    $cid = $_GET['edit'];

    $stmt->execute();

    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
    }
  else{
     echo "<script>alert('You are not allowed!')</script>";
     //echo $_SESSION['userposition'];
     unset($_GET['edit']);
  }
}


$conn = null;

?>