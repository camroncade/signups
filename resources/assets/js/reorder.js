define(['jquery'], function($) {

    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var groupUpButtons = $('.group-sort .move-up');
    var groupDownButtons = $('.group-sort .move-down');

    var fieldUpButtons = $('.form-sort .move-up');
    var fieldDownButtons = $('.form-sort .move-down');

    var moveGroupUp = function (event) {
        var group = $(this).parent().parent();
        var previousGroup = group.prev();

        if (previousGroup.hasClass('group')) {
            previousGroup.before(group);
            updateGroupOrder();
        }
    }

    var moveGroupDown = function (event) {
        var group = $(this).parent().parent();
        var nextGroup = group.next();

        if (nextGroup.hasClass('group')) {
            group.before(nextGroup);
            updateGroupOrder();
        }
    }

    var moveFieldUp = function () {
        var field = $(this).parent().parent();
        var previousField = field.prev();

        if (previousField.hasClass('input')) {
            previousField.before(field);
            updateFieldOrderFor(field.parent());
        }
    }

    var moveFieldDown = function () {
        var field = $(this).parent().parent();
        var nextField = field.next();

        if (nextField.hasClass('input')) {
            field.before(nextField);
            updateFieldOrderFor(field.parent());
        }
    }

    var updateGroupOrder = function () {
        var groups = $('.group');
        order = groups.map(outputGroupPosition);

        $.ajax({
            type: 'POST',
            url: '/groups/sort',
            data: {
                _token: csrf_token,
                sort: JSON.stringify(order.get()),
            },
        });
    }

    var updateFieldOrderFor = function (group) {
        var fields = group.find('.input');
        order = $(fields).map(outputFieldPosition);

        console.log(order);

        $.ajax({
            type: 'POST',
            url: '/fields/sort',
            data: {
                _token: csrf_token,
                sort: JSON.stringify(order.get()),
            },
        });

    }

    var outputGroupPosition = function (index, group) {
        return {
            id: group.getAttribute('group-id'),
            index: index,
        };
    }

    var outputFieldPosition = function (index, field) {
        return {
            id: field.getAttribute('field-id'),
            index: index,
        };
    }

    $(document).on('click', '.group-sort .move-up', moveGroupUp);
    $(document).on('click', '.group-sort .move-up', moveGroupDown);

    $(document).on('click', '.form-sort .move-up', moveFieldUp);
    $(document).on('click', '.form-sort .move-down', moveFieldDown);

});
