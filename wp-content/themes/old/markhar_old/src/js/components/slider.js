const $ = jQuery; window.jQuery = $; window.$ = $;

const sliderInit = () => {
  const isSlickLoaded = (typeof $.fn.slick !== 'undefined');

  if (!isSlickLoaded) return;

  $('.page-slider').removeClass('page-slider--nojs');

  $('.page-slider__list').slick({
    arrows: false,
    dots: true,
    fade: true,
  });
};

export default sliderInit;
