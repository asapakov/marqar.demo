const $ = jQuery; window.jQuery = $; window.$ = $;

const serviceInit = () => {
  const isSlickLoaded = (typeof $.fn.slick !== 'undefined');

  if (!isSlickLoaded) return;

  $('.page-service').removeClass('page-service--nojs');

  $('.page-service__list').slick({
    slidesToShow: 3,
    // centerMode: true,
    // centerPadding: '0',
    infinite: true,
    arrows: true,
    dots: false,
    prevArrow: $('.page-service__arrow-button--left'),
    nextArrow: $('.page-service__arrow-button--right'),

    responsive: [
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
};

export default serviceInit;
