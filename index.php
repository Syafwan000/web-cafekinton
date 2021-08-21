<?php

require 'config/config.php';
$hasilCustomer = queryProduct("SELECT * FROM tbl_user WHERE role = 'Customer' AND status = 'Aktif'");
$totalCustomer = count($hasilCustomer);

$dataProduct = queryProduct("SELECT * FROM tbl_product");

if(isset($_POST['rating'])) {
    if(rating($_POST) > 0) {
        $beriMasukan = true;
    }
}

@$id_user = $_SESSION['id'];
@$dataUser = queryUser("SELECT * FROM tbl_user WHERE id = $id_user")[0];

if(isset($_SESSION['status']) == "Nonaktif") {
    header("Location: auth/logout.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <title>Cafe Kinton</title>
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
                        echo "<li><a class='select' href='user/profile.php'><i class='fas fa-id-badge'></i>&nbsp;&nbsp;Profile</a></li>
                            <li><a class='select' href='user/transaction.php'><i class='fas fa-money-check-alt'></i>&nbsp;&nbsp;Log</a></li>
                            <li><a class='select' href='auth/logout.php'><i class='fas fa-sign-out-alt'></i>&nbsp;&nbsp;Logout</a></li>";
                    } else {
                        echo "<li><a class='select' href='auth/login.php'><i class='fas fa-key'></i>&nbsp;&nbsp;Login</a></li>
                            <li><a class='select' href='auth/register.php'><i class='fas fa-file-alt'></i>&nbsp;&nbsp;Register</a></li>";
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
        <a href="index.php">
            <img class="logo-img" src="img/coffee.png">
        </a>
    </div>
    <nav class="nav-bot">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop/shop.php">Shop</a></li>
            <li><a href="menu/menu.php">Menu</a></li>
            <?php
            @$role = $_SESSION['role'];
            if($role == "Admin") {
                echo "<li><a href='admin/admin.php'>Admin</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="menu-toggle"><i class="fas fa-bars"></i></div>
</header>
<!-- Navbar Bottom -->
<!-- Banner -->
<section class="banner">
    <div class="top-wrapper">
        <div class="container">
            <h1>Selamat Datang di Cafe Kinton</h1>
            <p>Cafe ini menyediakan banyak makanan dan minuman terhits di Indonesia<br>
            Kami menawarkan menu makanan ataupun minuman yang lengkap</p>
        <div class="btn-wrapper">
            <?php
            if(isset($_SESSION['login'])) {
                echo "<a href='menu/menu.php' class='btn menu-btn'>Menu</a>
                    <a href='shop/shop.php' class='btn shop-btn'>Shop</a>";
            } else {
                echo "<a href='auth/login.php' class='btn login-btn'>Login</a>
                    <a href='auth/register.php' class='btn register-btn'>Register</a>";
            }
            ?>
            <p class="customer-counter">*Sebanyak <?= $totalCustomer; ?> orang telah bergabung menjadi customer kami</p>
            <?php
            if(isset($beriMasukan)) {
                echo "<center>
                        <div class='success'>
                            <i class='fas fa-comments'></i> Terimakasih atas masukan anda</i>
                        </div>
                    </center>
                <script type='text/javascript'>
                        setTimeout(function () {
                            },10);
                        window.setTimeout(function(){
                            window.location.replace('index.php');
                        } ,2000);
                    </script>";
            }
            ?>
        </div>
        </div>
    </div>
</section>
<!-- Banner -->
<!-- About -->
<section class="about">
    <div class="hero">
      <div class="heroleft">
        <h2>Tentang Kami</h2>
        <p>
        Cafe Kinton adalah cafe pertama di Indonesia yang menjual kopi dan makanan lainnya.
        Dibuat pada tanggal 10 April 2021 dengan 3 orang FrontEnd dan BackEnd.
        Cafe ini memiliki core menu yaitu kopi manis nya yang sangat mantap dan wajib dicoba oleh kalangan anak anak, 
        remaja, dan orang tua sekalipun. Nikmati menu menu di cafe kinton dan tunggu menu menu yang akan segera datang.
        </p>
      </div>
      <div class="heroright">
        <img src="img/gambar-home-1.jpg" />
      </div>
    </div>
</section>
<!-- About -->
<!-- Menu Desc -->
<section class="about2">
    <div class="hero2">
    <div class="heroleft2">
        <img src="img/gambar-home-2.jpg" />
      </div>
      <div class="heroright2">
        <h2>Menu Kami</h2>
        <p>
        Cafe kami menyediakan beberapa varian menu yang menarik dan memiliki cita rasa yang unik,
        cafe kami juga menyediakan berbagai makanan dan minuman lokal maupun Internasional, selain itu cafe
        kami juga memiliki sertifikat halal, bahan bahan makanannya juga terjamin kualitasnya.
        </p>
      </div>
    </div>
</section>
<!-- Menu Desc -->
<!-- Rating -->
<?php
@$iduser = $_SESSION['id'];
if(!isset($_SESSION['login'])) {
    echo "";
} elseif(isset($_SESSION['login'])) {
    if($dataUser['rating'] == "Puas" || $dataUser['rating'] == "Tidak Puas") {
        echo "";
    } elseif($dataUser['rating'] == "-") {
        echo "<section class='rating'>
            <div class='container-rating'>
                <h2>Apakah anda puas dengan pelayanan dan fitur cafe kinton ?</h2>
                <form method='post'>
                <input type='hidden' name='iduser' value='$iduser'>
                    <button type='submit' name='rating' value='Puas' class='btn-rating-puas'>
                        <i class='fas fa-smile'></i>&nbsp;&nbsp;Puas
                    </button>
                    <button type='submit' name='rating' value='Tidak Puas' class='btn-rating-tidakpuas'>
                        <i class='fas fa-frown'></i>&nbsp;&nbsp;Tidak Puas
                    </button>
                </form>
            </div>
        </section>";
    }
}
?>
<!-- Rating -->
<!-- Rekomendasi Menu -->
<h2 class="title-rekomen">Menu Rekomendasi</h2>
<div class="rekomen-wrapper">
      <div class="container-rekomen">
        <div class="rekomen">
            <div class="logo">
              <img class="resize-image" src="uploads/<?= $dataProduct[0]['gambar']; ?>"/>
            </div>
            <div class="title">
              <h3><?= $dataProduct[0]['nama_product']; ?></h3>
            </div>
            <div class="content">
              <p>Terjual <span class="terjual-counter"><?= $dataProduct[0]['terjual']; ?></span></p>
              <p>Rp <?= number_format($dataProduct[0]['harga']); ?></p>
            </div>
            <a href="shop/shop-detail.php?id=<?= $dataProduct[0]['id']; ?>">
            <div class="btn-rekomen">
                <span class="btn-rek rekomen-btn">Order Now</span>
            </div>
          </a>
        </div>
        <div class="rekomen">
            <div class="logo">
              <img class="resize-image" src="uploads/<?= $dataProduct[1]['gambar']; ?>"/>
            </div>
            <div class="title">
              <h3><?= $dataProduct[1]['nama_product']; ?></h3>
            </div>
            <div class="content">
              <p>Terjual <span class="terjual-counter"><?= $dataProduct[1]['terjual']; ?></span></p>
              <p>Rp <?= number_format($dataProduct[1]['harga']); ?></p>
            </div>
            <a href="shop/shop-detail.php?id=<?= $dataProduct[1]['id']; ?>">
            <div class="btn-rekomen">
                <span class="btn-rek rekomen-btn">Order Now</span>
            </div>
          </a>
        </div>
        <div class="rekomen">
            <div class="logo">
              <img class="resize-image" src="uploads/<?= $dataProduct[2]['gambar']; ?>"/>
            </div>
            <div class="title">
              <h3><?= $dataProduct[2]['nama_product']; ?></h3>
            </div>
            <div class="content">
              <p>Terjual <span class="terjual-counter"><?= $dataProduct[2]['terjual']; ?></span></p>
              <p>Rp <?= number_format($dataProduct[2]['harga']); ?></p>
            </div>
            <a href="shop/shop-detail.php?id=<?= $dataProduct[2]['id']; ?>">
            <div class="btn-rekomen">
                <span class="btn-rek rekomen-btn">Order Now</span>
            </div>
          </a>
        </div>
        <div class="rekomen">
            <div class="logo">
              <img class="resize-image" src="uploads/<?= $dataProduct[3]['gambar']; ?>"/>
            </div>
            <div class="title">
              <h3><?= $dataProduct[3]['nama_product']; ?></h3>
            </div>
            <div class="content">
              <p>Terjual <span class="terjual-counter"><?= $dataProduct[3]['terjual']; ?></span></p>
              <p>Rp <?= number_format($dataProduct[3]['harga']); ?></p>
            </div>
            <a href="shop/shop-detail.php?id=<?= $dataProduct[3]['id']; ?>">
            <div class="btn-rekomen">
                <span class="btn-rek rekomen-btn">Order Now</span>
            </div>
          </a>
        </div>
      </div>
    </div>
<!-- Rekomendasi Menu -->
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
        <p>Copyright &copy;2021 <a href="developer/kintondev.php" target="_blank" class="dev">KintonDev</a></p>
    </div>
</footer>
<!-- Footer -->
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