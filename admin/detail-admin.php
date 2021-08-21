<?php

require '../config/config.php';
$id = $_GET['id'];
$dataUser = queryUser("SELECT * FROM tbl_user WHERE id = $id")[0];
if(isset($_POST['ceo'])) {
    jobCEO("UPDATE tbl_user SET job_desc = 'CEO' WHERE id = $id");
}
if(isset($_POST['customer_manager'])) {
    jobCustomerManager("UPDATE tbl_user SET job_desc = 'Customer Manager' WHERE id = $id");
}
if(isset($_POST['product_manager'])) {
    jobProductManager("UPDATE tbl_user SET job_desc = 'Product Manager' WHERE id = $id");
}
if(isset($_POST['staff'])) {
    jobStaff("UPDATE tbl_user SET job_desc = 'Staff' WHERE id = $id");
}

if($_SESSION['job_desc'] == 'Customer Manager' || $_SESSION['job_desc'] == 'Product Manager' || $_SESSION['job_desc'] == 'Staff' || $_SESSION['job_desc'] == '-') {
    header("Location: ../user/user-restricted.php");
}

if(!isset($_GET['id'])) {
    header("Location: user-admin.php");
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
                <label class="form-label">Job Desc</label><br>
                <div class="form-text"><?= $dataUser['job_desc']; ?></div>
            </div>
            <div class="form">
                <label class="form-label">Bergabung pada tanggal</label><br>
                <div class="form-text"><?= $dataUser['tgl_buat']; ?></div>
            </div>
<!-- Modal Box3 -->
        <?php
        $idUser = $dataUser['id']; 
        // Owner
        if(isset($_SESSION['job_desc']) == 'Owner') {
            if($_SESSION['job_desc'] == "Owner" && $dataUser['job_desc'] == "Owner") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } else {
                    echo ""; //Dikosongkan
                }
            } elseif($_SESSION['job_desc'] == "Owner" && $dataUser['job_desc'] == "CEO") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='ceo'>CEO</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            } elseif($_SESSION['job_desc'] == "Owner" && $dataUser['job_desc'] == "Customer Manager") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='ceo'>CEO</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            } elseif($_SESSION['job_desc'] == "Owner" && $dataUser['job_desc'] == "Product Manager") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='ceo'>CEO</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            } elseif($_SESSION['job_desc'] == "Owner" && $dataUser['job_desc'] == "Staff") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='ceo'>CEO</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            }
        }
        // CEO
        if(isset($_SESSION['job_desc']) == 'CEO') {
            if($_SESSION['job_desc'] == "CEO" && $dataUser['job_desc'] == "Owner") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } else {
                    echo ""; //Dikosongkan
                }
            } elseif($_SESSION['job_desc'] == "CEO" && $dataUser['job_desc'] == "CEO") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo ""; //Dikosongkan
                }
            } elseif($_SESSION['job_desc'] == "CEO" && $dataUser['job_desc'] == "Customer Manager") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            } elseif($_SESSION['job_desc'] == "CEO" && $dataUser['job_desc'] == "Product Manager") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            } elseif($_SESSION['job_desc'] == "CEO" && $dataUser['job_desc'] == "Staff") {
                if($_SESSION['username'] == $dataUser['username']) {
                    echo ""; //Dikosongkan
                } elseif($_SESSION['username'] != $dataUser['username']) {
                    echo " <input type='checkbox' id='click3'>
                        <label for='click3' class='click-me3'><i class='fas fa-sync-alt'></i>&nbsp;&nbsp;Job Desc</label>
                        <div class='content3'>
                            <div class='header3'>
                                <h2>Job Description</h2>
                            </div>
                            <p class='modal-text3'>Silahkan pilih job description</p>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='customer_manager'>Customer Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='product_manager'>Product Manager</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' value='<?= $idUser; ?>'>
                                <button type='submit' class='btn-job' name='staff'>Staff</button>
                            </form>
                            <div class='garis3'></div>
                            <label for='click3' class='btn-tidak3'>Tutup</label>
                        </div>
                        <a href='../config/remove-admin.php?id=$idUser' class='btn-merah'><i class='fas fa-minus'></i>&nbsp;&nbsp;Admin</a><br>";
                }
            }
        }
        ?>
<!-- Modal Box3 -->
        <a class="kembali" href="user-admin.php"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali</a>
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