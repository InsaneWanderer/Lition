jQuery(($) => {
    $('.select').on('click', '.select__head', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().fadeOut();
        } else {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
            $(this).addClass('open');
            $(this).next().fadeIn();
        }
    });

    $('.select').on('click', '.select__item', function () {
        $('.select__head').removeClass('open');
        $(this).parent().fadeOut();
        $(this).parent().prev().text($(this).text());
        $(this).parent().prev().prev().val($(this).text());
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.select').length) {
            $('.select__head').removeClass('open');
            $('.select__list').fadeOut();
        }
    });
});

jQuery(($) => {
    $('.selectsecond').on('click', '.select__headsecond', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().fadeOut();
        } else {
            $('.select__headsecond').removeClass('open');
            $('.select__listsecond').fadeOut();
            $(this).addClass('open');
            $(this).next().fadeIn();
        }
    });

    $('.selectsecond').on('click', '.select__itemsecond', function () {
        $('.select__headsecond').removeClass('open');
        $(this).parent().fadeOut();
        $(this).parent().prev().text($(this).text());
        $(this).parent().prev().prev().val($(this).text());
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.selectsecond').length) {
            $('.select__headsecond').removeClass('open');
            $('.select__listsecond').fadeOut();
        }
    });
});

jQuery(($) => {
    $('.selectthird').on('click', '.select__headthird', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).next().fadeOut();
        } else {
            $('.select__headthird').removeClass('open');
            $('.select__listthird').fadeOut();
            $(this).addClass('open');
            $(this).next().fadeIn();
        }
    });

    $('.selectthird').on('click', '.select__itemthird', function () {
        $('.select__headthird').removeClass('open');
        $(this).parent().fadeOut();
        $(this).parent().prev().text($(this).text());
        $(this).parent().prev().prev().val($(this).text());
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.selectthird').length) {
            $('.select__headthird').removeClass('open');
            $('.select__listthird').fadeOut();
        }
    });
});
