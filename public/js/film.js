$(document).ready(function(){
	$('.slider').slick({
		
		arrows:true,
		dots:false,
		slidesToShow:3,
		autoplay:false,
		speed:1500,
		autoplaySpeed:1800,
        variableWidth: true,
		responsive:[
			{
				breakpoint: 768,
				settings: {
					slidesToShow:1,
					arrows:false,
				}
			},
			{
				breakpoint: 550,
				settings: {
					slidesToShow:1,
					arrows:false
				}
			}
		]
	});
});
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

