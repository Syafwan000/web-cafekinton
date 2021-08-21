<?php

require '../config/config.php';

$idUser = $_SESSION['id'];
$queryTransaction = queryTransaction("SELECT * FROM tbl_order WHERE id_user = $idUser ORDER BY tgl_transaksi DESC");
$totalTransaction = count($queryTransaction);

if(!isset($_SESSION['login'])) {
    $_SESSION['loginDahulu'] = true;
    header("Location: ../auth/login.php");
}

if(isset($_SESSION['status']) == "Nonaktif") {
    header("Location: ../auth/logout.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/transaction.css?v=<?php echo time(); ?>">
    <title>Cafe Kinton | Transaction</title>
</head>
<body>
<div class="scrollUp" onclick="scrollToUp();"></div>
<!-- Navbar Top -->
<header class="navbar-top">
    <div class="social-media">
        <a class="sosmed" id="m-1" href="#"><i class="fab fa-instagram"></i></a>
        <a class="sosmed" id="m-2" href="#"><i class="fab fa-whatsapp"></i></a>
        <a class="sosmed" href="#"><i class="fab fa-line"></i></a>
    </div>
    <nav>
        <ul>
            <li class="dropdown1"><a href="#"><i class="fas fa-user"></i>&nbsp;
                <?php
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['username'];
                } else {
                    echo "Tamu";
                }
                ?>
            &nbsp;<i class="fas fa-caret-down"></i></a>
                <ul>
                    <?php
                    if(isset($_SESSION['login'])) {
                        echo "<li><a class='select' href='profile.php'><i class='fas fa-id-badge'></i>&nbsp;&nbsp;Profile</a></li>
                            <li><a class='select' href='../auth/logout.php'><i class='fas fa-sign-out-alt'></i>&nbsp;&nbsp;Logout</a></li>";
                    } else {
                        echo "<li><a class='select' href='../auth/login.php'><i class='fas fa-key'></i>&nbsp;&nbsp;Login</a></li>
                            <li><a class='select' href='../auth/register.php'><i class='fas fa-file-alt'></i>&nbsp;&nbsp;Register</a></li>";
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- Navbar Top -->
<!-- Navbar Bottom -->
<header class="nav-top-mg">
    <div class="logo">
        <a href="../index.php">
            <img class="logo-img" src="../img/coffee.png">
        </a>
    </div>
    <nav class="nav-bot">
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../shop/shop.php">Shop</a></li>
            <li><a href="../menu/menu.php">Menu</a></li>
            <?php
            @$role = $_SESSION['role'];
            if($role == "Admin") {
                echo "<li><a href='../admin/admin.php'>Admin</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="menu-toggle"><i class="fas fa-bars"></i></div>
</header>
<!-- Navbar Bottom -->
<!-- Tabel -->
<section class="tabel">
    <div class="table-container">
        <h1 class="heading">Your Transaction</h1>
        <p class="date"><?php echo date("j F Y"); ?></p>
<!-- Informasi -->
<section class="informasi">
    <h5>
        <span class='transaksi'>Total Transaksi <?= $totalTransaction; ?></span>
    </h5>
</section>
<!-- Informasi -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Tgl Transaksi</th>
                    <th>Pembayaran</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($queryTransaction as $dataTransaction) : ?>
                <tr>
                    <td data-label="No"><?= $i; ?></td>
                    <td data-label="Menu"><?= $dataTransaction['nama_product']; ?></td>
                    <td data-label="Quantity"><?= $dataTransaction['quantity']; ?></td>
                    <td data-label="Total Harga">Rp <?= number_format($dataTransaction['total_harga']); ?></td>
                    <td data-label="Tgl Transaksi"><?= $dataTransaction['tgl_transaksi']; ?></td>
                    <td data-label="Pembayaran"><?= $dataTransaction['payment_method']; ?></td>
                    <td data-label="Opsi">
                        <a href="../checkout/payment.php?id=<?= $dataTransaction['id']; ?>" class="btn-lihat"><i class="fas fa-copy"></i>&nbsp;&nbsp;Lihat</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<!-- Tabel -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // Navbar Dropdown
        $(document).ready(function(){
            $('.menu-toggle').click(function(){
                $('nav').toggleClass('active')
            })
            $('ul li').click(function(){
                $(this).toggleClass('active')
            })
        })

        // Sticky Navbar
        window.addEventListener("scroll", function(){
          var header = document.querySelector("header.navbar-top");
          header.classList.toggle("sticky", window.scrollY > 0);
        })

        window.addEventListener("scroll", function(){
          var header = document.querySelector("header.nav-top-mg");
          header.classList.toggle("sticky", window.scrollY > 0);
        })

        // ScrollUp
        window.addEventListener('scroll', function(){
            var scroll = document.querySelector('.scrollUp');
            scroll.classList.toggle("active" , window.scrollY > 0)
        })

        function scrollToUp(){
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            })
        }
    </script>
</body>
</html>