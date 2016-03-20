define(['jquery'], function($) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var signupId = $('meta[name="signup-id"]').attr('content');

    var signupName = $('#form-name');
    var groupNames = $('.group-name');
    var fieldNames = $('.field-name');
    var fieldDescriptions = $('.field-description');

    var fieldDeleteButtons = $('.form-delete');
    var groupDeleteButtons = $('.group-delete');
    
    var addFieldButton = $('.add-new-field');
    var addGroupButton = $('.add-new-group');

    var groups = $('.group');

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
        var input = $('.input').first().clone().attr('field-id', '');
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
                "sort_index": input.parent().find('input').length,
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
                input.find('.form-delete')
                     .on('click', deleteField);
            }
        });
    }

    var addGroup = function () {
        var group = $('.group').first().clone().attr('group-id', '');
        group.find('.group-name').val('').attr('group-id', '');
        group.find('.input').remove();
        
        var input = $('.input').first().clone().attr('field-id', '');
        input.find('.field-name').val('').attr('field-id', '');
        input.find('.field-description').val('').attr('field-id', '');
        input.insertBefore(group.find('.add-new-field'));

        group.insertBefore($(this));

        createNewGroupForForm(
            $('meta[name="signup-id"]').attr('content'),
            group,
            input
        );
    }

    var createNewGroupForForm = function (signupId, group, input) {
        $.ajax({
            type: 'POST',
            url: '/groups',
            data: {
                _token: csrf_token,
                signupId: signupId,
                sort_index: $('.group').length,
            },
            complete: function (response) {
                groupId = response.responseJSON.id;
                group.attr('group-id', groupId);
                group.find('.group-name').attr('group-id', groupId)
                                         .on('keypress', exitInput)
                                         .focusout(saveGroupName)
                                         .focus();
                
                createNewFieldInGroup(
                        groupId,
                        input
                );

            }
        });
    }

    var deleteField = function () {
        input = $(this).parent().parent(); 
        $.ajax({
            type: "POST",
            url: "/fields/" + input.attr('field-id'),
            data: {
                _token: csrf_token,
                _method: "DELETE",
                id: input.attr('field-id'),
            },
            complete: function () {
                input.remove();
            },
        });
    }

    var showDeleteButton = function () {
        $(this).find('.group-delete').addClass('show');
    }

    var hideDeleteButton = function () {
        $(this).find('.group-delete').removeClass('show'); 
    }

    var deleteGroup = function () {
        var groupId = $(this).parent().attr('group-id');

        $.ajax({
            type: 'POST',
            url: '/groups/' + groupId,
            data: {
                _token: csrf_token,
                _method: "DELETE",
                id: groupId,
            },
            complete: function () {
                $('.group[group-id="' + groupId + '"]').remove();
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

    $(document).on('click', '.add-new-field', addFieldToGroup);
    fieldDeleteButtons.on('click', deleteField);

    addGroupButton.on('click', addGroup);
    $(document).on('mouseenter', '.group', showDeleteButton);
    $(document).on('mouseleave', '.group', hideDeleteButton);
    $(document).on('click', '.group-delete', deleteGroup);
})
