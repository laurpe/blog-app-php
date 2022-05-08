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
    $postId = $_GET["id"];
    $blogId = $_GET["blogId"];

    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":id", $postId);

    $stmt->execute();

    $result = $stmt->fetch();
    
    header("Location: blog.php?id=".$blogId);
}
?>
<?php include "header.php" ?>
<?php include "footer.php" ?>