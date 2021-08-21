<?php

session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_cafe";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

function register($dataUser) {
    global $koneksi;

    $nama_lengkap = stripslashes(htmlspecialchars($dataUser['nama_lengkap']));
    $username = strtolower(stripslashes(htmlspecialchars($dataUser['username'])));
    $password = mysqli_real_escape_string($koneksi, $dataUser['password']);
    $password2 = mysqli_real_escape_string($koneksi, $dataUser['password2']);
    $tgl_buat = htmlspecialchars($dataUser['tgl_buat']);
    $status = htmlspecialchars($dataUser['status']);
    $role = htmlspecialchars($dataUser['role']);
    $job_desc = htmlspecialchars($dataUser['job_desc']);
    $rating = htmlspecialchars($dataUser['rating']);

    // Cek username
    $hasil = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($hasil)) {
        $_SESSION['cekusername'] = true;
        return false;
    }
    // Cek konfirmasi password
    if($password !== $password2) {
        $_SESSION['cekpassword'] = true;
        return false;
    }
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Input ke database
    mysqli_query($koneksi, "INSERT INTO tbl_user VALUES ('', '$nama_lengkap' , '$username', '$password', '$tgl_buat', '$status', '$role', '$job_desc', '$rating')");
    return mysqli_affected_rows($koneksi);
}

function queryUser($queryUser) {
    global $koneksi;

    $hasil = mysqli_query($koneksi, $queryUser);
    $tampungBaris = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $tampungBaris[] = $baris;
    }
    return $tampungBaris;
}

function pencarianCustomer($kataKunci) {
    global $koneksi;

    $queryPencarian = "SELECT * FROM tbl_user WHERE
                    nama_lengkap LIKE '%$kataKunci%' AND role = 'Customer' OR
                    username LIKE '%$kataKunci%' AND role = 'Customer' OR
                    tgl_buat LIKE '%$kataKunci%' AND  role = 'Customer' OR
                    role LIKE '%$kataKunci%' AND role = 'Customer' ORDER BY status = 'Aktif' DESC";
    return queryUser($queryPencarian);
}

function pencarianAdmin($kataKunci2) {
    global $koneksi;

    $queryPencarian2 = "SELECT * FROM tbl_user WHERE
                    nama_lengkap LIKE '%$kataKunci2%' AND role = 'Admin' OR
                    username LIKE '%$kataKunci2%' AND role = 'Admin' OR
                    tgl_buat LIKE '%$kataKunci2%' AND  role = 'Admin' OR
                    role LIKE '%$kataKunci2%' AND role = 'Admin' OR
                    job_desc LIKE '%$kataKunci2%' AND role = 'Admin'";
    return queryUser($queryPencarian2);
}

function pencarianProduct($kataKunci3) {
    global $koneksi;

    $queryPencarian3 = "SELECT * FROM tbl_product WHERE
                    nama_product LIKE '%$kataKunci3%' OR
                    harga LIKE '%$kataKunci3%' OR
                    tgl_tambah LIKE '%$kataKunci3%' OR
                    terjual LIKE '%$kataKunci3%'";
    return queryProduct($queryPencarian3);
}

function disable($disableUser) {
    global $koneksi;

    mysqli_query($koneksi, $disableUser);
    if(isset($disableUser)) {
        $_SESSION['disable'] = true;
        header("Location: ../admin/user-customer.php");
    }
    return mysqli_affected_rows($koneksi);
}

function enable($enableUser) {
    global $koneksi;

    mysqli_query($koneksi, $enableUser);
    if(isset($enableUser)) {
        $_SESSION['enable'] = true;
        header("Location: ../admin/user-customer.php");
    }
    return mysqli_affected_rows($koneksi);
}

function jobCEO($job_ceo) {
    global $koneksi;

    mysqli_query($koneksi, $job_ceo);
    if(isset($job_ceo)) {
        $_SESSION['jobCEO'] = true;
        header("Location: ../admin/user-admin.php");
    }
    return mysqli_affected_rows($koneksi);
}

function jobCustomerManager($job_CustomerManager) {
    global $koneksi;

    mysqli_query($koneksi, $job_CustomerManager);
    if(isset($job_CustomerManager)) {
        $_SESSION['jobCustomerManager'] = true;
        header("Location: ../admin/user-admin.php");
    }
    return mysqli_affected_rows($koneksi);
}

function jobProductManager($job_ProductManager) {
    global $koneksi;

    mysqli_query($koneksi, $job_ProductManager);
    if(isset($job_ProductManager)) {
        $_SESSION['jobProductManager'] = true;
        header("Location: ../admin/user-admin.php");
    }
    return mysqli_affected_rows($koneksi);
}

function jobStaff($job_Staff) {
    global $koneksi;

    mysqli_query($koneksi, $job_Staff);
    if(isset($job_Staff)) {
        $_SESSION['jobStaff'] = true;
        header("Location: ../admin/user-admin.php");
    }
    return mysqli_affected_rows($koneksi);
}

function queryProduct($queryProduct) {
    global $koneksi;

    $hasil = mysqli_query($koneksi, $queryProduct);
    $tampungBaris = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $tampungBaris[] = $baris;
    }
    return $tampungBaris;
}

