import { prestasi } from "./module/prestasi_module";

$(document).ready(function () {
    var pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/admin/prestasi/create") {
        prestasi.addPrestasi();
        prestasi.summernote("keterangan");
        prestasi.changeFile("form-create-prestasi", "thumbnailPrestasi");
    }

    if (pathURL == "/admin/prestasi") {
        prestasi.dataTable();
        prestasi.deletePrestasi();

        $("#sync-prestasi").on("click", function () {
            $("#tablePrestasi").DataTable().ajax.reload();
        });
    }

    if (splitURL.pop() == "edit") {
        prestasi.summernote("keterangan");
        prestasi.changeFile("form-edit-thumbnail", "updateThumbnailPrestasi");
        prestasi.updatePrestasi();
        prestasi.updateThumbnail();
    }
});
