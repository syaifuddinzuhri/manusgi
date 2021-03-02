import { handle } from "./handle_module";
class User {
    dataTable() {
        handle.setup();
        $("#tableUsers").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/user",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "level",
                    render: function (data) {
                        if (data == 1) {
                            return "Super Admin";
                        } else {
                            return "Admin";
                        }
                    },
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

    addUser() {
        handle.setup();
        $("#formAddUser").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password",
                },
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Nama tidak boleh kosong",
                },
                email: {
                    required: "Email tidak boleh kosong",
                    email: "Email tidak valid",
                },
                password: {
                    required: "Password tidak boleh kosong",
                    minlength: "Password minimal berisi 8 karakter",
                },
                password_confirmation: {
                    required: "Password tidak boleh kosong",
                    minlength: "Password minimal berisi 8 karakter",
                    equalTo: "Password tidak sama",
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
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    _token: $("input[name=_token]").val(),
                };

                if (handle.checkEmail(data["email"])) {
                    $.ajax({
                        url: APP_URL + "/admin/user",
                        type: "POST",
                        data: data,
                        beforeSend: function () {
                            $(
                                "#formAddUser > .row > .btn_group > .btn-loading"
                            ).show();
                            $(
                                "#formAddUser > .row > .btn_group > .btn-submit"
                            ).hide();
                        },
                        success: function (res) {
                            $(
                                "#formAddUser > .row > .btn_group > .btn-loading"
                            ).hide();
                            $(
                                "#formAddUser > .row > .btn_group > .btn-submit"
                            ).show();
                            if (res) {
                                $("#tableUsers").DataTable().ajax.reload();
                                $("#formAddUser")[0].reset();
                                $("#addUserModal").modal("hide");
                                toastr.success(
                                    "Data user berhasil ditambahkan!"
                                );
                            }
                        },
                        error: (e, x, settings, exception) => {
                            $(
                                "#formAddUser > .row > .btn_group > .btn-loading"
                            ).hide();
                            $(
                                "#formAddUser > .row > .btn_group > .btn-submit"
                            ).show();
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                } else {
                    $("#formAddUser > .row > .btn_group > .btn-loading").hide();
                    $("#formAddUser > .row > .btn_group > .btn-submit").show();
                    toastr.error("Gunakan email (gmail.com | yahoo.com)");
                }
            },
        });
    }

    updateData() {
        handle.setup();
        $("#formEditDataUser").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                name: {
                    required: true,
                },
                level: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Nama tidak boleh kosong",
                },
                level: {
                    required: "Pilih salah satu level",
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
            submitHandler: function () {
                var data = {
                    id: $("#id").val(),
                    name: $("#name").val(),
                    email: $("#email").val(),
                    level: $("#level").val(),
                    _token: $("input[name=_token]").val(),
                };

                if (handle.checkEmail(data["email"])) {
                    $.ajax({
                        url: APP_URL + "/admin/user/update-data",
                        type: "PUT",
                        data: data,
                        beforeSend: function () {
                            $("#formEditDataUser > .btn-loading").show();
                            $("#formEditDataUser > .btn-submit").hide();
                        },
                        success: function (res) {
                            $("#formEditDataUser > .btn-loading").hide();
                            $("#formEditDataUser > .btn-submit").show();

                            if (res) {
                                if (res == "failed") {
                                    toastr.error("Level tidak tersedia!");
                                } else {
                                    $("#id").val(res.id);
                                    $("#name").val(res.name);
                                    $("#email").val(res.email);
                                    $("#level").val(res.level);
                                    toastr.success(
                                        "Data user berhasil di update!"
                                    );
                                }
                            }
                        },
                        error: (e, x, settings, exception) => {
                            $("#formEditDataUser > .btn-loading").hide();
                            $("#formEditDataUser > .btn-submit").show();
                            var msg = "Update data gagal";
                            handle.errorhandle(e, x, settings, exception, msg);
                        },
                    });
                } else {
                    $("#formEditDataUser > .btn-loading").hide();
                    $("#formEditDataUser > .btn-submit").show();
                    toastr.error("Gunakan email (gmail.com | yahoo.com)");
                }
            },
        });
    }

    updatePassword() {
        handle.setup();
        $("#formUbahPassword").validate({
            rules: {
                password1: {
                    required: true,
                    minlength: 8,
                },
                password2: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password1",
                },
            },
            messages: {
                password1: {
                    required: "Password tidak boleh kosong",
                    minlength: "Password minimal berisi 8 karakter",
                },
                password2: {
                    required: "Password tidak boleh kosong",
                    minlength: "Password minimal berisi 8 karakter",
                    equalTo: "Password tidak sama",
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
                    id: $("#id2").val(),
                    password: $("#password1").val(),
                    _token: $("input[name=_token]").val(),
                };

                $.ajax({
                    url: APP_URL + "/admin/user/update-password",
                    type: "PUT",
                    data: data,
                    beforeSend: function () {
                        $("#formUbahPassword > .btn-loading").show();
                        $("#formUbahPassword > .btn-submit").hide();
                    },
                    success: function (res) {
                        $("#formUbahPassword > .btn-loading").hide();
                        $("#formUbahPassword > .btn-submit").show();

                        if (res) {
                            $("#formUbahPassword")[0].reset();
                            toastr.success("Ubah password berhasil!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $("#formUbahPassword > .btn-loading").hide();
                        $("#formUbahPassword > .btn-submit").show();
                        var msg = "Ubah password gagal";
                        handle.errorhandle(e, x, settings, exception, msg);
                    },
                });
            },
        });
    }

    deleteUser() {
        handle.setup();
        var sid = "";
        $("#tableUsers").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeleteUser").on("submit", function (e) {
            var url = "/admin/user/" + sid;
            var form = $(this);

            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > .btn-loading"
                    ).show();
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > #formDeleteUser > .btn-submit"
                    ).hide();
                },
                success: function (res) {
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > .btn-loading"
                    ).hide();
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > #formDeleteUser > .btn-submit"
                    ).show();
                    if (res) {
                        $("#tableUsers").DataTable().ajax.reload();
                        $("#deleteUserModal").modal("hide");
                        toastr.success("Data user berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > .btn-loading"
                    ).hide();
                    $(
                        "#deleteUserModal > .modal-dialog > .modal-content > .modal-footer > #formDeleteUser > .btn-submit"
                    ).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const user = new User();
