$(document).ready(function () {
    var user = {};
    var firstname, lastname, username, pass, pass2 = "";
    var errField = [];

    $('#register').on('click', function (event) {
        event.preventDefault();
        firstname = $.trim($("#firstname").val());
        lastname = $.trim($("#lastname").val());
        username = $.trim($("#username").val());
        pass = $("#pass").val();
        pass2 = $("#pass2").val();
        user = { firstname: firstname, lastname: lastname, username: username, password: pass, rewrite_password: pass2 };
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
        } else if (user.password.length <= 3 || user.rewrite_password.length <= 3) {
            Materialize.toast('<p class="alert-failed">The two password fields must be at least 4 characters long !!<p>', 5000, 'rounded alert-failed');
        } else if (user.username.length <= 3) {
            Materialize.toast('<p class="alert-failed">The username must be at least 4 characters long !!<p>', 5000, 'rounded alert-failed');
        } else if (user.password !== user.rewrite_password) {
            Materialize.toast('<p class="alert-failed">The two password field must be the same !!<p>', 5000, 'rounded alert-failed');
        } else {
            $("#registerForm").submit();
        }
    })
})