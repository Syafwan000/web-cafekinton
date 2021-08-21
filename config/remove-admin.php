<?php

require 'config.php';
$idUser = $_GET['id'];

function removeAdmin($idUser) {
    global $koneksi;

    $query = "UPDATE tbl_user SET role = 'Customer', job_desc = '-' WHERE id = $idUser";
    mysqli_query($koneksi, $query);
    if(isset($idUser)) {
        $_SESSION['removeAdmin'] = true;
        header("Location: ../admin/user-customer.php");
    }
    return mysqli_affected_rows($koneksi);
}

removeAdmin($idUser);

?>