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
if (isset($_POST["create_post"])) {
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    $blogId = $_POST["blogId"];

    $sql = "INSERT INTO posts(title, content, blogId) VALUES(:title, :content, :blogId);";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(":title", $post_title);
    $stmt->bindValue(":content", $post_content);
    $stmt->bindValue(":blogId", $blogId);

    $stmt->execute();

    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post === true) {
        echo "Could not create post. Please try again";
    }
}
if (isset($_GET["id"])) {
    $blogId = $_GET["id"];

    $sql_blog = "SELECT title FROM blogs WHERE id=$blogId";
    $stmt_blog = $conn->prepare($sql_blog);

    $stmt_blog->execute();

    $blog = $stmt_blog->fetch();

    $sql = "SELECT * FROM posts WHERE blogId=$blogId";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $posts = $stmt->fetchAll();
    ?>
    <div class="content">
    <h2><?php echo $blog["title"] ?><button type="button" id="show-create-post-btn"><i class="fa-solid fa-plus"></i></button></h2>
    <form method="POST" class="create-post-form hidden">
        <div>
            <label for="post_title">Title</label>
        </div>
        <div>
            <input type="text" id="post_title" name="post_title" />
        </div>
        <div>
            <label for="post_content">Content</label>
        </div>
        <div>
            <textarea type="text" id="post_content" name="post_content" rows=10 cols=40>
            </textarea>
        </div>
        <input type="text" id="blogId" name="blogId" value=<?php echo $blogId ?> hidden/>
            <button type="submit" name="create_post">Save post</button>
    </form>
    <ul>
        <?php foreach($posts as $post) {
            ?>
            <li><a href="post.php?id=<?php echo $post["id"] ?>&blogId=<?php echo $blogId ?>"><?php echo $post["title"] ?></a></li>
            <?php
        }
    ?>
    </ul>
    </div>
<?php
}
?>

<?php include "footer.php" ?>