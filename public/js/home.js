$(document).ready(function () {
    var formTweetVisibility = "";
    var tweetCurrentLength, tweetMaxlength = 0;
    $('#visibilityFormTweet').on('click', function () {
        formTweetVisibility = $(this).text();
        if (formTweetVisibility == "visibility") {
            $(this).text('visibility_off');
            $('#divFormTweet').css({
                'display': 'none',
                'visibility': 'hidden'
            });
        } else {
            $(this).text('visibility');
            $('#divFormTweet').css({
                'display': 'inline',
                'visibility': 'visible'
            });
        }
    });

    $('#textareaTweet').on("input", function () {
        tweetMaxlength = $(this).attr("maxlength");
        tweetCurrentLength = $(this).val().length;
        if (tweetCurrentLength >= tweetMaxlength) {
            $('label[for="textareaTweet"]').text('Tweet Max 120 characters !!');
        } else {
            $('label[for="textareaTweet"]').text('Tweet ' + (tweetMaxlength - tweetCurrentLength) + ' characters left !!');
        }
    });

    $('#sendTweet').on('click', function (event) {
        event.preventDefault();
        if ($('#textareaTweet').val().length <= 120) {
            $('#formTweet').submit();
        }
    });
})