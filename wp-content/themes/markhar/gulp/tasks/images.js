import {
  src,
  dest,
  watch,
  series,
} from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import gulpif from 'gulp-if';
import newer from 'gulp-newer';
import imagemin from 'gulp-imagemin';
import pngQuant from 'imagemin-pngquant';
import webp from 'gulp-webp';

import config from '../config';

const copyImage = () => (
  src([`${config.src.images}/**/*`])
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче copyImage',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(newer(config.dest.images))
    .pipe(gulpif(config.isProd, imagemin([
      // Для gif
      imagemin.gifsicle({
        interlaced: true,
      }),

      // Для png
      imagemin.optipng({
        optimizationLevel: 5,
      }),

      pngQuant({
        quality: [0.8, 0.9],
      }),

      // Для jpg
      imagemin.mozjpeg({
        quality: 75,
        progressive: true,
      }),

      // Для svg
      imagemin.svgo({
        plugins: [
          { cleanupIDs: false },
          { removeUselessDefs: false },
          { removeViewBox: true },
          { removeComments: true },
          { mergePaths: false },
        ],
      }),
    ], {
      verbose: true,
    })))

  // .pipe(flatten({
  //   includeParents: 1
  // }))

    .pipe(dest(config.dest.images))
);

const towebp = () => (
  src(`${config.src.images}/**/*.{jpg,png}`)
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче towebp',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(newer(config.dest.images, { ext: '.webp' }))
    .pipe(webp({
      quality: 80,
    }))

  // .pipe(flatten({
  //   includeParents: 1
  // }))

    .pipe(dest(config.dest.images))
);

export const imagesBuild = series(
  copyImage,
  towebp,
);

export const imagesWatch = () => watch(`${config.src.images}/**/*`, imagesBuild);
