define(['jquery'], function($) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var signupId = $('meta[name="signup-id"]').attr('content');

    var signupName = $('#form-name');
    var groupNames = $('.group-name');
    var fieldNames = $('.field-name');
    var fieldDescriptions = $('.field-description');
    
    var addFieldButton = $('.add-new-field');
    var addGroupButton = $('.add-new-group');

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

    var addFieldToGroup = function (event) {
        var input = $('.input').first().attr('field-id', '').clone();
        input.find('.field-name').val('').attr('field-id', '');
        input.find('.field-description').val('').attr('field-id', '');
        input.insertBefore($(this));
        input.find('.field-name').focus();

        createNewFieldInGroup(
                $(this).parent().attr('group-id'),
                input
        );
    }

    var createNewFieldInGroup = function (groupId, input) {
         $.ajax({
            type: "POST",
            url: '/fields',
            data: {
                _token: csrf_token,
                "groupId": groupId,
            },
            complete: function (response) {
                fieldId = response.responseJSON.id;
                input.attr('field-id', fieldId);
                input.find('.field-name')
                     .attr('field-id', fieldId)
                     .focusout(saveFieldName)
                     .on('keypress', exitInput);
                input.find('.field-description')
                     .attr('field-id', fieldId)
                     .focusout(saveFieldDescription)
                     .on('keypress', exitInput);
            }
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

    addFieldButton.on('click', addFieldToGroup);
})
