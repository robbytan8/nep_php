<?php
include_once '../util/DBUtil.php';
include_once '../db_function/func_org.php';

$nama = filter_input(INPUT_POST, 'nm');
header('Content-type: application/json');
$returnData = array();
if (isset($nama) && trim($nama) != '') {
    addOrgData($nama);
    $returnData['status'] = 1;
    $returnData['message'] = 'Data berhasil dimasukkan';
} else {
    $returnData['status'] = 0;
    $returnData['message'] = 'Data tidak lengkap';
}
echo json_encode($returnData);
