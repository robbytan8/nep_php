<?php
$nama = filter_input(INPUT_GET, 'name');
header('Content-type: application/json');
$returnData = array();
if (isset($nama) && trim($nama) != '') {
    $returnData['status'] = 1;
    $returnData['message'] = "Hello " . $nama;
} else {
    $returnData['status'] = 0;
    $returnData['message'] = "Nama tidak boleh kosong";
}
echo json_encode($returnData);
?>
