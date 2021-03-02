class Handle {
    setup() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    }
    checkEmail(email) {
        var res = true;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailLegalReg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)([\w-]+\.)+[\w-]{2,4})?$/;

        var emailaddressVal = email;
        if (!emailReg.test(emailaddressVal)) {
            res = false;
        } else if (emailLegalReg.test(emailaddressVal)) {
            res = false;
        }
        return res;
    }

    errorhandle(e, x, settings, exception, msg = null) {
        var message;
        var statusErrorMap = {
            400: "Server understood the request, but request content was invalid.",
            401: "Unauthorized access.",
            403: "Forbidden resource can't be accessed.",
            500: "Internal server error.",
            503: "Service unavailable.",
        };
        if (x.status) {
            message = statusErrorMap[x.status];
            if (!message) {
                message = "Unknown Error \n.";
            }
        } else if (exception == "parsererror") {
            message = "Error.\nParsing JSON Request failed.";
        } else if (exception == "timeout") {
            message = "Request Time out.";
        } else if (exception == "abort") {
            message = "Request was aborted by the server";
        } else {
            message = msg != null ? msg : "Unknown server";
        }
        toastr.error(message);
    }
}

export const handle = new Handle();
