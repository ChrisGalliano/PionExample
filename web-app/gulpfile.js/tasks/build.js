const gulp = require('gulp');
const {npm} = require("./npm");
const {assets} = require("./assets");
let build = gulp.series(npm, assets);
gulp.task('build', build);
module.exports = {build: build};