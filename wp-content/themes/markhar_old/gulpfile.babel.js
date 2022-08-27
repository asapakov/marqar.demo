import { series, parallel } from 'gulp';

import config from './gulp/config';

import clear from './gulp/tasks/clear';
import server from './gulp/tasks/server';
import { scriptsBuild, scriptsWatch } from './gulp/tasks/scripts';
import { stylesBuild, stylesWatch } from './gulp/tasks/styles';
import { assetsBuild, assetsWatch } from './gulp/tasks/assets';
import { imagesBuild, imagesWatch } from './gulp/tasks/images';
import { spritesBuild, spritesWatch } from './gulp/tasks/sprites';

config.setEnv();

export const clean = clear;

export const build = series(
  clear,
  parallel(
    stylesBuild,
    scriptsBuild,
    assetsBuild,
    imagesBuild,
    spritesBuild,
  ),
);

export const watch = series(
  build,
  server,
  parallel(
    stylesWatch,
    scriptsWatch,
    assetsWatch,
    imagesWatch,
    spritesWatch,
  ),
);

export default build;
