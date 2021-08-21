<?php

require '../config/config.php';
$queryProduct = queryProduct("SELECT * FROM tbl_product ORDER BY terjual DESC");
$totalProduct = count($queryProduct);

if(isset($_POST['cari3'])) {
    $queryProduct = pencarianProduct($_POST['kata_kunci']);
    $hasilPencarian = pencarianProduct($_POST['kata_kunci']);
    $totalPencarian = count($hasilPencarian);
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
    <link rel="stylesheet" href="../css/product.css?v=<?php echo time(); ?>">
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
                    <li><a class="select" id="select2" href="transaction-logger.php"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Transaction</a></li>
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
        <h1 class="heading">Manage Products</h1>
        <p class="date"><?php echo date("j F Y"); ?></p>
        <?php
        if(isset($_SESSION['berhasilTambah'])) {
            echo "<center>
                    <div class='success'>
                        <i class='fas fa-check-circle'></i> Produk berhasil ditambahkan</i>
                    </div>
                </center>
            <script type='text/javascript'>
                    setTimeout(function () {
                        },10);
                    window.setTimeout(function(){
                        window.location.replace('product.php');
                    } ,3000);
                </script>";
            unset($_SESSION['berhasilTambah']);
        }
        if(isset($_SESSION['berhasilUbah'])) {
            echo "<center>
                    <div class='success'>
                        <i class='fas fa-check-circle'></i> Data produk berhasil diubah</i>
                    </div>
                </center>
            <script type='text/javascript'>
                    setTimeout(function () {
                        },10);
                    window.setTimeout(function(){
                        window.location.replace('product.php');
                    } ,3000);
                </script>";
            unset($_SESSION['berhasilUbah']);
        }
        if(isset($_SESSION['hapusProduk'])) {
            echo "<center>
                    <div class='success'>
                        <i class='fas fa-check-circle'></i> Produk berhasil dihapus</i>
                    </div>
                </center>
            <script type='text/javascript'>
                    setTimeout(function () {
                        },10);
                    window.setTimeout(function(){
                        window.location.replace('product.php');
                    } ,3000);
                </script>";
            unset($_SESSION['hapusProduk']);
        }
        ?>
<!-- Search Box -->
<section class="pencarian">
    <div class="container">
        <form method="post">
            <input type="text" name="kata_kunci" placeholder="Pencarian">
            <button type="submit" name="cari3" class="button-pencarian">
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
            echo "<span class='admin'>Total Product&nbsp; " . $totalProduct . "</span>";
        }
        ?>
    </h5>
    <?php
    if($_SESSION['job_desc'] == 'Owner' || $_SESSION['job_desc'] == 'CEO' || $_SESSION['job_desc'] == 'Product Manager') {
        echo "<a href='add-product.php' class='btn-hijau'><i class='far fa-plus-square'></i>&nbsp;&nbsp;Tambah Produk</a>";
    }
    ?>
</section>
<!-- Informasi -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Tgl Tambah</th>
                    <th>Terjual</th>
                    <?php
                    if($_SESSION['job_desc'] == 'Owner' || $_SESSION['job_desc'] == 'CEO' || $_SESSION['job_desc'] == 'Product Manager') {
                        echo "<th>Opsi</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($queryProduct as $dataProduct) : ?>
                <tr>
                    <td data-label="No"><?= $i; ?></td>
                    <td data-label="Gambar"><img class="resize-image" src="../uploads/<?= $dataProduct['gambar']; ?>"></td>
                    <td data-label="Nama Produk"><?= $dataProduct['nama_product']; ?></td>
                    <td data-label="Harga"><?= 'Rp ' . number_format($dataProduct['harga']); ?></td>
                    <td data-label="Tgl Tambah"><?= $dataProduct['tgl_tambah']; ?></td>
                    <td data-label="Terjual"><?= $dataProduct['terjual']; ?></td>
                    <?php
                    $idProduct = $dataProduct['id'];
                    if($_SESSION['job_desc'] == 'Owner' || $_SESSION['job_desc'] == 'CEO' || $_SESSION['job_desc'] == 'Product Manager') {
                        echo "<td data-label='Opsi'>
                                <a href='detail-product.php?id=$idProduct' class='btn-biru'><i class='fas fa-info-circle'></i>&nbsp;&nbsp;Detail</a>
                            </td>";
                    }
                    ?>
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