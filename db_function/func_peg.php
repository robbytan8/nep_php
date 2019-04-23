<?php
function getPegData() {
    $connection = createMySQLConnection();
    $query = "SELECT p.nip, CONCAT(p.nama_depan, ' ', COALESCE(p.nama_belakang, '')) AS nama_lengkap, p.jenis_kelamin, o.nama FROM tb_pegawai p JOIN tb_organisasi o ON p.tb_organisasi_id = o.id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    mysqli_close($connection);
    return $result;
}

function addPegData($nip, $namaDepan, $namaBelakang, $gender, $org) {
    $connection = createMySQLConnection();
    $query = "INSERT INTO tb_pegawai(nip, nama_depan, nama_belakang, jenis_kelamin, tb_organisasi_id) VALUES(?, ?, ?, ?, ?)";
    if (strlen(trim($namaBelakang)) == 0) {
        $namaBelakang = NULL;
    }
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "sssii", $nip, $namaDepan, $namaBelakang, $gender, $org);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
}

function deletePegData($id) {
    $connection = createMySQLConnection();
    $query = "DELETE FROM tb_pegawai WHERE nip = ?";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
}
