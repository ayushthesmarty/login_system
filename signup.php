<?php 
    if(!isset($_COOKIE["user"]) or $_COOKIE["user"] == NULL or $_COOKIE["user"] == "gyhjkljhgfvhjkl;jxfdghjkl;jhgtfdjkiugfhjlijydrtguyiojftrserdyuioputyresrdfthjuygtrdfthji") {
        setcookie("user", "gyhjkljhgfvhjkl;jxfdghjkl;jhgtfdjkiugfhjlijydrtguyiojftrserdyuioputyresrdfthjuygtrdfthji", time()+86400);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <h1>Sign up</h1><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username: </label>
        <input name="username" id="username" placeholder="Username here..." type="text"><br><br>
        
        <label for="password">Password: </label>
        <input name="password" id="password" placeholder="Password here..." type="password"><br><br>
        
        <input type="submit" name="submit" value="Sign up!">
    </form>
    
    <?php 
        require 'connection.php';
    
        function validate_data($data) {
            $fixed_data = trim(strip_tags(stripslashes(htmlspecialchars(str_replace(' ', '', $data)))));
            return $fixed_data;
        }
        
        if($_POST["submit"]) {
            if(validate_data($_POST["username"]) and validate_data($_POST["password"])) {
                $username = validate_data($_POST["username"]);
                $password = validate_data($_POST["password"]);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);

                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if(!$username = $row["username"]) {
                            $query1 = "INSERT INTO users(username, password, hashpassword) VALUES('$username', '$password', '$hashpassword')";
                            mysqli_query($connection, $query1);
                            setcookie("user", $username, time()+86400);
                            header("Location: index.php");
                        } else {
                            $user_exists = TRUE;
                        }
                    }
                }
                if ($user_exists == TRUE) {
                    echo "<p style='color: red;'>This user already exists!</p>";
                    $user_exists = FALSE;
                }
            } else {
                echo "<p style='color: red;'>Please type your username/password.</p>";
            }
        }
    ?>

    <br><a href="login.php">Login-></a>

</body>
</html>