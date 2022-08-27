import {
  src,
  dest,
  watch,
  parallel,
} from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';

import config from '../config';

const fontsBuild = () => (
  src(`${config.src.fonts}/**/*`)
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче fontsBuild',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(dest(`${config.dest.fonts}`))
);

const slick = () => (
  src([
    'node_modules/slick-carousel/slick/fonts/**/*',
    'node_modules/slick-carousel/slick/ajax-loader.gif',
    'node_modules/slick-carousel/slick/slick.js',
    'node_modules/slick-carousel/slick/slick.css',
  ])
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче slick',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(dest(`${config.dest.root}/libs/slick`))
);

const jquery = () => (
  src([
    'node_modules/jquery/dist/jquery.js',
  ])
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче jquery',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(dest(`${config.dest.root}/libs/jquery`))
);

export const assetsBuild = parallel(
  fontsBuild,
  slick,
  jquery,
);

export const assetsWatch = () => {
  watch(`${config.src.fonts}/**/*`, fontsBuild);
};
