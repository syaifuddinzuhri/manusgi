import { pendidik } from "./module/pendidik_module";

$(document).ready(function () {
    var pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/admin/pendidik") {
        pendidik.dataTable();
        pendidik.addPendidik();
        pendidik.changeFile("formAddPendidik", "foto", "previewFoto");
        pendidik.deletePendidik();
        $("#sync-pendidik").on("click", function () {
            $("#tablePendidik").DataTable().ajax.reload();
        });
    }

    if (splitURL.pop() == "edit") {
        pendidik.changeFile("formEditFotoPendidik", "foto", "previewFoto");
        pendidik.editDataPendidik();
        pendidik.editFotoPendidik();
    }
});
