<title>Pascal Huberts</title>
        <meta name="description" content="Portfolio admin tool">
        <meta name="author" content="Pascal Huberts">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="../../dashboard-users/dashboard/img/logo.png"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
        <link rel="stylesheet" href="../core/css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
    require("../../main-core/database-connectie.php");
    session_start();
    $user = $_SESSION['user'];
    $ID = $connect->prepare("SELECT ID FROM users WHERE username=?");
    $ID->execute(array($user));
    $ID_user = $ID->fetch();
    if($ID_user['ID'] != 1){
        header("location: ../dashboard/login.php");
    exit(); }
?>