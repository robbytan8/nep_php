<?php
include_once '../util/DBUtil.php';
include_once '../db_function/func_org.php';

header('Content-type: application/json');
$returnData = array();
$result = getOrgData();
if (isset($result)) {
    $returnData['status'] = 1;
    $returnData['message'] = 'Data Organisasi';
    $organizations = array();
    foreach ($result as $key => $value) {
        array_push($organizations, $value);
    }
    $returnData['data'] = $organizations;
} else {
    $returnData['status'] = 0;
    $returnData['message'] = 'Data tidak lengkap';
    $returnData['data'] = "";
}

echo json_encode($returnData);
