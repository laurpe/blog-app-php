<?php session_start(); ?>
<?php include "header.php" ?>
<?php

if (isset($_SESSION["user_id"])) {
    ?>
    <div class="content">
    <p>Welcome <?php echo $_SESSION["username"] ?>!</p>
    </div>
    <?php
} else {
    ?>
    <div class="content">
    <p>Login or sign up to continue</p>
    </div>
    <?php
}
?>
<?php include "footer.php" ?>