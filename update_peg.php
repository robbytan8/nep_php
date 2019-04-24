<?php
$id = filter_input(INPUT_GET, 'i');
$pegawai = getOnePegData($id);

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $password = filter_input(INPUT_POST, 'txtPassword');
    $rePassword = filter_input(INPUT_POST, 'txtRePassword');
    if ($password == '' && $rePassword == '') {
        $nip = filter_input(INPUT_POST, 'txtNip');
        $fName = filter_input(INPUT_POST, 'txtNamaDepan');
        $lName = filter_input(INPUT_POST, 'txtNamaBelakang');
        $username = filter_input(INPUT_POST, 'txtUsername');
        $gender = filter_input(INPUT_POST, 'radioGender');
        $org = filter_input(INPUT_POST, 'comboOrg');
        updatePegData($nip, $fName, $lName, $username, $pegawai['password'], $gender, $org);
        header("location:index.php?mn=peg");
    } elseif ($password == $rePassword) {
        $nip = filter_input(INPUT_POST, 'txtNip');
        $fName = filter_input(INPUT_POST, 'txtNamaDepan');
        $lName = filter_input(INPUT_POST, 'txtNamaBelakang');
        $username = filter_input(INPUT_POST, 'txtUsername');
        $gender = filter_input(INPUT_POST, 'radioGender');
        $org = filter_input(INPUT_POST, 'comboOrg');
        updatePegData($nip, $fName, $lName, $username, $password, $gender, $org);
        header("location:index.php?mn=peg");
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
            <input id="txtNipId" type="text" name="txtNip" autofocus placeholder="e.g. 123456789012" required maxlength="12" class="form-input" readonly value="<?php echo $pegawai['nip']; ?>">
        </div>
        <div class="row-form">
            <label for="txtNamaDepanId" class="form-label">Nama Depan</label>
            <input id="txtNamaDepanId" type="text" name="txtNamaDepan" placeholder="e.g. Johan" required class="form-input" value="<?php echo $pegawai['nama_depan']; ?>">
        </div>
        <div class="row-form">
            <label for="txtNamaBelakangId" class="form-label">Nama Belakang</label>
            <input id="txtNamaBelakang" type="text" name="txtNamaBelakang" placeholder="e.g. Kusmono" class="form-input" value="<?php echo $pegawai['nama_belakang']; ?>">
        </div>
        <div class="row-form">
            <label for="txtUsernameId" class="form-label">Username</label>
            <input id="txtUsernameId" type="text" name="txtUsername" placeholder="e.g. bright1234" class="form-input" value="<?php echo $pegawai['username']; ?>">
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
            <input type="radio" name="radioGender" value="0" <?php echo $pegawai['jenis_kelamin'] == 0 ? "checked" : ""; ?>>Wanita
            <input type="radio" name="radioGender" value="1" <?php echo $pegawai['jenis_kelamin'] == 1 ? "checked" : ""; ?>>Pria
        </div>
        <div class="row-form">
            <label for="comboOrgId" class="form-label">Organisasi</label>
            <select id="comboOrgId" class="form-input" name="comboOrg">
                <?php
                $result = getOrgData();
                foreach ($result as $key => $value) {
                    if ($pegawai['tb_organisasi_id'] == $value['id']) {
                        echo "<option value=" . $value['id'] . "selected>" . $value['nama'] . "</option>";
                    } else {
                        echo "<option value=" . $value['id'] . ">" . $value['nama'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="">
            <input type="submit" name="btnSubmit" value="Update" class="button button-primary">
        </div>
    </fieldset>
</form>
