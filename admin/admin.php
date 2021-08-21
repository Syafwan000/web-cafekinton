<?php

require '../config/config.php';
$dataUser = queryUser("SELECT * FROM tbl_user");
$totalUser = count($dataUser);

$dataAdmin = queryUser("SELECT * FROM tbl_user WHERE role = 'Admin'");
$totalAdmin = count($dataAdmin);

$dataCustomer = queryUser("SELECT * FROM tbl_user WHERE role = 'Customer'");
$totalCustomer = count($dataCustomer);

$dataProduct = queryProduct("SELECT * FROM tbl_product");
$totalProduct = count($dataProduct);

$dataTransaction = queryTransaction("SELECT * FROM tbl_order");
$totalTransaction = count($dataTransaction);

$dataRatingPuas = queryUser("SELECT * FROM tbl_user WHERE rating = 'Puas'");
$totalRatingPuas = count($dataRatingPuas);

$dataRatingTidakPuas = queryUser("SELECT * FROM tbl_user WHERE rating = 'Tidak Puas'");
$totalRatingTidakPuas = count($dataRatingTidakPuas);

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
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
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
<!-- Dashboard -->
<h1 class="title-dashboard">Dashboard</h1>
<p class="date"><?php echo date("j F Y"); ?></p>
<div class="dashboard-wrapper">
      <div class="container-dashboard">
        <div class="dashboard">
            <div class="title">
              <h3>Total User</h3>
            </div>
            <div class="logo">
                <i class="fas fa-users"></i>
            </div>
            <div class="text">
                <p><?= $totalUser; ?></p>
            </div>
        </div>
        <div class="dashboard">
            <div class="title">
              <h3>Total Admin</h3>
            </div>
            <div class="logo">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="text">
                <p><?= $totalAdmin; ?></p>
            </div>
        </div>
        <div class="dashboard">
            <div class="title">
              <h3>Total Customer</h3>
            </div>
            <div class="logo">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="text">
                <p><?= $totalCustomer; ?></p>
            </div>
        </div>
        <div class="dashboard">
            <div class="title">
              <h3>Total Product</h3>
            </div>
            <div class="logo">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="text">
                <p><?= $totalProduct; ?></p>
            </div>
        </div>
        <div class="dashboard">
            <div class="title">
              <h3>Transaksi</h3>
            </div>
            <div class="logo">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <div class="text">
                <p><?= $totalTransaction; ?></p>
            </div>
        </div>
      </div>
    </div>
<div class="dashboard-wrapper2">
    <div class="container-dashboard2">
        <div class="dashboard2">
            <div class="title2">
                <h3>Puas</h3>
            </div>
            <div class="logo2">
                <i class="fas fa-smile"></i>
            </div>
            <div class="text2">
                <p><?= $totalRatingPuas; ?></p>
            </div>
        </div>
        <div class="dashboard2-red">
            <div class="title2">
                <h3>Tidak Puas</h3>
            </div>
            <div class="logo2">
                <i class="fas fa-frown"></i>
            </div>
            <div class="text2">
                <p><?= $totalRatingTidakPuas; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard -->
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