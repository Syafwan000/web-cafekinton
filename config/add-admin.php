<?php

require 'config.php';
$idUser = $_GET['id'];

function addAdmin($idUser) {
    global $koneksi;

    $query = "UPDATE tbl_user SET role = 'Admin', job_desc = 'Staff' WHERE id = $idUser";
    mysqli_query($koneksi, $query);
    if(isset($idUser)) {
        $_SESSION['addAdmin'] = true;
        header("Location: ../admin/user-admin.php");
    }
    return mysqli_affected_rows($koneksi);
}

addAdmin($idUser);

?>