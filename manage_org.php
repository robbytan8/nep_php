<?php
$perintah = filter_input(INPUT_GET, 'com');
if (isset($perintah) && $perintah == 'del') {
    $id = filter_input(INPUT_GET, 'i');
    deleteOrgData($id);
}

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $nama = filter_input(INPUT_POST, 'txtNama');
    addOrgData($nama);
}
?>

<form class="" method="post">
    <fieldset>
        <legend>Input Organisasi</legend>
        <div class="row-input">
            <label for="txtNamaId">Nama</label>
            <input id="txtNamaId" type="text" name="txtNama" autofocus placeholder="e.g. BPD" required class="form-input">
        </div>
        <div class="">
            <input type="submit" name="btnSubmit" value="Simpan" class="button button-primary">
        </div>
    </fieldset>
</form>

<table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = getOrgData();
        foreach ($result as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['id'] . "</td>";
            echo "<td>" . $value['nama'] . "</td>";
            echo "<td><button onclick='deleteOrg(" . $value['id'] . ");'>Hapus</button></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
