const gulp = require('gulp');
const {webpackWatch} = require("./webpack");
const {npmWatch} = require("./npm");
const {scssWatch} = require("./scss");
const {build} = require("./build");
gulp.task('watch', gulp.series(build, gulp.parallel(scssWatch, npmWatch, webpackWatch)));