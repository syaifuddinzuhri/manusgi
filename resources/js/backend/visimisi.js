import { visimisi } from "./module/visimisi_module";
$(document).ready(function () {
    visimisi.summernote();
    visimisi.showVisiMisi();
    visimisi.changeFile();
    visimisi.uploadThumbnail();
    visimisi.storeVisiMisi();

    $("#edit-visimisi").hide();
    $("#btn-kembali-visimisi").hide();

    $("#btn-edit-visimisi").on("click", function () {
        $("#show-visimisi").hide();
        $("#edit-visimisi").show();
        $("#btn-edit-visimisi").hide();
        $("#btn-kembali-visimisi").show();
    });

    $("#btn-kembali-visimisi").on("click", function () {
        $("#show-visimisi").show();
        $("#edit-visimisi").hide();
        $("#btn-edit-visimisi").show();
        $("#btn-kembali-visimisi").hide();
        visimisi.showVisiMisi();
    });

    $("#delete-thumbnail-visimisi").on("click", function () {
        var url = $("#delete-thumbnail-visimisi").data("url");
        visimisi.deleteThumbnail(url);
        visimisi.showVisiMisi();
    });
});
