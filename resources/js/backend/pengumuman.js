import { pengumuman } from "./module/pengumuman_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;

    const splitURL = pathURL.split("/");

    if (pathURL == "/admin/pengumuman" || pathURL == "/admin/pengumuman/") {
        pengumuman.dataTable();
        pengumuman.deletePengumuman();

        $("#sync-pengumuman").on("click", function () {
            $("#tablePengumuman").DataTable().ajax.reload();
        });
    }

    if (pathURL == "/admin/pengumuman/create") {
        pengumuman.addPengumuman();
        pengumuman.changeFile("formAddPengumuman", "file-pengumuman");
        pengumuman.summernote("keterangan-pengumuman");
    }

    if (splitURL.pop() == "edit") {
        pengumuman.changeFile("formEditPengumuman", "file-pengumuman2");
        pengumuman.summernote("keterangan-pengumuman2");
        pengumuman.editPengumuman();
    }
});
