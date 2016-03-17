define('edit',['jquery'], function($) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var signupId = $('meta[name="signup-id"]').attr('content');

    var signupName = $('#form-name');
    var groupNames = $('.group-name');
    var fieldNames = $('.field-name');
    var fieldDescriptions = $('.field-description');


    var exitInput = function (event) {
        if (event.which == 13) 
            event.target.blur();
    }

    var saveSignupName = function (event) {
        $.ajax({
            type: "POST",
            url: window.location.href,
            data: {
                _token: csrf_token,
                id: signupId,
                name: signupName.val(),
            },
        });
    }

    var saveGroupName = function (event) {
        $.ajax({
            type: "POST",
            url: "/groups/" + event.target.getAttribute('group-id'),
            data: {
                _token: csrf_token,
                name: event.target.value,
            },
        });
    }

    var saveFieldName = function (event) {
         $.ajax({
            type: "POST",
            url: "/fields/" + event.target.getAttribute('field-id'),
            data: {
                _token: csrf_token,
                name: event.target.value,
            },
        });
    }

    var saveFieldDescription = function (event) {
        console.log(event.target.name);
        $.ajax({
        type: "POST",
        url: "/fields/" + event.target.getAttribute('field-id'),
        data: {
            _token: csrf_token,
            description: event.target.value,
        },
        });
    }

    signupName.on('keypress', exitInput);
    groupNames.on('keypress', exitInput);
    fieldNames.on('keypress', exitInput);
    fieldDescriptions.on('keypress', exitInput);

    signupName.focusout(saveSignupName);
    groupNames.focusout(saveGroupName);
    fieldNames.focusout(saveFieldName);
    fieldDescriptions.focusout(saveFieldDescription);
})
;
requirejs.config({
    "paths": {
        "jquery": "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min",
    },
});

require(['edit']);

define("main", function(){});

