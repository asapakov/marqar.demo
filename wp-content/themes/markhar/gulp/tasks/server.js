import browserSync from 'browser-sync';

import config from '../config';

const server = (done) => {
  browserSync.create().init({
    // proxy: 'url',
    server: {
      baseDir: config.dest.root,
    },
    files: [
      `${config.dest.css}/*.css`,
      `${config.dest.js}/*.js`,
      'smart-grid-config.js',
      {
        match: [`${config.dest.images}/**/*`],
        fn() {
          this.reload();
        },
      },
    ],
    port: 3000,
    open: false,
    notify: false,
  });

  done();
};

export default server;
