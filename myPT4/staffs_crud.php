<?php

include_once 'database.php';
session_start();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {
if ($_SESSION['userposition'] == "Admin") {
  try {

    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a178816_fpt(fld_staff_id, fld_staff_name, fld_staff_position, fld_staff_gender, fld_staff_password,fld_staff_email) VALUES(:sid, :name, :position, :gender, :staffpassword, :email)");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':staffpassword', $staffpassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $gender = $_POST['gender'];
    $staffpassword = $_POST['staffpassword'];
    $email = $_POST['email'];

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
if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
  try {

    $stmt = $conn->prepare("UPDATE tbl_staffs_a178816_fpt SET
      fld_staff_id = :sid, 
      fld_staff_name = :name,
      fld_staff_position = :position,
      fld_staff_gender = :gender,
      fld_staff_password = :staffpassword,
      fld_staff_email = :email
      
      WHERE fld_staff_id = :oldsid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':position', $position, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':staffpassword', $staffpassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $gender = $_POST['gender'];
    $staffpassword = $_POST['staffpassword'];
    $email = $_POST['email'];
    $oldsid = $_POST['oldsid'];

    $stmt->execute();

    header("Location: staffs.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
  }else{
 echo "<script>alert('You are not allowed!')</script>";
 unset($_GET['update']);
}
}

//Delete
if (isset($_GET['delete'])) {
if ($_SESSION['userposition'] == "Admin") {
  try {

    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a178816_fpt where fld_staff_id = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['delete'];

    $stmt->execute();

    header("Location: staffs.php");
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
if ($_SESSION['userposition'] == "Admin") {
  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a178816_fpt where fld_staff_id = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['edit'];

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