import { handle } from "./handle_module";

class Sarpras {
    dataTable() {
        handle.setup();
        $("#tableSarpras").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/sarpras",
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
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
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
                    $("#previewThumbSarpras").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    addSarpras() {
        handle.setup();
        $("#formAddSarpras").validate({
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama sarana & prasarana tidak boleh kosong.",
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
                const s = new Sarpras();
                var file = $("#thumbnail-sarpras")[0].files;
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
                        s._storeSarpras(form);
                    }
                } else {
                    s._storeSarpras(form);
                }
            },
        });
    }

    _storeSarpras(form) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/sarpras",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#formAddSarpras").find($(".btn-loading")).show();
                $("#formAddSarpras").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formAddSarpras").find($(".btn-loading")).hide();
                $("#formAddSarpras").find($(".btn-submit")).show();
                if (res) {
                    $("#formAddSarpras")[0].reset();
                    $("#tableSarpras").DataTable().ajax.reload();
                    $("#addSarprasModal").modal("hide");
                    $("#formAddSarpras label[for='customFile']").text(
                        "Choose File"
                    );
                    toastr.success("Sarana & Prasarana berhasil ditambahkan!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formAddSarpras").find($(".btn-loading")).hide();
                $("#formAddSarpras").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    deleteSarpras() {
        handle.setup();
        var sid = "";
        $("#tableSarpras").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeleteSarpras").on("submit", function (e) {
            var url = "/admin/sarpras/" + sid;
            var form = $(this);
            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteSarprasModal").find($(".btn-loading")).show();
                    $("#deleteSarprasModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deleteSarprasModal").find($(".btn-loading")).hide();
                    $("#deleteSarprasModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tableSarpras").DataTable().ajax.reload();
                        $("#deleteSarprasModal").modal("hide");
                        toastr.success("Sarana & prasarana berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteSarprasModal").find($(".btn-loading")).hide();
                    $("#deleteSarprasModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

    editSarpras() {
        handle.setup();
        var id = "";
        $("#tableSarpras").on("click", ".edit-sarpras", function () {
            id = $(this).closest("tr").attr("id");
            var data = $(this)
                .closest("tr")
                .find("td")
                .map(function () {
                    return $(this).text();
                });
            $("#formEditSarpras").find($("#nama2")).val(data[2]);
        });

        $("#formEditSarpras").validate({
            rules: {
                nama2: {
                    required: true,
                },
            },
            messages: {
                nama2: {
                    required: "Nama sarana & prasarana tidak boleh kosong",
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
                const sar = new Sarpras();
                var file = $("#thumb-sarpras")[0].files;
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
                        $("#formEditSarpras")
                            .find($("input[name='_method']"))
                            .val("POST");
                        sar._updateThumbnail(form, id);
                    }
                } else {
                    sar._updateSarpras(id);
                }
            },
        });
    }

    _updateThumbnail(form, id) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/sarpras/update-thumbnail/" + id,
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#formEditSarpras").find($(".btn-loading")).show();
                $("#formEditSarpras").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formEditSarpras").find($(".btn-loading")).hide();
                $("#formEditSarpras").find($(".btn-submit")).show();
                if (res) {
                    $("#tableSarpras").DataTable().ajax.reload();
                    $("#formEditSarpras")[0].reset();
                    $("#editSarprasModal").modal("hide");
                    toastr.success("Sarana & prasarana berhasil diupdate!");
                    $("#formEditSarpras label[for='customFile']").text(
                        "Choose File"
                    );
                }
            },
            error: (e, x, settings, exception) => {
                $("#formEditSarpras").find($(".btn-loading")).hide();
                $("#formEditSarpras").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    _updateSarpras(id) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/sarpras/" + id,
            type: "PUT",
            data: {
                nama: $("#nama2").val(),
            },
            beforeSend: function () {
                $("#formEditSarpras").find($(".btn-loading")).show();
                $("#formEditSarpras").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formEditSarpras").find($(".btn-loading")).hide();
                $("#formEditSarpras").find($(".btn-submit")).show();
                if (res) {
                    $("#tableSarpras").DataTable().ajax.reload();
                    $("#formEditSarpras")[0].reset();
                    $("#editSarprasModal").modal("hide");
                    $("#formEditSarpras label[for='customFile']").text(
                        "Choose File"
                    );
                    toastr.success("Sarana & prasarana berhasil diupdate!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formEditSarpras").find($(".btn-loading")).hide();
                $("#formEditSarpras").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }
}
export const sarpras = new Sarpras();
