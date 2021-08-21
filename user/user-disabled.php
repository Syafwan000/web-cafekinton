<?php

require '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/user-disabled.css?v=<?php echo time(); ?>">
    <title>Kinton Cafe | Disabled</title>
</head>
<body>
<div class="container">
    <h1>
        Halo, <?= $_SESSION['username']; ?>
    </h1>
    <p class="paragraf">Tampaknya akun anda telah dinonaktifkan oleh admin</p>
    <p class="paragraf2">dikarenakan anda telah melanggar peraturan yang berlaku di cafe kami</p>
    <img src="../img/disabled.svg">
    <p class="paragraf">Jika anda merasa tidak melanggar peraturan cafe kami</p>
    <p class="paragraf3">anda dapat menghubungi admin/staff</p>
    <a class="btn-logout" href="../auth/logout.php">Logout</a>
</div>
</body>
</html>