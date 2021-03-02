import { handle } from "./handle_module";

class Pengumuman {
    dataTable() {
        handle.setup();
        $("#tablePengumuman").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/pengumuman",
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
            }
        });
    }

    addPengumuman() {
        handle.setup();
        $("#formAddPengumuman").validate({
            rules: {
                nama: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Nama pengumuman tidak boleh kosong",
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
                const p = new Pengumuman();
                var file = $("#file-pengumuman")[0].files;
                if (file.length > 0) {
                    var fileExtension = [
                        "jpeg",
                        "jpg",
                        "png",
                        "pdf",
                        "docx",
                        "doc",
                    ];
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
                        toastr.error("Ukuran file maksmimum 5mb");
                    } else {
                        p._storePengumuman(form);
                    }
                } else {
                    p._storePengumuman(form);
                }
            },
        });
    }

    _storePengumuman(form) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/pengumuman",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#formAddPengumuman").find($(".btn-loading")).show();
                $("#formAddPengumuman").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formAddPengumuman").find($(".btn-loading")).hide();
                $("#formAddPengumuman").find($(".btn-submit")).show();
                if (res) {
                    $("#formAddPengumuman")[0].reset();
                    window.location.assign(APP_URL + "/admin/pengumuman");
                    toastr.success("Pengumuman berhasil ditambahkan!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formAddPengumuman").find($(".btn-loading")).hide();
                $("#formAddPengumuman").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    deletePengumuman() {
        handle.setup();
        var sid = "";
        $("#tablePengumuman").on("click", ".delete", function (e) {
            sid = $(this).closest("tr").attr("id");
        });

        $("#formDeletePengumuman").on("submit", function (e) {
            var url = "/admin/pengumuman/" + sid;
            var form = $(this);
            $.ajax({
                url: APP_URL + url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deletePengumumanModal").find($(".btn-loading")).show();
                    $("#deletePengumumanModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deletePengumumanModal").find($(".btn-loading")).hide();
                    $("#deletePengumumanModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tablePengumuman").DataTable().ajax.reload();
                        $("#deletePengumumanModal").modal("hide");
                        toastr.success("Pengumuman berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deletePengumumanModal").find($(".btn-loading")).hide();
                    $("#deletePengumumanModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

    editPengumuman() {
        handle.setup();
        $("#formEditPengumuman").validate({
            ignore:
                ":hidden:not(#keterangan-pengumuman2),.note-editable.card-block",
            rules: {
                nama2: {
                    required: true,
                },
            },
            messages: {
                nama2: {
                    required: "Nama pengumuman tidak boleh kosong",
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
                var id = $("#idpeng").val();
                const peng = new Pengumuman();
                var file = $("#file-pengumuman2")[0].files;
                if (file.length > 0) {
                    var fileExtension = [
                        "jpeg",
                        "jpg",
                        "png",
                        "pdf",
                        "docx",
                        "doc",
                    ];
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
                        $("#formEditPengumuman")
                            .find($("input[name='_method']"))
                            .val("POST");
                        peng._updateFile(form, id);
                    }
                } else {
                    peng._updatePengumuman(id);
                }
            },
        });
    }

    _updateFile(form, id) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/pengumuman/update-file/" + id,
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(form),
            beforeSend: function () {
                $("#formEditPengumuman").find($(".btn-loading")).show();
                $("#formEditPengumuman").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formEditPengumuman").find($(".btn-loading")).hide();
                $("#formEditPengumuman").find($(".btn-submit")).show();
                if (res) {
                    toastr.success("Pengumuman berhasil diupdate!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formEditPengumuman").find($(".btn-loading")).hide();
                $("#formEditPengumuman").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }

    _updatePengumuman(id) {
        handle.setup();
        $.ajax({
            url: APP_URL + "/admin/pengumuman/" + id,
            type: "PUT",
            data: {
                nama: $("#nama2").val(),
                keterangan: $("#keterangan-pengumuman2").val(),
            },
            beforeSend: function () {
                $("#formEditPengumuman").find($(".btn-loading")).show();
                $("#formEditPengumuman").find($(".btn-submit")).hide();
            },
            success: function (res) {
                $("#formEditPengumuman").find($(".btn-loading")).hide();
                $("#formEditPengumuman").find($(".btn-submit")).show();
                if (res) {
                    toastr.success("Pengumuman berhasil diupdate!");
                }
            },
            error: (e, x, settings, exception) => {
                $("#formEditPengumuman").find($(".btn-loading")).hide();
                $("#formEditPengumuman").find($(".btn-submit")).show();
                handle.errorhandle(e, x, settings, exception);
            },
        });
    }
}

export const pengumuman = new Pengumuman();
