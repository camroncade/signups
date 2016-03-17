define(['jquery'], function($) {

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
    }

    var moveFieldDown = function () {
        var field = $(event.target.parentNode.parentNode);
        var nextField = field.next();

        if (nextField.hasClass('input'))
            field.before(nextField);
    }

    groupUpButtons.on('click', moveGroupUp);
    groupDownButtons.on('click', moveGroupDown);

    fieldUpButtons.on('click', moveFieldUp);
    fieldDownButtons.on('click', moveFieldDown);

});
