$(function () {
    var delay = 6000;
    var slider = {
        slides: $('.slider-single'),
        current: 0,
        bullets: $('#section-slider .bullets'),
        container: '#section-slider'
    };

    initSlider();
    changeSlides();

    function initSlider() {
        slider.slides.hide();
        slider.slides.eq(0).show();
        
        var content = '';
        for (var i = 0; i < slider.slides.length; i++) {
            content += i == 0 ? '<span class="active-slider"></span>' : '<span></span>';
        }
        slider.bullets.html(content);
    }

    function changeSlides() {
        setInterval(function() {
            slider.slides.eq(slider.current).fadeOut(2000);
            slider.current++;

            if (slider.current >= slider.slides.length) {
                slider.current = 0;
            }

            slider.slides.eq(slider.current).fadeIn(2000);
            slider.bullets.find('span').removeClass('active-slider');
            slider.bullets.find('span').eq(slider.current).addClass('active-slider');
        }, delay);

        $(slider.container).on('click', '.bullets span', function() {
            var bulletIndex = $(this).index();
            
            if (bulletIndex !== slider.current) {
                slider.slides.eq(slider.current).fadeOut(2000);
                slider.current = bulletIndex;
                slider.slides.eq(slider.current).fadeIn(2000);
                slider.bullets.find('span').removeClass('active-slider');
                $(this).addClass('active-slider');
            }
        });
    }
});

