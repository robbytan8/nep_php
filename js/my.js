function deleteOrg(id) {
    var konfirmasi = window.confirm("Apakah Anda yakin mau menghapus data ini?");
    if (konfirmasi) {
        window.location = "index.php?mn=org&com=del&i=" + id;
    }
}

function editOrg(id) {
    window.location = "index.php?mn=orgu&i=" + id;
}

function deletePeg(id) {
    var konfirmasi = window.confirm("Apakah Anda yakin mau menghapus data ini?");
    if (konfirmasi) {
        window.location = "index.php?mn=peg&com=del&i=" + id;
    }
}

function editPeg(id) {
    window.location = "index.php?mn=pegu&i=" + id;
}
