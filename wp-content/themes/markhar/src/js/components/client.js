const $ = jQuery; window.jQuery = $; window.$ = $;

const clientInit = () => {
  const isSlickLoaded = (typeof $.fn.slick !== 'undefined');

  if (!isSlickLoaded) return;

  $('.page-client').removeClass('page-client--nojs');

  $('.page-client__list').slick({
    slidesToShow: 4,
    arrows: true,
    dots: false,
    prevArrow: `
      <button class="page-client__arrow page-client__arrow--left slick-prev slick-arrow">
        <svg width="18" height="18" aria-hidden="true"><use xlink:href="#icon-left-arrow"></use></svg>
      </button>
    `,
    nextArrow: `
    <button class="page-client__arrow page-client__arrow--right slick-next slick-arrow">
      <svg width="18" height="18" aria-hidden="true"><use xlink:href="#icon-right-arrow"></use></svg>
    </button>
    `,

    responsive: [
      {
        breakpoint: 1050,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
};

export default clientInit;
