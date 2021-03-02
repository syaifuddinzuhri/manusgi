import { handle } from "./handle_module";

class Prestasi {
    dataTable() {
        handle.setup();
        $("#tablePrestasi").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/prestasi",
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
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "publisher",
                    name: "publisher",
                },
                {
                    data: "created_at",
                    name: "created_at",
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
        let urlUpload = $("#keterangan").data("url-upload");
        $.ajax({
            data: data,
            type: "POST",
            url: urlUpload,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#keterangan").summernote(
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
        let urlDelete = $("#keterangan").data("url-delete");
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
                    $("#previewThumbPrestasi").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    addPrestasi() {
        handle.setup();
        $("#form-create-prestasi").validate({
            ignore: ":hidden:not(#keterangan),.note-editable.card-block",
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama prestasi tidak boleh kosong.",
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
                const p = new Prestasi();
                var file = $("#thumbnailPrestasi")[0].files;
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
                        p._storePrestasi(form);
                    }
                } else {
                    p._storePrestasi(form);
                }
            },
        });
    }

    _storePrestasi(form) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/prestasi",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#form-create-prestasi").find($(".btn-loading")).show();
                $("#form-create-prestasi").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#form-create-prestasi").find($(".btn-loading")).hide();
                $("#form-create-prestasi").find($(".btn-submit")).show();
                if (res) {
                    $("#form-create-prestasi")[0].reset();
                    window.location.assign("/admin/prestasi");
                    toastr.success("Pengumuman berhasil ditambahkan!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#form-create-prestasi").find($(".btn-loading")).hide();
                $("#form-create-prestasi").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    updatePrestasi() {
        handle.setup();
        $("#form-edit-prestasi").validate({
            ignore: ":hidden:not(#keterangan),.note-editable.card-block",
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama prestasi tidak boleh kosong.",
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
                var id = $("#idp").val();
                $.ajax({
                    url: APP_URL + "/admin/prestasi/" + id,
                    type: "PUT",
                    data: {
                        nama: $("#nama").val(),
                        keterangan: $("#keterangan").val(),
                    },
                    beforeSend: function () {
                        $("#form-edit-prestasi").find($(".btn-loading")).show();
                        $("#form-edit-prestasi").find($(".btn-submit")).hide();
                    },
                    success: function (res) {
                        $("#form-edit-prestasi").find($(".btn-loading")).hide();
                        $("#form-edit-prestasi").find($(".btn-submit")).show();
                        if (res) {
                            $("#form-edit-prestasi")[0].reset();
                            toastr.success("Pengumuman berhasil diupdate!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $("#form-edit-prestasi").find($(".btn-loading")).hide();
                        $("#form-edit-prestasi").find($(".btn-submit")).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    updateThumbnail() {
        handle.setup();
        $("#form-edit-thumbnail").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find("#idp2").val();
            var file = $("#updateThumbnailPrestasi")[0].files;
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
                        url: APP_URL + "/admin/prestasi/update-thumbnail/" + id,
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
                            $("#previewThumbPrestasi").attr(
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

    deletePrestasi() {
        handle.setup();
        var sid = "";
        $("#tablePrestasi").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeletePrestasi").on("submit", function (e) {
            var url = "/admin/prestasi/" + sid;
            var form = $(this);
            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deletePrestasiModal").find($(".btn-loading")).show();
                    $("#deletePrestasiModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deletePrestasiModal").find($(".btn-loading")).hide();
                    $("#deletePrestasiModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tablePrestasi").DataTable().ajax.reload();
                        $("#deletePrestasiModal").modal("hide");
                        toastr.success("Prestasi berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deletePrestasiModal").find($(".btn-loading")).hide();
                    $("#deletePrestasiModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const prestasi = new Prestasi();
