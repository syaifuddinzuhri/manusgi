import { ready } from "jquery";
import { aplikasi } from "./module/aplikasi_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    aplikasi.changeFile("form-logo", "file-logo");
    aplikasi.updateLogo();
    aplikasi.updateDataAplikasi();
    aplikasi.updateSosmed();
});
