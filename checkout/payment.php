<?php

require '../config/config.php';
if(!isset($_SESSION['login'])) {
    $_SESSION['loginDahulu'] = true;
    header("Location: ../auth/login.php");
}

$idTransaction = $_GET['id'];
$queryTransaction = queryTransaction("SELECT * FROM tbl_order WHERE id = $idTransaction");

if(!isset($_GET['id'])) {
    header("Location: ../user/transaction.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/payment.css?v=<?php echo time(); ?>">
    <title>Cafe Kinton | Receipt</title>
</head>
<body>
<!-- Tabel -->
<section class="tabel">
    <div class="table-container">
        <h1 class="heading">Price Receipt</h1>
        <p class="date"><?php echo date("j F Y"); ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Customer</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Tgl Transaksi</th>
                    <th>Pembayaran</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($queryTransaction as $dataTransaction) : ?>
                <tr>
                    <td data-label="Nama Customer"><?= $dataTransaction['nama_customer']; ?></td>
                    <td data-label="Menu"><?= $dataTransaction['nama_product']; ?></td>
                    <td data-label="Quantity"><?= $dataTransaction['quantity']; ?></td>
                    <td data-label="Total Harga">Rp <?= number_format($dataTransaction['total_harga']); ?></td>
                    <td data-label="Tgl Transaksi"><?= $dataTransaction['tgl_transaksi']; ?></td>
                    <td data-label="Pembayaran"><?= $dataTransaction['payment_method']; ?></td>
                    <td data-label="Alamat">
                        <textarea disabled>
                            <?= $dataTransaction['alamat']; ?>
                        </textarea>
                    </td>
                    <td data-label="Opsi" id="opsi">
                        <button onclick="window.print()" class="btn-print"><i class="fas fa-print"></i>&nbsp;&nbsp;Print</button>
                        <a href="../user/transaction.php" class="btn-back"><i class="fas fa-chevron-circle-left"></i>&nbsp;&nbsp;Back</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h5>Cafe Kinton by KintonDev</h5>
    </div>
</section>
<!-- Tabel -->
</body>
</html>