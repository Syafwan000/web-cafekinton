<?php

require '../config/config.php';
$id = $_GET['id'];
$dataUser = queryUser("SELECT * FROM tbl_user WHERE id = $id")[0];
if(isset($_POST['ya'])) {
    disable("UPDATE tbl_user SET status = 'Nonaktif' WHERE id = $id");
}
if(isset($_POST['ya2'])) {
    enable("UPDATE tbl_user SET status = 'Aktif' WHERE id = $id");
}

if($_SESSION['job_desc'] == 'Product Manager' || $_SESSION['job_desc'] == 'Staff' || $_SESSION['job_desc'] == '-') {
    header("Location: ../user/user-restricted.php");
}

if(!isset($_GET['id'])) {
    header("Location: user-customer.php");
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
    <link rel="stylesheet" href="../css/detail-user.css?v=<?php echo time(); ?>">
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
<!-- Profile -->
<section class="profile">
    <div class="container">
        <h1 class="title-form"><?= $dataUser['username']; ?>'s Profile</h1>
            <div class="form">
                <label class="form-label">Nama Lengkap</label><br>
                <div class="form-text"><?= $dataUser['nama_lengkap']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Username</label><br>
                <div class="form-text"><?= $dataUser['username']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Role</label><br>
                <div class="form-text"><?= $dataUser['role']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Status</label><br>
                <div class="form-text"><?= $dataUser['status']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Bergabung pada tanggal</label><br>
                <div class="form-text"><?= $dataUser['tgl_buat']; ?></div>
            </div>
<!-- Modal Box & Modal Box2 -->
        <?php
        $idUser = $dataUser['id'];
        if($dataUser['status'] == "Aktif") {
            echo "<a href='../config/add-admin.php?id=$id' class='btn-hijau'><i class='fas fa-plus'></i>&nbsp;&nbsp;Admin</a>
                <input type='checkbox' id='click'>
                <label for='click' class='click-me'><i class='fas fa-ban'></i>&nbsp;&nbsp;Disable</label>
                <div class='content'>
                    <div class='header'>
                        <h2>Disable User</h2>
                    </div>
                    <label for='click' class='fas fa-exclamation-circle'></label>
                    <p class='modal-text'>Apakah anda yakin untuk menonaktifkan akun ini ?</p>
                    <div class='garis'></div>
                    <form method='post'>
                        <input type='hidden' value='<?= $id; ?>'>
                        <button type='submit' class='btn-ya' name='ya'>Ya</button>
                    </form>
                    <label for='click' class='btn-tidak'>Tidak</label>
                </div><br>";
        } elseif($dataUser['status'] == "Nonaktif") {
            echo "<input type='checkbox' id='click2'>
                <label for='click2' class='click-me2'><i class='fas fa-globe'></i>&nbsp;&nbsp;Enable</label>
                <div class='content2'>
                    <div class='header2'>
                        <h2>Enable User</h2>
                    </div>
                    <label for='click' class='fas fa-exclamation-circle dua'></label>
                    <p class='modal-text2'>Apakah anda yakin untuk mengaktifkan akun ini ?</p>
                    <div class='garis2'></div>
                    <form method='post'>
                        <input type='hidden' value='<?= $id; ?>'>
                        <button type='submit' class='btn-ya2' name='ya2'>Ya</button>
                    </form>
                    <label for='click2' class='btn-tidak2'>Tidak</label>
                </div><br>";
        }
        ?>
<!-- Modal Box & Modal Box2 -->
        <a class="kembali" href="user-customer.php"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>
</section>
<!-- Profile -->
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