<?php

require '../config/config.php';
$id = $_GET['id'];
$dataProduct = queryProduct("SELECT * FROM tbl_product WHERE id = $id")[0];
if(isset($_POST['ya'])) {
    hapusProduk("DELETE FROM tbl_product WHERE id = $id");
    if(hapusProduk($_POST) > 0) {
        header("Location: product.php");
        $_SESSION['hapusProduk'] = true;
    }
}

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
    <link rel="stylesheet" href="../css/detail-product.css?v=<?php echo time(); ?>">
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
            <li><a href="#"><i class="fas fa-box-open"></i>&nbsp;&nbsp;Product</a></li>
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
<!-- Detail Product -->
<section class="product">
    <div class="container">
        <h1 class="title-form">Detail Product</h1>
            <div class="form">
                <label class="form-label">Nama Produk</label><br>
                <div class="form-text"><?= $dataProduct['nama_product']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Gambar</label><br>
                <div class="form-text">
                    <img class="resize-image" src="../uploads/<?= $dataProduct['gambar']; ?>">
                </div>
            </div>
            <div class="form">
                <label class="form-label">Harga</label><br>
                <div class="form-text"><?= "Rp " . number_format($dataProduct['harga']); ?></div>
            </div>
            <div class="form">
                <label class="form-label">Tanggal Ditambahkan</label><br>
                <div class="form-text"><?= $dataProduct['tgl_tambah']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Terjual</label><br>
                <div class="form-text"><?= $dataProduct['terjual']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Deskripsi</label><br>
                <div class="form-text">
                    <p class="deskripsi">
                        <textarea disabled><?= $dataProduct['deskripsi']; ?></textarea>
                    </p>
                </div>
            </div>
<!-- Modal Box -->
<a href="edit-product.php?id=<?= $dataProduct['id']; ?>" class="btn-biru"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit</a>
    <input type="checkbox" id="click">
    <label for="click" class="click-me"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Hapus</label>
    <div class="content">
        <div class="header">
            <h2>Delete Product</h2>
        </div>
        <label for="click" class="fas fa-exclamation-circle"></label>
        <p class="modal-text">Apakah anda yakin untuk menghapus produk ini ?</p>
        <div class="garis"></div>
        <form method="post">
            <button type="submit" class="btn-ya" name="ya">Ya</button>
        </form>
        <label for="click" class="btn-tidak">Tidak</label>
</div><br>
<!-- Modal Box -->
        <a class="kembali" href="product.php"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>
</section>
<!-- Detail Product -->
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