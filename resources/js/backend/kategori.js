import { kategori } from "./module/kategori_module";

$(document).ready(function () {
    kategori.dataTable();
    kategori.editKategori();
    kategori.addKategori();
    kategori.deleteKategori();

    $("#sync-kategori").on("click", function () {
        $("#tableKategori").DataTable().ajax.reload();
    });
});
