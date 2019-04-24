<?php
function getPegData() {
    $connection = createMySQLConnection();
    $query = "SELECT p.nip, CONCAT(p.nama_depan, ' ', COALESCE(p.nama_belakang, '')) AS nama_lengkap, p.username, p.jenis_kelamin, o.nama FROM tb_pegawai p JOIN tb_organisasi o ON p.tb_organisasi_id = o.id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    mysqli_close($connection);
    return $result;
}

function getOnePegData($nip) {
    $connection = createMySQLConnection();
    $query = "SELECT * FROM tb_pegawai WHERE nip = ? LIMIT 1";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "s", $nip);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $data;
}

function addPegData($nip, $namaDepan, $namaBelakang, $username, $password, $gender, $org) {
    $connection = createMySQLConnection();
    $query = "INSERT INTO tb_pegawai(nip, nama_depan, nama_belakang, username, password, jenis_kelamin, tb_organisasi_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
    if (strlen(trim($namaBelakang)) == 0) {
        $namaBelakang = NULL;
    }
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "sssssii", $nip, $namaDepan, $namaBelakang, $username, $password, $gender, $org);
        $result = mysqli_stmt_execute($stmt);
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $result;
}

function updatePegData($nip, $namaDepan, $namaBelakang, $username, $password, $gender, $org) {
    $connection = createMySQLConnection();
    $query = "UPDATE tb_pegawai SET nama_depan = ?, nama_belakang = ?, username = ?, password = ?, jenis_kelamin = ?, tb_organisasi_id = ? WHERE nip = ?";
    if (strlen(trim($namaBelakang)) == 0) {
        $namaBelakang = NULL;
    }
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "ssssiis", $namaDepan, $namaBelakang, $username, $password, $gender, $org, $nip);
        $result = mysqli_stmt_execute($stmt);
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $result;
}

function checkDuplicateNip($nip) {
    $connection = createMySQLConnection();
    $query = "SELECT 1 AS ada FROM tb_pegawai WHERE nip = ?";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "s", $nip);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $result;
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

function login($username, $password) {
    $connection = createMySQLConnection();
    $query = "SELECT nip, nama_depan, nama_belakang FROM tb_pegawai WHERE username = ? AND password = ? LIMIT 1";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_stmt_bind_result($stmt, $returnNip, $returnFName, $returnLName);
        mysqli_stmt_fetch($stmt);
        $result = array('rnip' => $returnNip, 'rfname' => $returnFName, 'rlname' => $returnLName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $result;
}
