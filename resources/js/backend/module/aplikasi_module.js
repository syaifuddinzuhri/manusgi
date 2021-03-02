import { handle } from "./handle_module";

class Aplikasi {
    changeFile(form, input) {
        $("#" + input).on("change", function (e) {
            e.preventDefault();

            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("#" + form + " label[for='customFile']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#previewLogo").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    updateLogo() {
        handle.setup();
        $("#form-logo").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find("#idapp").val();
            var file = $("#file-logo")[0].files;
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
                        url: APP_URL +"/admin/aplikasi/update-logo/" + id,
                        type: "POST",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: new FormData(this),
                        beforeSend: function () {
                            $("#form-logo").find($(".btn-loading")).show();
                            $("#form-logo").find($(".btn-submit")).hide();
                        },
                        success: function (res) {
                            $("#form-logo").find($(".btn-loading")).hide();
                            $("#form-logo").find($(".btn-submit")).show();
                            if (res) {
                                $("#form-logo")[0].reset();
                                $("#previewLogo").attr("src", res.logo);
                                $("#form-logo label[for='customFile']").text(
                                    "Choose File"
                                );
                                toastr.success("Logo berhasil diupdate!");
                            }
                        },
                        error: (e, x, settings, exception) => {
                            $("#form-logo").find($(".btn-loading")).hide();
                            $("#form-logo").find($(".btn-submit")).show();
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                }
            } else {
                toastr.error("File tidak boleh kosong.");
            }
        });
    }

    updateDataAplikasi() {
        handle.setup();
        $("#form-edit-data-aplikasi").validate({
            rules: {
                nama: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                telepon: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                },
                alamat: {
                    required: "Alamat tidak boleh kosong.",
                },
                email: {
                    required: "Email tidak boleh kosong.",
                    email: "Email tidak valid",
                },
                telepon: {
                    required: "Telepon tidak boleh kosong.",
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
                var id = $("#idapp2").val();
                var data = {
                    nama: $("#nama").val(),
                    email: $("#email").val(),
                    alamat: $("#alamat").val(),
                    telepon: $("#telepon").val(),
                    deskripsi: $("#deskripsi").val(),
                    keyword: $("#keyword").val(),
                    _token: $("input[name=_token]").val(),
                };

                if (handle.checkEmail(data["email"])) {
                    $.ajax({
                        url: APP_URL +"/admin/aplikasi/" + id,
                        type: "PUT",
                        data: data,
                        beforeSend: function () {
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-loading"))
                                .show();
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-submit"))
                                .hide();
                        },
                        success: function (res) {
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-submit"))
                                .show();
                            if (res) {
                                $("#form-edit-data-aplikasi")[0].reset();
                                $("#editAplikasiModal").modal("hide");
                                toastr.success(
                                    "Data aplikasi berhasil diupdate!"
                                );
                                window.location.assign("/admin/aplikasi");
                            }
                        },
                        error: (e, x, settings, exception) => {
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-loading"))
                                .hide();
                            $("#form-edit-data-aplikasi")
                                .find($(".btn-submit"))
                                .show();
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                } else {
                    $("#form-edit-data-aplikasi")
                        .find($(".btn-loading"))
                        .hide();
                    $("#form-edit-data-aplikasi").find($(".btn-submit")).show();
                    toastr.error("Gunakan email (gmail.com | yahoo.com)");
                }
            },
        });
    }

    updateSosmed() {
        handle.setup();
        $("#form-edit-sosmed").on("submit", function (e) {
            e.preventDefault();
            var id = $("#idapp3").val();
            var data = {
                facebook: $("#facebook").val(),
                instagram: $("#instagram").val(),
                twitter: $("#twitter").val(),
                youtube: $("#youtube").val(),
                _token: $("input[name=_token]").val(),
            };
            $.ajax({
                type: "PUT",
                url: APP_URL +"/admin/aplikasi/update-sosmed/" + id,
                data: data,
                beforeSend: function () {
                    $("#form-edit-sosmed").find($(".btn-loading")).show();
                    $("#form-edit-sosmed").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#form-edit-sosmed").find($(".btn-loading")).hide();
                    $("#form-edit-sosmed").find($(".btn-submit")).show();
                    if (res) {
                        $("#form-edit-sosmed")[0].reset();
                        $("#editSosmedModal").modal("hide");
                        toastr.success("Data sosial media berhasil diupdate!");
                        window.location.assign("/admin/aplikasi");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#form-edit-sosmed").find($(".btn-loading")).hide();
                    $("#form-edit-sosmed").find($(".btn-submit")).show();
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        });
    }
}

export const aplikasi = new Aplikasi();
