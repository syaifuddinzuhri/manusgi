import { berita } from "./module/berita_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/admin/berita" || pathURL == "/admin/berita/") {
        berita.dataTable();
        berita.deleteBerita();
        $("#sync-berita").on("click", function () {
            $("#tableBerita").DataTable().ajax.reload();
        });
    }

    if (pathURL == "/admin/berita/create") {
        berita.summernote("isiberita");
        berita.changeFile("form-create-berita", "thumbnailBerita");
        berita.storeBerita();
        $("#tag").select2({
            placeholder: "Pilih tag",
            tags: true,
            allowClear: true,
            theme: "bootstrap",
            tokenSeparators: ["/", ",", ";", " "],
            createTag: function () {
                return null;
            },
        });
    }

    if (splitURL.pop() == "edit") {
        var id = pathURL.split("/")[3];
        berita.summernote("isiberita2");
        // berita.changeFile("form-edit-berita", "thumbnailBerita");
        berita.changeFile("form-edit-thumbnail", "updateThumbnailBerita");
        berita.updateBerita();
        berita.updateThumbnail();
        berita.showTags(id);
        berita.updateTags();

        $("#edit-tag").select2({
            placeholder: "Pilih tag",
            tags: true,
            allowClear: true,
            theme: "bootstrap",
            tokenSeparators: ["/", ",", ";", " "],
            createTag: function () {
                return null;
            },
        });
    }
});
