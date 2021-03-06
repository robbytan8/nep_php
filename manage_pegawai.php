<?php
$perintah = filter_input(INPUT_GET, 'com');
if (isset($perintah) && $perintah == 'del') {
    $id = filter_input(INPUT_GET, 'i');
    deletePegData($id);
}

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $password = filter_input(INPUT_POST, 'txtPassword');
    $rePassword = filter_input(INPUT_POST, 'txtRePassword');
    if ($password == $rePassword) {
        $nip = filter_input(INPUT_POST, 'txtNip');
        $fName = filter_input(INPUT_POST, 'txtNamaDepan');
        $lName = filter_input(INPUT_POST, 'txtNamaBelakang');
        $username = filter_input(INPUT_POST, 'txtUsername');
        $gender = filter_input(INPUT_POST, 'radioGender');
        $org = filter_input(INPUT_POST, 'comboOrg');
        $result = addPegData($nip, $fName, $lName, $username, $password, $gender, $org);
        if (isset($result) && trim($result) == '') {
            $errMsg = "Error on query or duplicate NIP";
        }
    } else {
        $errMsg = "Password dan Re-type Password tidak sama";
    }
}

if (isset($errMsg)) {
    echo "<div class='error-msg'>" . $errMsg . "</div>";
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
            <label for="txtUsernameId" class="form-label">Username</label>
            <input id="txtUsernameId" type="text" name="txtUsername" placeholder="e.g. bright1234" class="form-input">
        </div>
        <div class="row-form">
            <label for="txtPasswordId" class="form-label">Password</label>
            <input id="txtPasswordId" type="password" name="txtPassword" placeholder="e.g. password" class="form-input">
        </div>
        <div class="row-form">
            <label for="txtPasswordId" class="form-label">Re-type Password</label>
            <input id="txtPasswordId" type="password" name="txtRePassword" placeholder="e.g. re-password" class="form-input">
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
            <th>Username</th>
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
            echo "<td>" . $value['username'] . "</td>";
            echo "<td>";
            echo $value['jenis_kelamin'] ? "Pria" : "Wanita";
            echo "</td>";
            echo "<td>" . $value['nama'] . "</td>";
            echo "<td><button onclick='editPeg(" . $value['nip'] . ");'>Edit</button><button onclick='deletePeg(" . $value['nip'] . ");'>Hapus</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
