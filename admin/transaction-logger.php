<?php

require '../config/config.php';
$queryTransaction = queryTransaction("SELECT * FROM tbl_order ORDER BY tgl_transaksi DESC");
$totalTransaction = count($queryTransaction);

if(isset($_POST['cari'])) {
    $queryTransaction = pencarianTransaction($_POST['kata_kunci']);
    $hasilPencarian = pencarianTransaction($_POST['kata_kunci']);
    $totalPencarian = count($hasilPencarian);
}

if($_SESSION['job_desc'] == '-') {
    header("Location: ../user/user-restricted.php");
}

if(!isset($_SESSION['login'])) {
    header("Location: ../user/user-restricted.php");
}

if($_SESSION['role'] == "Customer") {
    header("Location: ../user/user-restricted.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/transaction-logger.css?v=<?php echo time(); ?>">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="scrollUp" onclick="scrollToUp();"></div>
<!-- Navbar Bottom -->
<header class="nav-top-mg">
    <div class="logo">
        <a href="admin.php">
            Admin Dashboard
        </a>
    </div>
    <nav class="nav-bot">
        <ul>
            <li><a href="../index.php"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="admin.php"><i class="fas fa-folder-open"></i>&nbsp;&nbsp;Dashboard</a></li>
            <li><a href="product.php"><i class="fas fa-box-open"></i>&nbsp;&nbsp;Product</a></li>
            <li class="dropdown1"><a href="#"><i class="fas fa-user"></i>&nbsp;&nbsp;User&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                <ul>
                    <li><a class="select" id="select2" href="user-admin.php"><i class="fas fa-users-cog"></i>&nbsp;&nbsp;Admin</a></li>
                    <li><a class="select" id="select2" href="user-customer.php"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Customer</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="menu-toggle"><i class="fas fa-bars"></i></div>
</header>
<!-- Navbar Bottom -->
<!-- Tabel -->
<section class="tabel">
    <div class="table-container">
        <h1 class="heading">Transaction Log</h1>
        <p class="date"><?php echo date("j F Y"); ?></p>
<!-- Search Box -->
<section class="pencarian">
    <div class="container">
        <form method="post">
            <input type="text" name="kata_kunci" placeholder="Pencarian">
            <button type="submit" name="cari" class="button-pencarian">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</section>
<!-- Search Box -->
<!-- Informasi -->
<section class="informasi">
    <h5>
        <?php
        if(isset($totalPencarian)) {
            echo "<span class='cari'>Hasil Pencarian&nbsp; " . $totalPencarian . "</span>";
        } else {
            echo "<span class='transaksi'>Total Transaksi&nbsp; " . $totalTransaction . "</span>";
        }
        ?>
    </h5>
</section>
<!-- Informasi -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Tgl Transaksi</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($queryTransaction as $dataTransaction) : ?>
                <tr>
                    <td data-label="No"><?= $i; ?></td>
                    <td data-label="Nama Customer"><?= $dataTransaction['nama_customer']; ?></td>
                    <td data-label="Menu"><?= $dataTransaction['nama_product']; ?></td>
                    <td data-label="Quantity"><?= $dataTransaction['quantity']; ?></td>
                    <td data-label="Total Harga">Rp <?= number_format($dataTransaction['total_harga']); ?></td>
                    <td data-label="Tgl Transaksi"><?= $dataTransaction['tgl_transaksi']; ?></td>
                    <td data-label="Pembayaran"><?= $dataTransaction['payment_method']; ?></td>
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