$(document).ready(function(){
	$('.slickslider').slick({
		rows:1,
			arrows:true,
		dots:false,
		slidesToShow:5,
        slidesToScroll:1,
		autoplay:false,
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





function chpok(id){
    elem = document.getElementById(id); 
    state = elem.style.display; 
    if (state =='') elem.style.display='block'; 
    else elem.style.display='block';
}


$(document).ready(function(){
  
  $(".fa-search").click(function(){
    $(".wraper, .input").toggleClass("active");
    $("input[type='text']").focus();
  });
  
});