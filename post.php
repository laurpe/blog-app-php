<?php ob_start() ?>
<?php include "db.php" ?>
<?php
session_start();

$objectDB = new DBConnect;
$conn = $objectDB->connect();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}
?>
<?php include "header.php" ?>
<?php
if (isset($_GET["id"])) {
    $postId = $_GET["id"];
    $blogId = $_GET["blogId"];

    $sql = "SELECT * FROM posts WHERE id=$postId";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $post = $stmt->fetch();

if (isset($_POST["update_post"])) {
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    $blogId = $_GET["blogId"];

    $sql = "UPDATE posts SET title = :title, content = :content, blogId = :blogId WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":title", $post_title);
    $stmt->bindValue(":content", $post_content);
    $stmt->bindValue(":blogId", $blogId);
    $stmt->bindValue(":id", $postId);

    $stmt->execute();

    $postUpdated = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($postUpdated === false) {
        header("Location: post.php?id=".$postId."&blogId=".$blogId);
    } else {
        echo "Could not update post. Please try again";
    }
}
    ?>
    <div class="content">
    <div class="post">
        <h2><?php echo $post["title"] ?><button type="button" id="edit-post-btn"><i class="fa-solid fa-pen"></i></button><a href="delete_post.php?id=<?php echo $postId ?>&blogId=<?php echo $blogId ?>"><i class="fa-solid fa-trash"></i></a></h2>
        <p><?php echo $post["content"] ?></p>
        <p>Posted at <?php echo $post["date"] ?></p>
    </div>
    <a href="blog.php?id=<?php echo $blogId ?>">Back to blog</a>

    <form method="POST" class="edit-post-form hidden">
        <div>
            <label for="post_title">Title</label>
        </div>
        <div>
            <input type="text" id="post_title" name="post_title" value="<?php echo $post["title"] ?>" />
        </div>
        <div>
            <label for="post_content">Content</label>
        </div>
        <div>
            <textarea type="text" id="post_content" name="post_content" rows=10 cols=40><?php echo $post["content"] ?></textarea>
        </div>
        <div>
            <button type="submit" name="update_post">Save</button>
            <button type="button" id="hide-edit-post-form">Cancel</button>
        </div>
    </form>
</div>
<?php
}
?>

<?php include "footer.php" ?>