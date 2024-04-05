<?php
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Create
if (isset($_POST['create'])) {
try {
$stmt = $conn->prepare("INSERT INTO tbl_customers_a184539_pt2(ID, Name,Gender, Member, postdate,posttime) VALUES(:cid, :Name, :Gender,:Member,:postdate, :posttime)");
$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
$stmt->bindParam(':Name', $Name, PDO::PARAM_STR);
$stmt->bindParam(':Gender', $Gender, PDO::PARAM_STR);
$stmt->bindParam(':Member', $Member, PDO::PARAM_STR);
$stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);
$stmt->bindParam(':posttime', $posttime, PDO::PARAM_STR);
$cid = $_POST['cid'];
$Name = $_POST['Name'];
$Gender = $_POST['Gender'];
$Member = $_POST['Member'];
$postdate = date("Y-m-d",time());
$posttime = date("H:i:s",time());

$stmt->execute();
}

catch(PDOException $e)
{
 "Error: " . $e->getMessage();
}
}

//Update
if (isset($_POST['update'])) {

try {

$stmt = $conn->prepare("UPDATE tbl_customers_a184539_pt2 SET ID = :cid,Name = :Name, Gender = :Gender,Member = :Member,postdate=:postdate,posttime=:posttime WHERE ID = :oldcid");

$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
$stmt->bindParam(':Name', $Name, PDO::PARAM_STR);
$stmt->bindParam(':Gender', $Gender, PDO::PARAM_STR);
$stmt->bindParam(':Member', $Member, PDO::PARAM_STR);
$stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
$stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);
$stmt->bindParam(':posttime', $posttime, PDO::PARAM_STR);

$cid = $_POST['cid'];
$Name = $_POST['Name'];
$Gender = $_POST['Gender'];
$Member = $_POST['Member'];
$oldcid = $_POST['oldcid'];
$postdate = date("Y-m-d",time());
$posttime = date("H:i:s",time());

$stmt->execute();

header("Location: customers.php");
}

catch(PDOException $e)
{
echo "Error: " . $e->getMessage();
}
}

//Delete
if (isset($_GET['delete'])) {

try {

$stmt = $conn->prepare("DELETE FROM tbl_customers_a184539_pt2 WHERE ID = :cid");

$stmt->bindParam(':cid', $cid, PDO::PARAM_STR);

$cid = $_GET['delete'];

$stmt->execute();

("Location: customers.php");
}

catch(PDOException $e)
{
echo "Error: " . $e->getMessage();
}
}

//Edit
if (isset($_GET['edit'])) {

try {

$stmt = $conn->prepare("SELECT * FROM tbl_customers_a184539_pt2 WHERE ID = :cid");

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

$conn = null;

?>