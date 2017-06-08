jQuery(document).ready(function($) {

	$('.slider-pub').each(function(){

		$(this).slick({
			arrows:false,
			autoplay:false,
			speed:0,
			fade:true,
			dots:false,
			swipe:false
		})
		var $sliderPub = $(this)

		playCurrentSlide($sliderPub, $sliderPub.slick('slickCurrentSlide'))

		function playCurrentSlide(slickSlider, currentSlideID) {
			var $slickSlider = slickSlider,
				$slider = $slickSlider.slick('getSlick'),
				$currentSlide = $slider.$slides.eq(currentSlideID),
				duree = $currentSlide.attr('data-duree')
				
			if (duree != undefined) {
				setTimeout(function(){
					$slickSlider.slick('slickNext')
					playCurrentSlide($slickSlider, $slickSlider.slick('slickCurrentSlide'))
				}, duree)
			}

		}
	})

});
