<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <title>Blog app</title>
</head>
<body>
    <header>
        <h1>Blog app</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
        <?php
            if (isset($_SESSION["user_id"])) {
                echo "<li><a href='myblogs.php'>Blogs</a></li>";
                echo "<li><a href='logout.php'>Log out</a></li>";
            } else {
                echo "<li><a href='signup.php'>Sign up</a></li>";
                echo "<li><a href='login.php'>Log in</a></li>";
            }
        ?>
            </ul>
        </nav>
    </header>