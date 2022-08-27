import sliderInit from './components/slider';
import aboutInit from './components/about';

import navInit from './components/navigation';
import searchHeaderInit from './components/search-header';
import serviceInit from './components/service';
import clientInit from './components/client';

// Полифилы для старых браузеров
// import 'core-js/stable';
// import 'regenerator-runtime/runtime';

// import $ from 'jquery'; window.jQuery = $; window.$ = $;
const $ = jQuery; window.jQuery = $; window.$ = $;

document.addEventListener('DOMContentLoaded', () => {
  $('.page-header').removeClass('page-header--nojs');

  navInit();
  sliderInit();
  aboutInit();

  // searchHeaderInit();
  // serviceInit();
  // clientInit();
});
