import {
  src,
  dest,
  watch,
  parallel,
} from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import rename from 'gulp-rename';
import imagemin from 'gulp-imagemin';
import svgstore from 'gulp-svgstore';
import filesExist from 'files-exist';

import config from '../config';

const spriteMono = () => (
  src(filesExist(`${config.src.iconsMono}/**/*.svg`, { exceptionMessage: 'Нет ни одного файла icon-*.svg' }))
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче spriteMono',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(imagemin([
      imagemin.svgo({
        plugins: [
          { cleanupIDs: true },
          { removeUselessDefs: true },
          { removeViewBox: false },
          { removeComments: true },
          {
            removeAttrs: {
              attrs: ['class', 'data-name', 'fill.*', 'stroke.*'],
            },
          },
        ],
      }),
    ]))
    .pipe(svgstore({
      inlineSvg: true,
    }))
    .pipe(rename('sprite-mono.svg'))
    .pipe(dest(config.dest.images))
);

const spriteMulti = () => (
  src(filesExist(`${config.src.iconsMulti}/**/*.svg`, { exceptionMessage: 'Нет ни одного файла icon-*.svg' }))
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче spriteMulti',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(imagemin([
      imagemin.svgo({
        plugins: [
          { cleanupIDs: true },
          { removeUselessDefs: true },
          { removeViewBox: false },
          { removeComments: true },
          { removeUselessStrokeAndFill: false },
          { inlineStyles: true },
          {
            removeAttrs: {
              attrs: ['class', 'data-name'],
            },
          },
        ],
      }),
    ]))
    .pipe(svgstore({
      inlineSvg: true,
    }))
    .pipe(rename('sprite-multi.svg'))
    .pipe(dest(config.dest.images))
);

export const spritesBuild = parallel(
  spriteMono,
  spriteMulti,
);

export const spritesWatch = () => {
  watch(`${config.src.iconsMono}/**/*.svg`, spriteMono);
  watch(`${config.src.iconsMulti}/**/*.svg`, spriteMulti);
};
