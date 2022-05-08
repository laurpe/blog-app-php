<?php include "db.php" ?>
<?php
session_start();

$objectDB = new DBConnect;
$conn = $objectDB->connect();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

if (isset($_POST["create_blog"])) {
    $blog_title = $_POST["blog_title"];
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO blogs(title, userId) VALUES(:title, :userId);";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":title", $blog_title);
    $stmt->bindValue(":userId", $user_id);

    $stmt->execute();

    $blog = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($blog === true) {
        echo "Could not create blog. Please try again";
    }
}
?>
<?php include "header.php" ?>
<div class="content">
<h2>My blogs <button type="button" id="btn-show-create-blog-form"><i class="fa-solid fa-plus"></i></button></h2>
<div class="create-blog-form hidden">
   <form method="POST">
       <div>
        <label for="blog_title">Blog title</label>
        </div>
        <div>
        <input type="text" id="blog_title" name="blog_title" />
        </div>
        <button type="submit" name="create_blog">Create blog</button>
    </form>
    </div>
<?php

$sql = "SELECT * FROM blogs";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $blogs = $stmt->fetchAll();
   ?>
   <ul>
       <?php foreach($blogs as $blog) {
           ?>
           <li>
               <a href="blog.php?id=<?php echo $blog["id"] ?>"><?php echo $blog["title"] ?></a>
               <a href="delete_blog.php?id=<?php echo $blog["id"] ?>"><i class="fa-solid fa-trash"></i></a>
            </li>
           <?php
       }
    ?>
   </ul>
    </div>
<?php include "footer.php" ?>