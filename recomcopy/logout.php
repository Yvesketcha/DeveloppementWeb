<?php
    session_start();

    if (isset($_SESSION['users'])){
        unset($_SESSION);
        session_destroy();
    }
    header('Location:login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>