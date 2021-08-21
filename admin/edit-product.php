<?php

require '../config/config.php';
if(isset($_POST['ubah'])) {
    if( ubahProduk($_POST) > 0 ) {
        header("Location: product.php");
        $_SESSION['berhasilUbah'] = true;
    }
}

$id = $_GET['id'];
$dataProduct = queryProduct("SELECT * FROM tbl_product WHERE id = $id")[0];

if($_SESSION['job_desc'] == 'Customer Manager' || $_SESSION['job_desc'] == 'Staff' || $_SESSION['job_desc'] == '-') {
    header("Location: ../user/user-restricted.php");
}

if(!isset($_GET['id'])) {
    header("Location: product.php");
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
    <link rel="stylesheet" href="../css/edit-product.css?v=<?php echo time(); ?>">
    <title>Admin Dashboard</title>
</head>
<body>
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
<!-- Edit Product -->
<section class="edit-product">
    <div class="container">
        <h1 class="title-form">Edit Produk</h1>
        <?php
        if(isset($_SESSION['bukanGambar'])) {
            echo "<center>
                    <div class='warning'>
                        <i class='fas fa-exclamation-circle'> File yang anda upload bukan gambar</i>
                    </div>
                </center>
            <script type='text/javascript'>
                    setTimeout(function () {
                        },10);
                    window.setTimeout(function(){
                        window.location.replace('product.php');
                    } ,3000);
                </script>";
            unset($_SESSION['bukanGambar']);
        }
        if(isset($_SESSION['ukuranGambar'])) {
            echo "<center>
                    <div class='warning'>
                        <i class='fas fa-exclamation-circle'> Ukuran gambar terlalu besar melebihi 2 MB</i>
                    </div>
                </center>
            <script type='text/javascript'>
                    setTimeout(function () {
                        },10);
                    window.setTimeout(function(){
                        window.location.replace('product.php');
                    } ,3000);
                </script>";
            unset($_SESSION['ukuranGambar']);
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $dataProduct['id']; ?>">
            <input type="hidden" name="gambarLama" value="<?= $dataProduct['gambar']; ?>">
            <input type="hidden" name="tgl_tambah" value="<?= $dataProduct['tgl_tambah']; ?>">
            <input type="hidden" name="terjual" value="<?= $dataProduct['terjual']; ?>">
            <div class="form">
                <label class="form-label" for="nama_product">Nama Produk <span id="bintang">*</span></label><br>
                <input type="text" id="nama_product" name="nama_product" value="<?= $dataProduct['nama_product']; ?>" maxlength="18">
                <div class="form-text">Maksimal 18 Karakter</div>
            </div>
            <div class="form">
                <label class="form-label" for="gambar">Gambar Produk <span id="bintang">*</span></label><br>
                <img class="resize-image" src="<?= '../uploads/' . $dataProduct['gambar']; ?>"><br>
                <input type="file" id="gambar" class="upload-file" name="gambar">
                <div class="form-text">Maksimal size gambar 2 MB</div>
            </div>
            <div class="form">
                <label class="form-label" for="harga">Harga Produk <span id="bintang">*</span></label><br>
                <input type="number" id="harga" name="harga" value="<?= $dataProduct['harga']; ?>" min="0">
            </div>
            <div class="form">
                <label class="form-label" for="deskripsi">Deskripsi Produk <span id="bintang">*</span></label><br>
                <textarea name="deskripsi" id="deskripsi" maxlength="500"><?= $dataProduct['deskripsi']; ?></textarea>
                <div class="form-text">Maksimal 500  Karakter</div>
            </div>
            <button type="submit" name="ubah" class="button-ubah">Ubah</button>
            <a href="detail-product.php?id=<?= $id; ?>" class="button-kembali">Kembali</a>
        </form>
    </div>
</section>
<!-- Edit Product -->
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
    </script>
</body>
</html>