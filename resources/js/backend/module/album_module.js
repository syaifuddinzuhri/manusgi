import { handle } from "./handle_module";

class Album {
    dataTable() {
        handle.setup();
        $("#tableAlbum").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/admin/album",
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
                    data: "jumlah",
                    name: "jumlah",
                },
                {
                    data: "created_at",
                    name: "created_at",
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

    addAlbum() {
        handle.setup();
        $("#form-add-album").validate({
            rules: {
                album: {
                    required: true,
                },
            },
            messages: {
                album: {
                    required: "Nama album tidak boleh kosong",
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
                    album: $("#album").val(),
                    _token: $("input[name=_token]").val(),
                };
                $.ajax({
                    type: "POST",
                    url: APP_URL + "/admin/album",
                    data: data,
                    beforeSend: function () {
                        $("#form-add-album").find($(".btn-loading")).show();
                        $("#form-add-album").find($(".btn-submit")).hide();
                    },
                    success: function (res) {
                        $("#form-add-album").find($(".btn-loading")).hide();
                        $("#form-add-album").find($(".btn-submit")).show();
                        if (res) {
                            if (res["error"]) {
                                toastr.error("Kategori sudah ada!");
                            }
                            $("#tableAlbum").DataTable().ajax.reload();
                            $("#form-add-album")[0].reset();
                            $("#addAlbumModal").modal("hide");
                            toastr.success("Album berhasil ditambahkan!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $("#form-add-album").find($(".btn-loading")).hide();
                        $("#form-add-album").find($(".btn-submit")).show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    updateAlbum() {
        handle.setup();
        $("#form-edit-nama-album").on("submit", function (e) {
            e.preventDefault();
            var id = $(this).find($("#ida")).val();
            var nama = $(this).find($("#album2")).val();
            if (nama == "") {
                toastr.error("Nama album tidak boleh kosong");
            } else {
                $.ajax({
                    type: "PUT",
                    url: APP_URL + "/admin/album/" + id,
                    data: {
                        nama: nama,
                    },
                    beforeSend: function () {
                        $("#form-edit-nama-album")
                            .find($(".btn-loading"))
                            .show();
                        $("#form-edit-nama-album")
                            .find($(".btn-submit"))
                            .hide();
                    },
                    success: function (res) {
                        $("#form-edit-nama-album")
                            .find($(".btn-loading"))
                            .hide();
                        $("#form-edit-nama-album")
                            .find($(".btn-submit"))
                            .show();
                        if (res) {
                            toastr.success("Nama album berhasil diupdate!");
                        }
                    },
                    error: (e, x, settings, exception) => {
                        $("#form-edit-nama-album")
                            .find($(".btn-loading"))
                            .hide();
                        $("#form-edit-nama-album")
                            .find($(".btn-submit"))
                            .show();
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            }
        });
    }

    dropzone() {
        const pathURL = document.location.pathname;
        var id = pathURL.split("/")[3];
        var myDropzone = new Dropzone(".dropzone", {
            parallelUploads: 10,
            autoProcessQueue: false,
            addRemoveLinks: true,
            acceptedFiles: "image/*",
        });

        $("#submit-all").on("click", function () {
            myDropzone.processQueue();
            $(".btn-group-dz").find($(".btn-loading")).show();
            $(".btn-group-dz").find($("#submit-all")).hide();
        });

        myDropzone.on("complete", function () {
            if (
                this.getQueuedFiles().length == 0 &&
                this.getUploadingFiles().length == 0
            ) {
                var _this = this;
                _this.removeAllFiles();
                var alb = new Album();
                alb.showGaleri(id);

                $(".btn-group-dz").find($(".btn-loading")).hide();
                $(".btn-group-dz").find($("#submit-all")).show();
                toastr.success("Gambar berhasil diupload!");
            }
        });
    }

    deleteAlbum() {
        handle.setup();
        var id = "";
        $("#tableAlbum").on("click", ".delete", function () {
            id = $(this).closest("tr").attr("id");
        });

        $("#formDeleteAlbum").on("submit", function (e) {
            var url = APP_URL + "/admin/album/" + id;
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                processData: false,
                contentType: false,
                cache: false,
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteAlbumModal").find($(".btn-loading")).show();
                    $("#deleteAlbumModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deleteAlbumModal").find($(".btn-loading")).hide();
                    $("#deleteAlbumModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#tableAlbum").DataTable().ajax.reload();
                        $("#deleteAlbumModal").modal("hide");
                        toastr.success("Album berhasil dihapus!");
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteAlbumModal").find($(".btn-loading")).hide();
                    $("#deleteAlbumModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

    showGaleri(id) {
        handle.setup();
        $.ajax({
            type: "GET",
            url: APP_URL + "/admin/album/show-galeri/" + id,
            data: { id: id },
            success: function (response) {
                $("#show-galeri").html(response);
            },
        });
    }

    deleteGambar(id_album) {
        handle.setup();
        var id = "";
        $("#show-galeri").on("click", ".delete-gambar", function (e) {
            id = $(this).data("id");
        });

        $("#formDeleteGambar").on("submit", function (e) {
            var url = APP_URL + "/admin/album/delete/" + id;
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    $("#deleteGambarModal").find($(".btn-loading")).show();
                    $("#deleteGambarModal").find($(".btn-submit")).hide();
                },
                success: function (res) {
                    $("#deleteGambarModal").find($(".btn-loading")).hide();
                    $("#deleteGambarModal").find($(".btn-submit")).show();
                    if (res) {
                        $("#deleteGambarModal").modal("hide");
                        toastr.success("Gambar berhasil dihapus!");
                        const al = new Album();
                        al.showGaleri(id_album);
                    }
                },
                error: (e, x, settings, exception) => {
                    $("#deleteGambarModal").find($(".btn-loading")).hide();
                    $("#deleteGambarModal").find($(".btn-submit")).show();
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const album = new Album();
