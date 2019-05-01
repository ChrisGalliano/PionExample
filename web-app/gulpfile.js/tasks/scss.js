const gulp = require('gulp');
const plumber = require('gulp-plumber');
const debug = require('gulp-debug');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const watch = require('gulp-watch');
const inheritance = require('../utils/gulp-continuous-sass-inheritance');
const config = require('../config');

const buildScss = function (stream) {
  return stream
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error);
      }
    }))
    .pipe(debug({title: 'scss:'}))
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: [config.assetsDir]
    }))
    .pipe(postcss([
      require('postcss-short-size'),
      require('autoprefixer')({
        browsers: [
          'last 5 versions',
          'ie 8'
        ]
      }),
      require('postcss-discard-comments')({removeAll: true}),
      require('csswring')
    ]))
    .pipe(gulp.dest(config.compiledDir));
};

let scss = function () {
  return buildScss(gulp.src('./src/**/*.scss'));
};

let scssWatch = gulp.series(scss, function () {
  require("gulp-util").log('scss watch started');
  // noinspection JSUnresolvedFunction
  return buildScss(
    watch(
      'src/**/*.scss',
      {usePolling: true, verbose: true}
    ).pipe(plumber({
      errorHandler: function (error) {
        console.log(error);
      }
    })).pipe(inheritance({
      base: 'src/',
      initGraphOnStart: true,
      includePaths: [config.assetsDir],
    }))
  );
});

gulp.task('scss', scss);
gulp.task('scssWatch', scssWatch);
module.exports = {scss: scss, scssWatch: scssWatch};