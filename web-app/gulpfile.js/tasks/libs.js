const config = require('../config');
const gulp = require('gulp');
const merge = require('merge-stream');

const libs = function () {
  return merge(
    gulp.src(config.nodeModulesDir + 'jquery/dist/jquery.min.js')
      .pipe(gulp.dest(require('../config').compiledLibsDir))
  );
};
gulp.task('libs', libs);
module.exports = {libs: libs};