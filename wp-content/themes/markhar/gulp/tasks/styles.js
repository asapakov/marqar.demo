import {
  src,
  dest,
  watch,
  series,
} from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import gulpif from 'gulp-if';
// import sourcemaps from 'gulp-sourcemaps';
import sass from 'gulp-sass';
import autoprefixer from 'gulp-autoprefixer';
import csso from 'gulp-csso';
import gcmq from 'gulp-group-css-media-queries';
import rename from 'gulp-rename';
import sassGlob from 'gulp-sass-glob';
import smartGrid from 'smart-grid';
import importFresh from 'import-fresh';
// import flatten from 'gulp-flatten';

import config from '../config';

const SMART_GRID_CONFIG_NAME = 'smart-grid-config.js';

const smartGridBuild = (done) => {
  const smartGridConfig = importFresh(`../../${SMART_GRID_CONFIG_NAME}`);
  smartGrid(`${config.src.scss}/core/generated`, smartGridConfig);
  done();
};

const scssBuild = () => (
  src(`${config.src.scss}/main.scss`, { sourcemaps: config.isDev })
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче styles',
          sound: false,
          message: err.message,
        }
      )),
    }))

    .pipe(sassGlob())
    .pipe(gcmq())
    // .pipe(gulpif(config.isDev, sourcemaps.init()))
    .pipe(sass({
      includePaths: ['./node_modules'],
    }))

    .pipe(gulpif(config.isProd, csso()))

    .pipe(autoprefixer({
      grid: 'no-autoplace',
    }))

  // .pipe(gulpif(config.isProd, rename({
  //   suffix: '.min',
  // })))
  // .pipe(gulpif(config.isDev, sourcemaps.write()))

    .pipe(dest(config.dest.css, { sourcemaps: config.isDev }))
);

export const stylesBuild = series(smartGridBuild, scssBuild);

export const stylesWatch = () => {
  watch(`${config.src.scss}/**/*.scss`, scssBuild);
  watch(`./${SMART_GRID_CONFIG_NAME}`, smartGridBuild);
};
