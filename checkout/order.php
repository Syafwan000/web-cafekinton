<?php

require '../config/config.php';
if(!isset($_SESSION['login'])) {
    $_SESSION['loginDahulu'] = true;
    header("Location: ../auth/login.php");
}

if(isset($_POST['order'])) {
    if(orderMenu($_POST) > 0) {
        $_SESSION['process'] = true;
        header("Location: process-order.php");
    }
    tambahTerjual($_POST);
}

$idProduct = $_GET['id'];
$orderProduct = queryProduct("SELECT * FROM tbl_product WHERE id = $idProduct")[0];

if(!isset($_GET['id'])) {
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
    <link rel="stylesheet" href="../css/order.css?v=<?php echo time(); ?>">
    <title>Cafe Kinton | Order</title>
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
                        echo "<li><a class='select' href='../user/profile.php'><i class='fas fa-id-badge'></i>&nbsp;&nbsp;Profile</a></li>
                            <li><a class='select' href='../user/transaction.php'><i class='fas fa-money-check-alt'></i>&nbsp;&nbsp;Log</a></li>
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
<!-- Order Form -->
<section class="order-form">
    <div class="container">
        <h1 class="title-form">Order Form</h1>
        <form method="post">
            <input type="hidden" name="id_user" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="nama_customer" value="<?= $_SESSION['nama_lengkap']; ?>">
            <input type="hidden" name="id_product" value="<?= $idProduct; ?>">
            <input type="hidden" name="nama_product" value="<?= $orderProduct['nama_product']; ?>">
            <input type="hidden" name="harga_satuan" value="<?= $orderProduct['harga']; ?>">
            <input type="hidden" name="terjual" value="<?= $orderProduct['terjual']; ?>">
            <input type="hidden" name="tgl_transaksi" value="<?= date("j F Y"); ?>">
            <div class="form">
                <label class="form-label" for="nama_menu">Nama Menu <span id="bintang">*</span></label><br>
                <div class="form-text"><?= $orderProduct['nama_product']; ?></div>
                <img class="resize-image" src="../uploads/<?= $orderProduct['gambar']; ?>" class="resize-image">
            </div>
            <div class="form">
                <label class="form-label" for="harga_satuan">Harga Satuan <span id="bintang">*</span></label><br>
                <div class="form-text">Rp <?= number_format($orderProduct['harga']); ?></div>
            </div>
            <div class="form">
                <label class="form-label" for="nama_customer">Nama Customer <span id="bintang">*</span></label><br>
                <div class="form-text"><?= $_SESSION['nama_lengkap']; ?></div>
            </div>
            <div class="form">
                <label class="form-label" for="alamat">Alamat <span id="bintang">*</span></label><br>
                <textarea name="alamat" id="alamat" maxlength="500" required></textarea>
            </div>
            <div class="form">
                <label class="form-label" for="quantity">Banyak Pesanan <span id="bintang">*</span></label><br>
                <input type="number" min="1" max="99" id="quantity" name="quantity" maxlength="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
            </div>
            <div class="form">
                <label class="form-label" for="payment_method">Metode Pembayaran <span id="bintang">*</span></label><br>
                <div class="choose">
                    <input type="radio" class="btn-payment" name="payment_method" value="OVO" id="ovo" required="required">
                    <label for="ovo" id="ovo-color" class="form__label">OVO</label>
                    <input type="radio" class="btn-payment" name="payment_method" value="GoPay" id="gopay" required="required">
                    <label for="gopay" id="gopay-color" class="form__label">GoPay</label>
                    <input type="radio" class="btn-payment" name="payment_method" value="Dana" id="dana" required="required">
                    <label for="dana" id="dana-color" class="form__label">Dana</label>
                </div>
            </div>
            <button class="button-order" type="submit" name="order"><i class="fas fa-shopping-bag"></i>&nbsp;&nbsp;Order</button>
            <a href="../shop/shop-detail.php?id=<?= $orderProduct['id']; ?>" class="button-kembali">Kembali</a>
        </form>
    </div>
</section>
<!-- Order Form -->
<!-- Footer -->
<footer>
    <div class="footer-content">
        <h3>Cafe Kinton</h3>
        <p>"Jangan lupa sarapan karena sarapan lebih sehat dari harapan"</p>
        <ul class="medsos">
            <li><a class="sosmed" id="m-1" href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a class="sosmed" id="m-2" href="#"><i class="fab fa-whatsapp"></i></a></li>
            <li><a class="sosmed" href="#"><i class="fab fa-line"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>Copyright &copy;2021 <a href="../developer/kintondev.php" target="_blank" class="dev">KintonDev</a></p>
    </div>
</footer>
<!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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