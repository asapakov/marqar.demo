import { src, dest, watch } from 'gulp';

import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import named from 'vinyl-named';
import webpackStream from 'webpack-stream';

import config from '../config';

export const scriptsBuild = () => (
  src(`${config.src.js}/main.js`)
    .pipe(plumber({
      errorHandler: notify.onError((err) => (
        {
          title: 'Ошибка в задаче scripts',
          sound: false,
          message: err.message,
        }
      )),
    }))
    .pipe(named())
    .pipe(webpackStream({
      output: {
        filename: '[name].js',
      },
      mode: config.isProd ? 'production' : 'development',
      module: {
        rules: [
          {
            test: /\.js$/,
            exclude: /(node_modules|bower_components)/,
            use: {
              loader: 'babel-loader',
            },
          },
        ],
      },
      devtool: config.isProd ? false : 'inline-source-map',
    }))
    .pipe(dest(`${config.dest.js}`))
);

export const scriptsWatch = () => {
  watch(`${config.src.js}/**/*.js`, scriptsBuild);
};
