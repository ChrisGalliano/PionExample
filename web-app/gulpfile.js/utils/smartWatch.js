/**
 * How to use:
 *
 * var smartWatch = require('../utils/smartWatch');
 * smartWatch('./static/assets/*.js', ['js:assets']);
 *
 * For huge files change option waitForReady (in ms)
 * smartWatch('./composer.lock', 'composer', {waitForReady: 1000});
 *
 */
var gulp = require('gulp');
var _ = require('underscore');

module.exports = function (globs, tasks, options) {

  var defaults = {
    waitForReady: 300
  };

  options = options || {};
  options = _.extend(defaults, options);

  var timer;
  return gulp.watch(globs, function (event) {

    clearTimeout(timer);

    var realTaskCallback;

    if (typeof tasks === 'function') {
      realTaskCallback = tasks;
    } else {
      realTaskCallback = function () {
        if (typeof tasks === 'string') {
          tasks = [tasks];
        }
        tasks.forEach(function (task) {
          gulp.start(task)
        });
      }
    }

    timer = setTimeout(
      function () {
        return realTaskCallback(event);
      },
      options.waitForReady
    );
  });

};