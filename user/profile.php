<?php

require '../config/config.php';

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
    <link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
    <title>Cafe Kinton | Profile</title>
</head>
<body>
<!-- Navbar Top -->
<header class="navbar-top">
    <div class="social-media">
        <a class="sosmed" id="m-1" href="#"><i class="fab fa-instagram"></i></a>
        <a class="sosmed" id="m-2" href="#"><i class="fab fa-whatsapp"></i></a>
        <a class="sosmed" href="#"><i class="fab fa-line"></i></a>
    </div>
    <nav>
        <ul>
            <li class="dropdown1"><a href="#"><i class="fas fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['username']; ?>&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                <ul>
                    <li><a class='select' href='transaction.php'><i class='fas fa-money-check-alt'></i>&nbsp;&nbsp;Log</a></li>
                    <li><a class='select' href='../auth/logout.php'><i class='fas fa-sign-out-alt'></i>&nbsp;&nbsp;Logout</a></li>
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
<!-- Profile -->
<section class="profile">
    <div class="container">
        <h1 class="title-form">Profile</h1>
            <div class="form">
                <label class="form-label">Nama Lengkap</label><br>
                <div class="form-text"><?php echo $_SESSION['nama_lengkap']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Username</label><br>
                <div class="form-text"><?php echo $_SESSION['username']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Role</label><br>
                <div class="form-text"><?php echo $_SESSION['role']; ?></div>
            </div>
            <?php
            $jobdesc = $_SESSION['job_desc'];
            if($_SESSION['role'] == 'Admin') {
                echo "<div class='form'>
                        <label class='form-label'>Job Description</label><br>
                        <div class='form-text'>$jobdesc</div>
                    </div>";
            }
            ?>
            <div class="form">
                <label class="form-label">Bergabung pada tanggal</label><br>
                <div class="form-text"><?php echo $_SESSION['tgl_buat']; ?></div>
            </div>
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
          var header = document.querySelector("header.navbar-top");
          header.classList.toggle("sticky", window.scrollY > 0);
        })

        window.addEventListener("scroll", function(){
          var header = document.querySelector("header.nav-top-mg");
          header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>