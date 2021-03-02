import { handle } from "./handle_module";

class Pendidik {
    dataTable() {
        handle.setup();
        $("#tablePendidik").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/pendidik",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "foto",
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
                    data: "jabatan",
                    name: "jabatan",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "telepon",
                    name: "telepon",
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

    changeFile(form, input, preview) {
        $("#" + input).on("change", function (e) {
            e.preventDefault();

            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("#" + form + " label[for='customFile']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#" + preview).attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    addPendidik() {
        handle.setup();
        $("#formAddPendidik").validate({
            rules: {
                nama: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                },
                email: {
                    required: "Email tidak boleh kosong",
                    email: "Email tidak valid",
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
                var data = {
                    nama: $("#nama").val(),
                    email: $("#email").val(),
                    jabatan: $("#jabatan").val(),
                    nohp: $("#nohp").val(),
                };
                var file = $("#foto")[0].files;
                const pd = new Pendidik();

                if (handle.checkEmail(data["email"])) {
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
                            pd._storePendidik(form);
                        }
                    } else {
                        pd._storePendidik(form);
                    }
                } else {
                    toastr.error("Gunakan email (gmail.com | yahoo.com)");
                }
            },
        });
    }

    _storePendidik(form) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/pendidik",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#formAddPendidik").find($(".btn-loading")).show();
                $("#formAddPendidik").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formAddPendidik").find($(".btn-loading")).hide();
                $("#formAddPendidik").find($(".btn-submit")).show();
                if (res) {
                    $("#tablePendidik").DataTable().ajax.reload();
                    $("#formAddPendidik")[0].reset();
                    $("#addPendidikModal").modal("hide");
                    toastr.success("Data berhasil ditambahkan!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formAddPendidik").find($(".btn-loading")).hide();
                $("#formAddPendidik").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    editDataPendidik() {
        handle.setup();
        $("#formEditDataPendidik").validate({
            rules: {
                nama: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong.",
                },
                email: {
                    required: "Email tidak boleh kosong",
                    email: "Email tidak valid",
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
                var data = {
                    id: $("#id").val(),
                    nama: $("#nama").val(),
                    email: $("#email").val(),
                    jabatan: $("#jabatan").val(),
                    nohp: $("#nohp").val(),
                };
                const pdd = new Pendidik();

                if (handle.checkEmail(data["email"])) {
                    pdd._updateDataPendidik(data, data["id"]);
                } else {
                    toastr.error("Gunakan email (gmail.com | yahoo.com)");
                }
            },
        });
    }

    _updateDataPendidik(data, id) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/pendidik/" + id,
            type: "PUT",
            data: data,
            beforeSend: function () {
                $("#formEditDataPendidik").find($(".btn-loading")).show();
                $("#formEditDataPendidik").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formEditDataPendidik").find($(".btn-loading")).hide();
                $("#formEditDataPendidik").find($(".btn-submit")).show();
                if (res) {
                    toastr.success("Data berhasil diupdate!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formEditDataPendidik").find($(".btn-loading")).hide();
                $("#formEditDataPendidik").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    editFotoPendidik() {
        handle.setup();
        $("#formEditFotoPendidik").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find("#idp2").val();
            var file = $("#foto")[0].files;
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
                        url: APP_URL + "/admin/pendidik/update-foto/" + id,
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "JSON",
                        beforeSend: function () {
                            $("#formEditFotoPendidik")
                                .find($(".btn-loading"))
                                .show();
                            $("#formEditFotoPendidik")
                                .find($(".btn-submit"))
                                .hide();
                        },
                        success: function (resp) {
                            toastr.success("Foto berhasil di update!");
                            $("#formEditFotoPendidik")
                                .find($(".btn-loading"))
                                .hide();
                            $("#formEditFotoPendidik")
                                .find($(".btn-submit"))
                                .show();
                            $(
                                "#formEditFotoPendidik label[for='customFile']"
                            ).text("Choose File");
                            $("#formEditFotoPendidik")[0].reset();
                            $("#previewFoto").attr("src", resp.foto);
                        },
                        error: (e, x, settings, exception) => {
                            $("#formEditFotoPendidik")
                                .find($(".btn-loading"))
                                .hide();
                            $("#formEditFotoPendidik")
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

    deletePendidik() {
        handle.setup();
        var sid = "";
        $("#tablePendidik").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeletePendidik").on("submit", function (e) {
            var url = "/admin/pendidik/" + sid;
            var form = $(this);

            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deletePendidikModal").find($(".btn-loading")).show();
                    $("#deletePendidikModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deletePendidikModal").find($(".btn-loading")).hide();
                    $("#deletePendidikModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tablePendidik").DataTable().ajax.reload();
                        $("#deletePendidikModal").modal("hide");
                        toastr.success("Data berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deletePendidikModal").find($(".btn-loading")).hide();
                    $("#deletePendidikModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const pendidik = new Pendidik();
