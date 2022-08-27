import { src } from 'gulp';

import clean from 'gulp-clean';
import config from '../config';

const clear = () => (
  src(config.dest.root, {
    read: false,
    allowEmpty: true,
  })
    .pipe(clean({
      force: true,
    }))
);

export default clear;
