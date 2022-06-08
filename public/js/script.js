$(document).ready(function(){
	$('.slickslider').slick({
		rows: 2,
			arrows:true,
		dots:false,
		slidesToShow:4,
        slidesToScroll:1,
		autoplay:true,
		speed:700,
		autoplaySpeed:1800,
        variableWidth: true,
		responsive:[
            
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false,
                    arrows:false,
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows:false,
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows:false,
                  }
                }
            
              ]
	});
});




