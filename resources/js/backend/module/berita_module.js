import { handle } from "./handle_module";

class Berita {
    dataTable() {
        handle.setup();
        $("#tableBerita").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/berita",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "thumbnail",
                    className: "text-center",
                    render: function (data) {
                        if (data != null) {
                            return (
                                '<img src="' +
                                data +
                                '" class="img-responsive" style="width: 50px"/>'
                            );
                        } else {
                            return "";
                        }
                    },
                },
                {
                    data: "judul",
                    name: "judul",
                },
                {
                    data: "created_at",
                    name: "created_at",
                },
                {
                    data: "publisher",
                    name: "publisher",
                },
                {
                    data: "kategori",
                    name: "kategori",
                },
                {
                    data: "tag",
                    name: "tag",
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    summernote(input) {
        handle.setup();
        $("#" + input).summernote({
            height: 300,
            callbacks: {
                onImageUpload: (file, editor, welEditable) => {
                    this.uploadImage(input, file[0], editor, welEditable);
                },

                onMediaDelete: (target) => {
                    var url = target[0].src;
                    this.deleteFile(input, url);
                },
            },
        });
    }

    uploadImage(input, file, editor, welEditable) {
        handle.setup();
        let data = new FormData();
        data.append("image", file);
        let urlUpload = $("#" + input).data("url-upload");
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
                $("#" + input).summernote(
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

    deleteFile(input, url) {
        handle.setup();
        let urlDelete = $("#" + input).data("url-delete");
        var src = url.split("/")[5];
        $.ajax({
            data: { srcUrl: src },
            type: "POST",
            url: urlDelete,
            success: function (response) {},
        });
    }

    changeFile(form, input) {
        $("#" + input).on("change", function (e) {
            e.preventDefault();

            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("#" + form + " label[for='customFile']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#previewThumbBerita").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    storeBerita() {
        handle.setup();
        $("#form-create-berita").validate({
            ignore: ":hidden:not(#isi-berita),.note-editable.card-block",
            rules: {
                judul: {
                    required: true,
                },
                kategori: {
                    required: true,
                },
                file: {
                    required: true,
                    extension: "jpg|jpeg|png",
                },
            },
            messages: {
                judul: {
                    required: "Judul tidak boleh kosong.",
                },
                kategori: {
                    required: "Pilih salah satu kategori.",
                },
                file: {
                    required: "Thumbnail tidak boleh kosong.",
                },
            },
            errorElement: "span",
            errorPlacement: (error, element) => {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass("is-invalid");
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function (form) {
                if ($("#isiberita").summernote("isEmpty")) {
                    toastr.error("Isi berita harus diisi");
                } else {
                    var file = $("#thumbnailBerita")[0].files;
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
                            var formData = new FormData(form);
                            formData.append("tags", $(".mul-select").val());
                            $.ajax({
                                type: "POST",
                                url: APP_URL + "/admin/berita",
                                processData: false,
                                contentType: false,
                                cache: false,
                                data: formData,
                                beforeSend: function () {
                                    $("#form-create-berita")
                                        .find($(".btn-loading"))
                                        .show();
                                    $("#form-create-berita")
                                        .find($(".btn-submit"))
                                        .hide();
                                },
                                success: function (response) {
                                    $("#form-create-berita")
                                        .find($(".btn-loading"))
                                        .hide();
                                    $("#form-create-berita")
                                        .find($(".btn-submit"))
                                        .show();
                                    window.location.assign("/admin/berita");
                                    toastr.success(
                                        "Berita baru berhasil ditambahkan!"
                                    );
                                },
                                error: (e, x, settings, exception) => {
                                    $("#form-create-berita")
                                        .find($(".btn-loading"))
                                        .hide();
                                    $("#form-create-berita")
                                        .find($(".btn-submit"))
                                        .show();
                                    handle.errorhandle(
                                        e,
                                        x,
                                        settings,
                                        exception
                                    );
                                },
                            });
                        }
                    } else {
                        toastr.error("File tidak boleh kosong!");
                    }
                }
            },
        });
    }

    updateBerita() {
        handle.setup();
        $("#form-edit-berita").validate({
            ignore: ":hidden:not(#isi-berita2),.note-editable.card-block",
            rules: {
                judul2: {
                    required: true,
                },
                kategori2: {
                    required: true,
                },
            },
            messages: {
                judul2: {
                    required: "Judul tidak boleh kosong.",
                },
                kategori2: {
                    required: "Pilih salah satu kategori.",
                },
            },
            errorElement: "span",
            errorPlacement: (error, element) => {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: (element, errorClass, validClass) => {
                $(element).addClass("is-invalid");
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function (form) {
                if ($("#isiberita2").summernote("isEmpty")) {
                    toastr.error("Isi berita harus diisi");
                } else {
                    var id = $("#idb").val();
                    var updateData = {
                        judul: $("#judul2").val(),
                        isi: $("#isiberita2").val(),
                        kategori: $("#kategori2").val(),
                    };
                    $.ajax({
                        type: "PUT",
                        url: APP_URL + "/admin/berita/" + id,
                        data: updateData,
                        beforeSend: function () {
                            $("#form-edit-berita")
                                .find($(".btn-loading"))
                                .show();
                            $("#form-edit-berita")
                                .find($(".btn-submit"))
                                .hide();
                        },
                        success: function (response) {
                            $("#form-edit-berita")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-berita")
                                .find($(".btn-submit"))
                                .show();
                            $("#judul2").val(response.judul);
                            $("#isiberita").text(response.isi);

                            toastr.success("Berita berhasil diedit");
                        },
                        error: (e, x, settings, exception) => {
                            $("#form-edit-berita")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-berita")
                                .find($(".btn-submit"))
                                .show();
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                }
            },
        });
    }

    updateThumbnail() {
        handle.setup();
        $("#form-edit-thumbnail").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find("#idb2").val();
            var file = $("#updateThumbnailBerita")[0].files;
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
                        url: APP_URL + "/admin/berita/update-thumbnail/" + id,
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        beforeSend: function () {
                            $("#form-edit-thumbnail")
                                .find($(".btn-loading"))
                                .show();
                            $("#form-edit-thumbnail")
                                .find($(".btn-submit"))
                                .hide();
                        },
                        success: function (resp) {
                            toastr.success("Thumbnail berhasil di update!");
                            $("#form-edit-thumbnail")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-thumbnail")
                                .find($(".btn-submit"))
                                .show();
                            $(
                                "#form-edit-thumbnail label[for='customFile']"
                            ).text("Choose File");
                            $("#form-edit-thumbnail")[0].reset();
                            $("#previewThumbBerita").attr(
                                "src",
                                resp.thumbnail
                            );
                        },
                        error: (e, x, settings, exception) => {
                            $("#form-edit-thumbnail")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-thumbnail")
                                .find($(".btn-submit"))
                                .show();
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                }
            } else {
                toastr.error("File tidak boleh kosong!");
            }
        });
    }

    updateTags() {
        handle.setup();
        $("#form-edit-tags").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find($("#idb3")).val();
            var tags = $(this).find($("#edit-tag")).val();
            $.ajax({
                type: "PUT",
                url: APP_URL + "/admin/berita/update-tags/" + id,
                data: {
                    id: id,
                    tags: tags,
                },
                beforeSend: function () {
                    $("#form-edit-tags").find($(".btn-loading")).show();
                    $("#form-edit-tags").find($(".btn-submit")).hide();
                },
                success: function (resp) {
                    toastr.success("Tag berita berhasil di update!");
                    $("#form-edit-tags").find($(".btn-loading")).hide();
                    $("#form-edit-tags").find($(".btn-submit")).show();
                },
                error: (e, x, settings, exception) => {
                    $("#form-edit-tags").find($(".btn-loading")).hide();
                    $("#form-edit-tags").find($(".btn-submit")).show();
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        });
    }

    showTags(id) {
        handle.setup();
        $.ajax({
            type: "GET",
            url: APP_URL + "/admin/berita/get-tags/" + id,
            data: {
                id: id,
            },
            success: function (response) {
                $.each(response, function (i, e) {
                    $("#edit-tag option[value='" + e + "']")
                        .prop("selected", true)
                        .trigger("change");
                });
            },
        });
    }

    deleteBerita() {
        handle.setup();
        var sid = "";
        $("#tableBerita").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeleteBerita").on("submit", function (e) {
            var url = APP_URL + "/admin/berita/" + sid;
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteBeritaModal").find($(".btn-loading")).show();
                    $("#deleteBeritaModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deleteBeritaModal").find($(".btn-loading")).hide();
                    $("#deleteBeritaModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tableBerita").DataTable().ajax.reload();
                        $("#deleteBeritaModal").modal("hide");
                        toastr.success("Berita berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteBeritaModal").find($(".btn-loading")).hide();
                    $("#deleteBeritaModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const berita = new Berita();
