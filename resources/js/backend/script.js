$(document).ready(function () {
    $(".preloader").fadeOut();
    $(".btn-loading").hide();
    $("img").addClass("img-responsive");
    $("img").css("max-width", "100%");

    window.addEventListener("pageshow", function (event) {
        var historyPage =
            event.persisted ||
            (typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2);
        if (historyPage) {
            // Handle page restore.
            window.location.reload();
        }
    });

    $(".user").on("click", function () {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $(".page-content").html(this.responseText);
            }
        };
        xhttp.open("GET", "/admin/user", true);
        xhttp.send();
    });
});
