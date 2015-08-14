var _ = require('lodash'),
    path = require('path');

var dev = {
    imports: [],
    entries: { app: ['src/scss/app.scss', 'src/js/app.js'] },
    sass: {
        outputStyle: 'nested',
        includePaths: [
            path.resolve(__dirname, 'node_modules/bootstrap-sass/assets/stylesheets')
        ]
    },
    stats: {},
    webpack: {}
};

var prod = _.merge({}, dev, {
    js: { uglify: true },
    sass: { outputStyle: 'compressed' }
});

module.exports = {
    dev: _.merge(dev, { publicPath: '/fh/web/assets/frontend/build/' }),
    prod: prod,
    staging: prod,
    test: _.merge({}, prod, { publicPath: '/fh/web/assets/frontend/build/' })
};
