const gulp = require('gulp');
const {scss} = require("./scss");
const {libs} = require("./libs");
const {webpack} = require("./webpack");
const assets = gulp.parallel(libs, scss, webpack);
gulp.task('assets', assets);
module.exports = {assets: assets};