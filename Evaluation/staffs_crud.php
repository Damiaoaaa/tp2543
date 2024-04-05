<?php

include_once 'database.php';
session_start();
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create
if (isset($_POST['create'])) {
    if ($_SESSION['userposition'] == "Admin") {
        try {

            $stmt = $conn->prepare("INSERT INTO tbl_staffs_a184539_pt2(ID, First_Name, Name, Position,Password,Email) VALUES(:sid, :fname, :lname, :Position,:Password,:Email)");

            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
            $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt->bindParam(':Position', $Position, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $Password, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $Email, PDO::PARAM_STR);

            $sid = $_POST['sid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $Position = $_POST['Position'];
            $Email = $_POST['Email'];
            $plainPassword  = $_POST['Password'];

            $Password=sha1($plainPassword);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('You are not allowed!')</script>";
        unset($_GET['create']);
    }
}

// Update
if (isset($_POST['update'])) {
    if ($_SESSION['userposition'] == "Admin" || $_SESSION['userposition'] == "Supervisor") {
        try {

            $stmt = $conn->prepare("UPDATE tbl_staffs_a184539_pt2 SET ID = :sid, First_Name = :fname, Name = :lname, Position = :Position,Password=:Password,Email=:Email WHERE ID = :oldsid");

            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
            $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
            $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
            $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
            $stmt->bindParam(':Position', $Position, PDO::PARAM_STR);
            $stmt->bindParam(':Password', $Password, PDO::PARAM_STR);
            $stmt->bindParam(':Email', $Email, PDO::PARAM_STR);

            $sid = $_POST['sid'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $oldsid = $_POST['oldsid'];
            $Position = $_POST['Position'];

            $Email = $_POST['Email'];
            $plainPassword  = $_POST['Password'];

            $Password=sha1($plainPassword);

            $stmt->execute();

            header("Location: staffs.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('You are not allowed!')</script>";
        unset($_GET['update']);
    }
}

// Delete
if (isset($_GET['delete'])) {
    if ($_SESSION['userposition'] == "Admin") {
        try {

            $stmt = $conn->prepare("DELETE FROM tbl_staffs_a184539_pt2 WHERE ID = :sid");

            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

            $sid = $_GET['delete'];

            $stmt->execute();

            header("Location: staffs.php");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('You are not allowed!')</script>";
        unset($_GET['delete']);
    }
}

// Edit
if (isset($_GET['edit'])) {
    if ($_SESSION['userposition'] == "Admin") {
        try {

            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a184539_pt2 WHERE ID = :sid");

            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

            $sid = $_GET['edit'];

            $stmt->execute();

            $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('You are not allowed!')</script>";
        unset($_GET['edit']);
    }
}

$conn = null;

?>
