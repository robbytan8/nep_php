<?php
function getOrgData() {
    $connection = createMySQLConnection();
    $query = "SELECT * FROM tb_organisasi ORDER BY nama ASC";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    mysqli_close($connection);
    return $result;
}

function getOneOrgData($id) {
    $connection = createMySQLConnection();
    $query = "SELECT * FROM tb_organisasi WHERE id = ? LIMIT 1";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_stmt_bind_result($stmt, $returnId, $returnName);
        mysqli_stmt_fetch($stmt);
        $result = array('rid' => $returnId, 'rname' => $returnName);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
    return $result;
}

function addOrgData($nama) {
    $connection = createMySQLConnection();
    $query = "INSERT INTO tb_organisasi(nama) VALUES (?)";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "s", $nama);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
}

function deleteOrgData($id) {
    $connection = createMySQLConnection();
    $query = "DELETE FROM tb_organisasi WHERE id = ?";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
}

function updateOrgData($id, $name) {
    $connection = createMySQLConnection();
    $query = "UPDATE tb_organisasi SET nama = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($connection, $query) or die(mysqli_error($connection))) {
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt) or die(mysqli_error($connection));
        mysqli_commit($connection);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($connection);
}
