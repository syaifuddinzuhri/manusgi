import { tag } from "./module/tag_module";

$(document).ready(function () {
    tag.dataTable();
    tag.editTag();
    tag.addTag();
    tag.deleteTag();

    $("#sync-tag").on("click", function () {
        $("#tableTag").DataTable().ajax.reload();
    });
});
