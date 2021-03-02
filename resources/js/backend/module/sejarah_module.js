import { handle } from "./handle_module";

class Sejarah {
    summernote() {
        handle.setup();
        $("#tsejarah").summernote({
            height: 300,
            callbacks: {
                onImageUpload: (file, editor, welEditable) => {
                    this.uploadImage(file[0], editor, welEditable);
                },

                onMediaDelete: (target) => {
                    var url = target[0].src;
                    this.deleteFile(url);
                },
            },
        });
    }

    uploadImage(file, editor, welEditable) {
        handle.setup();
        let data = new FormData();
        data.append("image", file);
        let urlUpload = $("#tsejarah").data("url-upload");
        $.ajax({
            data: data,
            type: "POST",
            url: urlUpload,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                // editor.insertImage(welEditable, url["image"]);
                $("#tsejarah").summernote(
                    "insertImage",
                    response.imageUrl,
                    function ($image) {
                        $image.css("max-width", "80%");
                        $image.css("margin-left", "10%");
                        $image.addClass("img-responsive");
                    }
                );
            },
        });
    }

    deleteFile(url) {
        handle.setup();
        let urlDelete = $("#tsejarah").data("url-delete");
        var src = url.split("/")[5];
        $.ajax({
            data: { srcUrl: src },
            type: "POST",
            url: urlDelete,
            success: function (response) {},
        });
    }

    storeSejarah() {
        handle.setup();
        $("#formSejarah").on("submit", function (e) {
            e.preventDefault();
            var sejarah = $("#tsejarah").val();
            var id = $("#id_sejarah").val();
            $.ajax({
                url: APP_URL + "/admin/sejarah/" + id,
                data: {
                    sejarah: sejarah,
                },
                type: "PATCH",
                beforeSend: function () {
                    $("#formSejarah > .btn-loading").show();
                    $("#formSejarah > .btn-submit").hide();
                },
                success: function (resp) {
                    $("#formSejarah > .btn-loading").hide();
                    $("#formSejarah > .btn-submit").show();
                    $("#btn-edit-sejarah").show();
                    $("#show-sejarah").show();
                    $("#edit-sejarah").hide();
                    $("#btn-kembali-sejarah").hide();

                    $("#tsejarah").html(resp.sejarah);
                    $("#body-sejarah").html(resp.sejarah).contents();
                    toastr.success("Data berhasil di update!");
                },
            });
        });
    }

    showSejarah() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: APP_URL + "/admin/sejarah",
            type: "GET",
            data: { _token: CSRF_TOKEN },
            success: function (resp) {
                $("#body-sejarah").html(resp.sejarah).contents();
                $("#tsejarah").summernote("code", resp.sejarah);
                $("#viewThumb").attr("src", resp.thumbnail);
                $("#previewThumb").attr("src", resp.thumbnail);
            },
        });
    }

    changeFile() {
        $("#thumbnailSejarah").on("change", function (e) {
            e.preventDefault();

            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("#formThumbnailSejarah label[for='customFile']").text(name);
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
        $("#formThumbnailSejarah").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find("#id_sejarah2").val();
            var file = $("#thumbnailSejarah")[0].files;
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
                        url: APP_URL + "/admin/sejarah/update-thumbnail/" + id,
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        beforeSend: function () {
                            $("#formThumbnailSejarah > .btn-loading").show();
                            $("#formThumbnailSejarah > .btn-submit").hide();
                        },
                        success: function (resp) {
                            toastr.success("Thumbnail berhasil di update!");

                            $("#formThumbnailSejarah > .btn-loading").hide();
                            $("#formThumbnailSejarah > .btn-submit").show();
                            $("#btn-edit-sejarah").show();
                            $("#show-sejarah").show();
                            $("#edit-sejarah").hide();
                            $("#btn-kembali-sejarah").hide();
                            $(
                                "#formThumbnailSejarah label[for='customFile']"
                            ).text("Choose File");
                            $("#formThumbnailSejarah")[0].reset();
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
            url: url,
            data: { _token: CSRF_TOKEN },
            success: function (response) {
                toastr.success("Thubmnail berhasil di hapus!");

                $("#btn-edit-sejarah").show();
                $("#show-sejarah").show();
                $("#edit-sejarah").hide();
                $("#btn-kembali-sejarah").hide();
            },
        });
    }
}

export const sejarah = new Sejarah();
