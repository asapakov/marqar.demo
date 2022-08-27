const $ = jQuery; window.jQuery = $; window.$ = $;

const searchHeaderInit = () => {
  $('.header-search').removeClass('header-search--nojs');

  $('.header-search__toggle').on('click', (e) => {
    e.preventDefault();

    $('.page-header__search').toggleClass('header-search--close');
  });

  document.addEventListener('click', (event) => {
    const search = document.querySelector('.page-header__search');
    const isClickInside = search.contains(event.target);

    if (!isClickInside) {
      search.classList.add('header-search--close');
    }
  });
};

export default searchHeaderInit;
