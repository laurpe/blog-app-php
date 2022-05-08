<?php include "db.php" ?>
<?php
session_start();

$objectDB = new DBConnect;
$conn = $objectDB->connect();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $blogId = $_GET["id"];

    $sql = "DELETE FROM blogs WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":id", $blogId);

    $stmt->execute();

    $result = $stmt->fetch();
    
    header("Location: myblogs.php");
}
?>
<?php include "header.php" ?>
<?php include "footer.php" ?>