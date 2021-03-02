import { user } from "./module/user_module";

$(document).ready(function () {
    $(".btn-close").click(function () {
        $("#formAddUser")[0].reset();
    });

    const pathURL = document.location.pathname;
    if (pathURL == "/admin/user" || pathURL == "/admin/user/") {
        user.dataTable();

        $("#sync-user").on("click", function () {
            $("#tableUsers").DataTable().ajax.reload();
        });
    }
    user.addUser();
    user.deleteUser();
    user.updateData();
    user.updatePassword();
});
