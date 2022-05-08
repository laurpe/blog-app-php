<?php include "db.php" ?>
<?php
    session_start();

    $objectDB = new DBConnect;
    $conn = $objectDB->connect();

    if (isset($_POST["signup"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $options = [
            "cost" => 12,
        ];

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);

        $sql = $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $passwordHash);

        $result = $stmt->execute();

        if ($result) {
            echo "Signup complete!";
        }
    }
?>
<?php include "header.php" ?>
<div class="content">
<h2>Sign up</h2>
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
        <input type="text" id="password" name="password" />
        </div>
        <button type="submit" name="signup">Sign up</button>
    </form>
</div>
<?php include "footer.php" ?>
