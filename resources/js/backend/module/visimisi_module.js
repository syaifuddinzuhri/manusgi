import { handle } from "./handle_module";
class VisiMisi {
    summernote() {
        handle.setup();
        $("#tvisi").summernote({
            height: 200,
        });
        $("#tmisi").summernote({
            height: 200,
        });
    }

    showVisiMisi() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: APP_URL + "/admin/visi-misi",
            type: "GET",
            data: { _token: CSRF_TOKEN },
            success: function (resp) {
                $("#body-visi").html(resp.visi).contents();
                $("#body-misi").html(resp.misi).contents();
                $("#tvisi").summernote("code", resp.visi);
                $("#tmisi").summernote("code", resp.misi);
                $("#viewThumb").attr("src", resp.thumbnail);
                $("#previewThumb").attr("src", resp.thumbnail);
            },
        });
    }

    storeVisiMisi() {
        $("#formVisiMisi").on("submit", function (e) {
            handle.setup();
            e.preventDefault();
            var visi = $("#tvisi").val();
            var misi = $("#tmisi").val();
            var id = $("#id_visimisi").val();
            $.ajax({
                url: APP_URL + "/admin/visi-misi/" + id,
                data: {
                    visi: visi,
                    misi: misi,
                },
                type: "PUT",
                beforeSend: function () {
                    $(".formVisiMisi > .btn-loading").show();
                    $(".formVisiMisi > .btn-submit").hide();
                },
                success: function (resp) {
                    $(".formVisiMisi > .btn-loading").hide();
                    $(".formVisiMisi > .btn-submit").show();
                    $("#btn-edit-visimisi").show();
                    $("#show-visimisi").show();
                    $("#edit-visimisi").hide();
                    $("#btn-kembali-visimisi").hide();

                    $("#tvisi").summernote("code", resp.visi);
                    $("#tmisi").summernote("code", resp.misi);
                    $("#body-visi").html(resp.visi).contents();
                    $("#body-misi").html(resp.misi).contents();
                    toastr.success("Data berhasil di update!");
                },
            });
        });
    }

    changeFile() {
        $("#thumbnailVisimisi").on("change", function (e) {
            e.preventDefault();
            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("#formThumbnailVisiMisi label[for='customFile']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#previewThumb").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    uploadThumbnail() {
        handle.setup();
        $("#formThumbnailVisiMisi").on("submit", function (e) {
            e.preventDefault();
            var file = $("#thumbnailVisimisi")[0].files;
            if (file.length > 0) {
                var fileExtension = ["jpeg", "jpg", "png"];
                var getExtension = file[0]["name"]
                    .split(".")
                    .pop()
                    .toLowerCase();
                var getSize = file[0]["size"];
                if ($.inArray(getExtension, fileExtension) == -1) {
                    toastr.error(
                        "Format gambar harus berupa : " +
                            fileExtension.join(", ")
                    );
                } else if (getSize > 5000000) {
                    toastr.error("Ukuran gambar maksmimum 5mb");
                } else {
                    $.ajax({
                        url: APP_URL + "/admin/visi-misi/update-thumbnail",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        beforeSend: function () {
                            $("#formThumbnailVisiMisi > .btn-loading").show();
                            $("#formThumbnailVisiMisi > .btn-submit").hide();
                        },
                        success: function (resp) {
                            $("#formThumbnailVisiMisi > .btn-loading").hide();
                            $("#formThumbnailVisiMisi > .btn-submit").show();

                            toastr.success("Thubmnail berhasil di update!");

                            $("#btn-edit-visimisi").show();
                            $("#show-visimisi").show();
                            $("#edit-visimisi").hide();
                            $("#btn-kembali-visimisi").hide();
                            $(
                                "#formThumbnailVisiMisi label[for='customFile']"
                            ).text("Choose File");
                            $("#formThumbnailVisiMisi")[0].reset();
                            $("#viewThumb").attr("src", resp.thumbnail);
                        },
                    });
                }
            } else {
                toastr.error("File tidak boleh kosong!");
            }
        });
    }

    deleteThumbnail(url) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "DELETE",
            url: APP_URL + url,
            data: { _token: CSRF_TOKEN },
            success: function (response) {
                toastr.success("Thubmnail berhasil di hapus!");

                $("#btn-edit-visimisi").show();
                $("#show-visimisi").show();
                $("#edit-visimisi").hide();
                $("#btn-kembali-visimisi").hide();
            },
        });
    }
}

export const visimisi = new VisiMisi();
