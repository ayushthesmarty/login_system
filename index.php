<?php 
    if($_COOKIE["user"] == "gyhjkljhgfvhjkl;jxfdghjkl;jhgtfdjkiugfhjlijydrtguyiojftrserdyuioputyresrdfthjuygtrdfthji" or !isset($_COOKIE["user"])) {
        header("Location: login.php");      
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You cant</title>
</head>
<body>
    <h1>You cant access this page without changing the cookie!!!!</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>

    <?php 
        if($_POST["logout"]) {
            setcookie("user", "gyhjkljhgfvhjkl;jxfdghjkl;jhgtfdjkiugfhjlijydrtguyiojftrserdyuioputyresrdfthjuygtrdfthji", time()+86400);
            header("Location: login.php");
        }
    ?>
</body>
</html>