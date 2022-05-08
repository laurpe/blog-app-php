<?php include "db.php" ?>
<?php
    session_start();

    $objectDB = new DBConnect;
    $conn = $objectDB->connect();

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":username", $username);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            die("Incorrect username and/or password");
        } else {
            $validPassword = password_verify($password, $user["password"]);

            if ($validPassword) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];

                header("location: index.php");
                exit();
            } else {
                die("Incorrect username/password combination!");
            }
        }
    }
?>

<?php include "header.php" ?>
<div class="content">
<h2>Login</h2>
<form method="POST">
    <div>
        <label for="username">Username</label>
        </div>
        <div>
        <input type="text" id="username" name="username" />
        </div>
        <div>
        <label for="password">Password</label>
        </div>
        <div>
        <input type="password" id="password" name="password" />
        </div>
        <button type="submit" name="login">Log in</button>
    </form>
</div>
<?php include "footer.php" ?>