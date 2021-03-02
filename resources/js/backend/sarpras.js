import { sarpras } from "./module/sarpras_module";

$(function () {
    sarpras.dataTable();
    sarpras.addSarpras();
    sarpras.changeFile("formAddSarpras", "thumbnail-sarpras");
    sarpras.changeFile("formEditSarpras", "thumb-sarpras");
    sarpras.deleteSarpras();
    sarpras.editSarpras();

    $("#sync-sarpras").on("click", function () {
        $("#tableSarpras").DataTable().ajax.reload();
    });
});
