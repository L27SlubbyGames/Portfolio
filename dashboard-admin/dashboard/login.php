<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="../../main-core/img/logo.png"/>
        <link rel="stylesheet" href="../core/css/style.css">
        <link rel="stylesheet" href="css/login.min.css">
        <?php require("../../main-core/database-connectie.php") ?>
    </head>
    <body>  
        <form action="" method="post" name="login" class="center">
            <table cellpadding="5" cellspacing="0" class="center-table">
                <tr>
                    <td><input type="text"  name="username" placeholder="Username" value="<?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; }?>" required /></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['pass'])) {echo $_COOKIE['pass'];} ?>" required /></td>
                </tr>
                <tr>
                    <td><label><input type="checkbox" name="remember" value="1" <?php if(isset($_COOKIE["checked"])) { ?> checked <?php } ?> >Remember me</label></td>
                </tr>
                <tr>
                    <td><input name="submit" type="submit" value="Login" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
    session_start();
    if(isset($_POST['username']) && $_POST['password']){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $login_info = $connect->prepare('SELECT username, passcode FROM users WHERE username=? AND passcode=?');
        $login_info->execute(array($username,$password));
        if($login_info->rowCount() >= 1) {
            $time = time() + (10 * 365 * 24 * 60 * 60);
            if(!empty($_POST['remember'])){
                setcookie('name', $_POST['username'], $time);
                setcookie('pass', $_POST['password'], $time);
                setcookie('checked', $_POST['remember'],$time);
                }
                else{
                    unset($_COOKIE['name']);
                    unset($_COOKIE['pass']);
                    unset($_COOKIE['remember']);
                }
        $_SESSION['user'] = $username;
        header("location: index.php");
        }
    else {
        echo "<h5 style='color: red' >Username/password is incorrect.</h5>";
        }
    }
?>