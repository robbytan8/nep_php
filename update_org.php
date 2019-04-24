<?php
$id = filter_input(INPUT_GET, 'i');
$org = getOneOrgData($id);

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $nama = filter_input(INPUT_POST, 'txtNama');
    updateOrgData($id, $nama);
    header('location:index.php?mn=org');
}
?>

<form class="" method="post">
    <fieldset>
        <legend>Ubah Organisasi</legend>
        <div class="row-input">
            <label for="txtNamaId">Nama</label>
            <input id="txtNamaId" type="text" name="txtNama" autofocus placeholder="e.g. BPD" required class="form-input" value="<?php echo $org['rname']; ?>">
        </div>
        <div class="">
            <input type="submit" name="btnSubmit" value="Update" class="button button-primary">
        </div>
    </fieldset>
</form>
