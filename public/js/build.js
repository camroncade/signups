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
define('reorder',['jquery'], function($) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var groupUpButtons = $('.group-sort .move-up');
    var groupDownButtons = $('.group-sort .move-down');

    var fieldUpButtons = $('.form-sort .move-up');
    var fieldDownButtons = $('.form-sort .move-down');

    var moveGroupUp = function (event) {
        var group = $(event.target.parentNode.parentNode);
        var previousGroup = group.prev();

        if (previousGroup.hasClass('group'))
            previousGroup.before(group);
    }

    var moveGroupDown = function (event) {
        var group = $(event.target.parentNode.parentNode);
        var nextGroup = group.next();

        if (nextGroup.hasClass('group'))
            group.before(nextGroup);
    }

    var moveFieldUp = function () {
        var field = $(event.target.parentNode.parentNode);
        var previousField = field.prev();

        if (previousField.hasClass('input'))
            previousField.before(field);

        fieldUpButtons = $('.form-sort .move-up');
        fieldDownButtons = $('.form-sort .move-down');
    }

    var moveFieldDown = function () {
        var field = $(event.target.parentNode.parentNode);
        var nextField = field.next();

        if (nextField.hasClass('input'))
            field.before(nextField);

        fieldUpButtons = $('.form-sort .move-up');
        fieldDownButtons = $('.form-sort .move-down');
    }

    groupUpButtons.on('click', moveGroupUp);
    groupDownButtons.on('click', moveGroupDown);

    fieldUpButtons.on('click', moveFieldUp);
    fieldDownButtons.on('click', moveFieldDown);

});

requirejs.config({
    "paths": {
        "jquery": "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min",
    },
});

require(['edit', 'reorder']);

define("main", function(){});

