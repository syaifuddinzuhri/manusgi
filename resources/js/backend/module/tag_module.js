import { handle } from "./handle_module";

class Tag {
    dataTable() {
        handle.setup();
        $("#tableTag").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/tag",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "tag",
                    name: "tag",
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

    addTag() {
        handle.setup();
        $("#form-add-tag").validate({
            rules: {
                tag: {
                    required: true,
                },
            },
            messages: {
                tag: {
                    required: "Tag tidak boleh kosong",
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
                    tag: $("#tag").val(),
                    _token: $("input[name=_token]").val(),
                };
                $.ajax({
                    type: "POST",
                    url: APP_URL + "/admin/tag",
                    data: data,
                    beforeSend: function () {
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-loading"
                        ).show();
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-submit"
                        ).hide();
                    },
                    success: function (res) {
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-submit"
                        ).show();
                        if (res) {
                            if (res["error"]) {
                                toastr.error("tag sudah ada!");
                            }
                            $("#tableTag").DataTable().ajax.reload();
                            $("#form-add-tag")[0].reset();
                            $("#addTagModal").modal("hide");
                            toastr.success("Tag berhasil ditambahkan!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-add-tag > .row > .btn_group > .btn-submit"
                        ).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    editTag() {
        handle.setup();

        var id = "";
        $("#tableTag").on("click", ".edit-tag", function () {
            id = $(this).closest("tr").attr("id");
            var data = $(this)
                .closest("tr")
                .find("td")
                .map(function () {
                    return $(this).text();
                });
            $("#tag2").val(data[1]);
        });

        $("#form-edit-tag").validate({
            rules: {
                tag: {
                    required: true,
                },
            },
            messages: {
                tag: {
                    required: "Tag tidak boleh kosong",
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
                    url: APP_URL + "/admin/tag/" + id,
                    data: {
                        tag: $("#tag2").val(),
                    },
                    beforeSend: function () {
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-loading"
                        ).show();
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-submit"
                        ).hide();
                    },
                    success: function (res) {
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-submit"
                        ).show();
                        if (res) {
                            $("#tableTag").DataTable().ajax.reload();
                            $("#form-edit-tag")[0].reset();
                            $("#editTagModal").modal("hide");
                            toastr.success("Tag berhasil diupdate!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-loading"
                        ).hide();
                        $(
                            "#form-edit-tag > .row > .btn_group > .btn-submit"
                        ).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    deleteTag() {
        handle.setup();
        var id = "";
        $("#tableTag").on("click", ".delete", function () {
            id = $(this).closest("tr").attr("id");
        });

        $("#formDeleteTag").on("submit", function (e) {
            var url = "/admin/tag/" + id;
            var form = $(this);
            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteTagModal .btn-loading").show();
                    $("#deleteTagModal .btn-submit").hide();
                },
                success: function (res) {
                    $("#deleteTagModal .btn-loading").hide();
                    $("#deleteTagModal .btn-submit").show();
                    if (res) {
                        $("#tableTag").DataTable().ajax.reload();
                        $("#deleteTagModal").modal("hide");
                        toastr.success("Tag berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteTagModal .btn-loading").hide();
                    $("#deleteTagModal .btn-submit").show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const tag = new Tag();
