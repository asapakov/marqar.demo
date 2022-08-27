// https://grid4web.ru/options

module.exports = {
  filename: '_smartgrid',
  outputStyle: 'scss',
  columns: 12,
  offset: '30px',
  mobileFirst: false,
  container: {
    maxWidth: '1230px',
    fields: '30px',
  },
  breakPoints: {
    xl: {
      width: '1230px',
    },
    lg: {
      width: '992px',
    },
    md: {
      width: '767px',
    },
    sm: {
      width: '576px',
    },
    xs: {
      width: '560px',
    },
  },
  mixinNames: {
    container: 'container',
    shift: 'offset',
  },
  tab: '  ',
};
