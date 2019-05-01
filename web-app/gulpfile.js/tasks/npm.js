const gulp = require('gulp');
const files = ['./package.json'];

let npm = function() {
  return gulp.src(files)
    .pipe(require("gulp-plumber")())
    .pipe(require("gulp-install")());
};

let npmWatch = gulp.series(npm, function() {
  require("gulp-util").log('npm watch started');
  return gulp.watch(files, function(vinyl) {
    return gulp.src(vinyl.path)
      .pipe(require("gulp-plumber")())
      .pipe(require("gulp-install")());
  });
});

gulp.task('npm', npm);
gulp.task('npmWatch', npmWatch);
module.exports = {npm: npm, npmWatch: npmWatch};