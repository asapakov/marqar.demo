const $ = jQuery; window.jQuery = $; window.$ = $;

const aboutInit = () => {
  // const isSlickLoaded = (typeof $.fn.slick !== 'undefined');
  // if (!isSlickLoaded) return;

  const $about = $('.page-about');
  const $listToggle = $about.find('.page-about__list-toggle');

  $listToggle.slick({
    slidesToShow: 3,
    arrows: true,
    dots: false,
    // infinite: false,
    centerMode: false,
    focusOnSelect: true,

    prevArrow: '<button class="page-about__arrow page-about__arrow--left" type="button"><svg width="25" height="25" aria-hidden="true"> <use xlink:href="#icon-left-arrow"></use> </svg></button>',
    nextArrow: '<button class="page-about__arrow page-about__arrow--right" type="button"><svg width="25" height="25" aria-hidden="true"> <use xlink:href="#icon-right-arrow"></use> </svg></button>',

    responsive: [
      {
        breakpoint: 1090,
        settings: {
          slidesToShow: 2,
          centerMode: false,
          // focusOnSelect: false,
        },
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 1,
          centerMode: false,
          focusOnSelect: false,
        },
      },
    ],
  });

  reload();

  $(window).on('resize', function () {
    // $listToggle.slick('refresh');
    reload();
  });

  function reload() {
    const $toggle = $about.find('.page-about__toggle');
    const $item = $about.find('.page-about__item');

    $about.removeClass('page-about--nojs');

    $toggle.on('click', function () {
      const $self = $(this);

      $toggle.each(function () {
        $(this).removeClass('page-about__toggle--show');
      });

      $item.each(function () {
        $(this).removeClass('page-about__item--show');
      });

      $self.addClass('page-about__toggle--show');
      $about.find(`#${$self.data('toggle')}`).addClass('page-about__item--show');
    });
  }
};

export default aboutInit;
