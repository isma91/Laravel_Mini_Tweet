$(document).ready(function () {
    var user = {};
    var username, pass = "";
    var errField = [];

    $('#login').on('click', function (event) {
        event.preventDefault();
        username = $.trim($("#username").val());
        pass = $("#pass").val();
        user = { username: username, password: pass };
        errField = [];
        $.each(user, function (key, value) {
            if (value == "") {
                errField.push(key);
            }
        });
        if (errField.length > 0) {
            var field = "";
            $.each(errField, function (key, value) {
                field = field + ", " + value;
            });
            field = field.substr(2);
            Materialize.toast('<p class="alert-failed">The following field are empty: ' + field + ' !!<p>', 5000, 'rounded alert-failed');
        } else if (user.password.length <= 3) {
            Materialize.toast('<p class="alert-failed">The password field must be at least 4 characters long !!<p>', 5000, 'rounded alert-failed');
        } else if (user.username.length <= 3) {
            Materialize.toast('<p class="alert-failed">The username must be at least 4 characters long !!<p>', 5000, 'rounded alert-failed');
        } else {
            $("#loginForm").submit();
        }
    })
})