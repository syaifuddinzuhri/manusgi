import { sejarah } from "./module/sejarah_module";
$(document).ready(function () {
    sejarah.showSejarah();
    sejarah.summernote();
    sejarah.storeSejarah();
    sejarah.changeFile();
    sejarah.uploadThumbnail();

    $("#edit-sejarah").hide();
    $("#btn-kembali-sejarah").hide();

    $("#btn-edit-sejarah").on("click", function () {
        $("#show-sejarah").hide();
        $("#edit-sejarah").show();
        $("#btn-edit-sejarah").hide();
        $("#btn-kembali-sejarah").show();
    });

    $("#btn-kembali-sejarah").on("click", function () {
        $("#show-sejarah").show();
        $("#edit-sejarah").hide();
        $("#btn-edit-sejarah").show();
        $("#btn-kembali-sejarah").hide();
        sejarah.showSejarah();
    });

    $("#delete-thumbnail-sejarah").on("click", function () {
        var url = $("#delete-thumbnail-sejarah").data("url");
        sejarah.deleteThumbnail(url);
        sejarah.showSejarah();
    });
});
