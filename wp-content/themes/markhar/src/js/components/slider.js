const $ = jQuery; window.jQuery = $; window.$ = $;

const sliderInit = () => {
  const isSlickLoaded = (typeof $.fn.slick !== 'undefined');

  if (!isSlickLoaded) return;

  $('.page-slider').removeClass('page-slider--nojs');

  $('.page-slider__list').slick({
    arrows: false,
    dots: true,
    fade: true,
    autoplay: false,
    autoplaySpeed: 6000
  });

  let interval = null;

  animate(0.02);

  $('.page-slider .slick-dots li').each(function(key, item) {
    $(item).on('click', function() {
      $('.page-slider__item').css('background-size', '100%');

      clearInterval(interval);
      animate(0.02);
    });
  });

  function animate(iter) {
    let scale = 100;

    interval = setInterval(function() {
      if (scale >= 120) {
        clearInterval(interval);
      }

      $('.page-slider__item').css('background-size', `${scale}% 100%`);
      scale += iter;
    }, 10);
  }
};

export default sliderInit;
