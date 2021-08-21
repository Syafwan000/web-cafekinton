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
    <link rel="stylesheet" href="../css/user-restricted.css?v=<?php echo time(); ?>">
    <title>Kinton Cafe | Restricted</title>
</head>
<body>
<div class="container">
    <h1>
        User Restricted
    </h1>
    <p class="paragraf">Anda tidak diizinkan untuk mengakses halaman ini</p>
    <img src="../img/restricted.svg"><br>
    <a class="btn-logout" href="../index.php">Kembali ke Home</a>
</div>
</body>
</html>