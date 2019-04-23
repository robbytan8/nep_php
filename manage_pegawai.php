<?php
$perintah = filter_input(INPUT_GET, 'com');
if (isset($perintah) && $perintah == 'del') {
    $id = filter_input(INPUT_GET, 'i');
    deletePegData($id);
}

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $nip = filter_input(INPUT_POST, 'txtNip');
    $fName = filter_input(INPUT_POST, 'txtNamaDepan');
    $lName = filter_input(INPUT_POST, 'txtNamaBelakang');
    $gender = filter_input(INPUT_POST, 'radioGender');
    $org = filter_input(INPUT_POST, 'comboOrg');
    addPegData($nip, $fName, $lName, $gender, $org);
}
?>

<form class="" method="post">
    <fieldset>
        <legend>Input Pegawai</legend>
        <div class="row-form">
            <label for="txtNipId" class="form-label">NIP</label>
            <input id="txtNipId" type="text" name="txtNip" autofocus placeholder="e.g. 123456789012" required maxlength="12" class="form-input">
        </div>
        <div class="row-form">
            <label for="txtNamaDepanId" class="form-label">Nama Depan</label>
            <input id="txtNamaDepanId" type="text" name="txtNamaDepan" placeholder="e.g. Johan" required class="form-input">
        </div>
        <div class="row-form">
            <label for="txtNamaBelakangId" class="form-label">Nama Belakang</label>
            <input id="txtNamaBelakang" type="text" name="txtNamaBelakang" placeholder="e.g. Kusmono" class="form-input">
        </div>
        <div class="row-form">
            <label for="txtNamaId" class="form-label">Jenis Kelamin</label>
            <input type="radio" name="radioGender" value="0" checked>Wanita
            <input type="radio" name="radioGender" value="1">Pria
        </div>
        <div class="row-form">
            <label for="comboOrgId" class="form-label">Organisasi</label>
            <select id="comboOrgId" class="form-input" name="comboOrg">
                <?php
                $result = getOrgData();
                foreach ($result as $key => $value) {
                    echo "<option value=" . $value['id'] . ">" . $value['nama'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="">
            <input type="submit" name="btnSubmit" value="Simpan" class="button button-primary">
        </div>
    </fieldset>
</form>

<table  id="myTable" class="display">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Organisasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = getPegData();
        foreach ($result as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['nip'] . "</td>";
            echo "<td>" . $value['nama_lengkap'] . "</td>";
            echo "<td>";
            echo $value['jenis_kelamin'] ? "Pria" : "Wanita";
            echo "</td>";
            echo "<td>" . $value['nama'] . "</td>";
            echo "<td><button onclick='deletePeg(" . $value['nip'] . ");'>Hapus</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
