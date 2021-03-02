import { album } from "./module/album_module";

const pathURL = document.location.pathname;

if (pathURL != "/admin/album") {
    Dropzone.autoDiscover = false;
}

$(document).ready(function () {
    var id_album = pathURL.split("/")[3];
    if (pathURL == "/admin/album") {
        album.dataTable();
        album.addAlbum();
        album.deleteAlbum();
        $("#sync-album").on("click", function () {
            $("#tableAlbum").DataTable().ajax.reload();
        });
    } else {
        album.showGaleri(id_album);
        album.updateAlbum();
        album.dropzone();
        album.deleteGambar(id_album);
    }
});
