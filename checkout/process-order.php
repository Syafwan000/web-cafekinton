<?php

require '../config/config.php';
if(!isset($_SESSION['login'])) {
    header("Location: ../shop/shop.php");
}

if(!isset($_SESSION['process'])) {
    header("Location: ../shop/shop.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/process.css?v=<?php echo time(); ?>">
    <title>Process Order</title>
</head>
<body>
    <?php
    if(isset($_SESSION['process'])) {
        echo "<center>
                <div class='container'>
                    <h2>Mohon Tunggu Sebentar</h2>
                    <p>Sedang proses</p>
                    <div class='container-loader'>
                        <div class='dot dot1'></div>
                        <div class='dot dot2'></div>
                        <div class='dot dot3'></div>
                    </div>
                </div>
            </center>
        <script type='text/javascript'>
                setTimeout(function () {
                    },10);
                window.setTimeout(function(){
                    window.location.replace('../user/transaction.php');
                } ,5000);
            </script>";
        unset($_SESSION['process']);
    }
    ?>
</body>
</html>