function tambahProduk($dataProduk) {
	global $koneksi;

	$nama_product = htmlspecialchars($dataProduk['nama_product']);
	$harga = htmlspecialchars($dataProduk['harga']);
	$tgl_tambah = htmlspecialchars($dataProduk['tgl_tambah']);
	$terjual = htmlspecialchars($dataProduk['terjual']);
	$deskripsi = htmlspecialchars($dataProduk['deskripsi']);

    $gambar = uploadGambar();
    if(!$gambar) {
        if(isset($_SESSION['bukanGambar'])) {
            $_SESSION['bukanGambarConfirm'] = true;
            return false;
        }
        if(isset($_SESSION['ukuranGambar'])) {
            $_SESSION['ukuranGambarConfirm'] = true;
            return false;
        }
    }

	$queryProduk = "INSERT INTO tbl_product VALUES ('', '$gambar', '$nama_product', '$harga', '$tgl_tambah', '$terjual', '$deskripsi')";
	mysqli_query($koneksi, $queryProduk);

	return mysqli_affected_rows($koneksi);
}

function uploadGambar() {
	$namaGambar = $_FILES['gambar']['name'];
	$ukuranGambar = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaGambar);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		$_SESSION['bukanGambar'] = true;
		return false;
	}

	// cek jika ukuran gambar yang di upload
	if($ukuranGambar > 2000000) {
		$_SESSION['ukuranGambar'] = true;
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru dengan unique id
	$namaGambarBaru = uniqid();
	$namaGambarBaru .= '.';
	$namaGambarBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../uploads/' . $namaGambarBaru);

	return $namaGambarBaru;
}

function ubahProduk($dataProduk) {
	global $koneksi;

	$id = $dataProduk['id'];
	$nama_product = htmlspecialchars($dataProduk['nama_product']);
	$harga = htmlspecialchars($dataProduk['harga']);
	$tgl_tambah = htmlspecialchars($dataProduk['tgl_tambah']);
	$terjual = htmlspecialchars($dataProduk['terjual']);
	$deskripsi = htmlspecialchars($dataProduk['deskripsi']);
	$gambarLama = htmlspecialchars($dataProduk['gambarLama']);

	// cek apakah user gambar baru atau tidak
	if($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
        $gambar = uploadGambar();
	}

	$query = "UPDATE tbl_product SET gambar = '$gambar', nama_product = '$nama_product', harga = '$harga', tgl_tambah = '$tgl_tambah', terjual = '$terjual', deskripsi = '$deskripsi' WHERE id = $id";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusProduk($queryHapus) {
    global $koneksi;

    mysqli_query($koneksi, $queryHapus);
    
    return mysqli_affected_rows($koneksi);
}

function rating($dataRating) {
    global $koneksi;

    $iduser = $dataRating['iduser'];
    $rating = $dataRating['rating'];

    $queryRating = "UPDATE tbl_user SET rating = '$rating' WHERE id = $iduser";
    mysqli_query($koneksi, $queryRating);

    return mysqli_affected_rows($koneksi);
}

function orderMenu($dataOrder) {
    global $koneksi;

    $id_user = $dataOrder['id_user'];
    $id_product = $dataOrder['id_product'];
    $nama_product = htmlspecialchars($dataOrder['nama_product']);
    $harga_satuan = $dataOrder['harga_satuan'];
    $nama_customer = htmlspecialchars($dataOrder['nama_customer']);
    $alamat = htmlspecialchars($dataOrder['alamat']);
    $quantity = $dataOrder['quantity'];
    $payment_method = htmlspecialchars($dataOrder['payment_method']);
    $tgl_transaksi = htmlspecialchars($dataOrder['tgl_transaksi']);

    $total_harga = ($harga_satuan * $quantity);

    $queryOrder = "INSERT INTO tbl_order VALUES ('', '$id_user', '$id_product', '$nama_product', '$harga_satuan', '$nama_customer', '$alamat', '$quantity', '$total_harga', '$payment_method', '$tgl_transaksi')";
    mysqli_query($koneksi, $queryOrder);

    return mysqli_affected_rows($koneksi);
}

function tambahTerjual($dataTerjual) {
    global $koneksi;

    $idProduct = $dataTerjual['id_product'];
    $terjual = $dataTerjual['terjual'];
    $quantity = $dataTerjual['quantity'];

    $tambahTerjual = ($terjual + $quantity);
    $queryTerjual = ("UPDATE tbl_product SET terjual = '$tambahTerjual' WHERE id = $idProduct");
    mysqli_query($koneksi, $queryTerjual);

    return mysqli_affected_rows($koneksi);
}

function queryTransaction($queryTransaction) {
    global $koneksi;

    $hasil = mysqli_query($koneksi, $queryTransaction);
    $tampungBaris = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $tampungBaris[] = $baris;
    }
    return $tampungBaris;
}

function pencarianTransaction($kataKunci4) {
    global $koneksi;

    $queryPencarian4 = "SELECT * FROM tbl_order WHERE
                    nama_customer LIKE '%$kataKunci4%' OR
                    nama_product LIKE '%$kataKunci4%' OR
                    quantity LIKE '%$kataKunci4%' OR
                    total_harga LIKE '%$kataKunci4%' OR
                    tgl_transaksi LIKE '%$kataKunci4%'";
    return queryTransaction($queryPencarian4);
}

?>