import { jurusan } from "./module/jurusan_module";

$(function () {
    jurusan.dataTable();
    jurusan.addJurusan();
    jurusan.changeFile("formAddJurusan", "thumbnail-jurusan");
    jurusan.changeFile("formEditJurusan", "thumb-jurusan");
    jurusan.deleteJurusan();
    jurusan.editJurusan();

    $("#sync-jurusan").on("click", function () {
        $("#tableJurusan").DataTable().ajax.reload();
    });
});
