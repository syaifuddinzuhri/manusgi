import { handle } from "./handle_module";

class Kategori {
    dataTable() {
        handle.setup();
        $("#tableKategori").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/kategori",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    width: "8%",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    addKategori() {
        handle.setup();
        $("#form-add-kategori").validate({
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama kategori tidak boleh kosong",
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
            submitHandler: function () {
                var data = {
                    nama: $("#nama").val(),
                    _token: $("input[name=_token]").val(),
                };
                $.ajax({
                    type: "POST",
                    url: APP_URL + "/admin/kategori",
                    data: data,
                    beforeSend: function () {
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-loading"
                        ).show();
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-submit"
                        ).hide();
                    },
                    success: function (res) {
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-submit"
                        ).show();
                        if (res) {
                            if (res["error"]) {
                                toastr.error("Kategori sudah ada!");
                            }
                            $("#tableKategori").DataTable().ajax.reload();
                            $("#form-add-kategori")[0].reset();
                            $("#addKategoriModal").modal("hide");
                            toastr.success("Kategori berhasil ditambahkan!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-add-kategori > .row > .btn_group > .btn-submit"
                        ).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    editKategori() {
        handle.setup();

        var id = "";
        $("#tableKategori").on("click", ".edit-kategori", function () {
            id = $(this).closest("tr").attr("id");
            var data = $(this)
                .closest("tr")
                .find("td")
                .map(function () {
                    return $(this).text();
                });
            $("#nama2").val(data[1]);
        });

        $("#form-edit-kategori").validate({
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama kategori tidak boleh kosong",
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
            submitHandler: function () {
                $.ajax({
                    type: "PATCH",
                    url: APP_URL + "/admin/kategori/" + id,
                    data: {
                        nama: $("#nama2").val(),
                    },
                    beforeSend: function () {
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-loading"
                        ).show();
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-submit"
                        ).hide();
                    },
                    success: function (res) {
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-submit"
                        ).show();
                        if (res) {
                            $("#tableKategori").DataTable().ajax.reload();
                            $("#form-edit-kategori")[0].reset();
                            $("#editKategoriModal").modal("hide");
                            toastr.success("Kategori berhasil diupdate!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-edit-kategori > .row > .btn_group > .btn-submit"
                        ).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    deleteKategori() {
        handle.setup();
        var id = "";
        $("#tableKategori").on("click", ".delete", function () {
            id = $(this).closest("tr").attr("id");
        });

        $("#formDeleteKategori").on("submit", function (e) {
            var url = "/admin/kategori/" + id;
            var form = $(this);
            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteKategoriModal .btn-loading").show();
                    $("#deleteKategoriModal .btn-submit").hide();
                },
                success: function (res) {
                    $("#deleteKategoriModal .btn-loading").hide();
                    $("#deleteKategoriModal .btn-submit").show();
                    if (res) {
                        $("#tableKategori").DataTable().ajax.reload();
                        $("#deleteKategoriModal").modal("hide");
                        toastr.success("Data user berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteKategoriModal .btn-loading").hide();
                    $("#deleteKategoriModal .btn-submit").show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const kategori = new Kategori();
