'use strict';

/**
 * modified gulp-better-sass-inheritance
 * works with continuous steams - does not wait for the end of stream
 */

var path = require('path');
var es = require('event-stream');
var _ = require('lodash');
var vfs = require('vinyl-fs');
var sassGraph = require('sass-graph');
var gutil = require('gulp-util');
var PluginError = gutil.PluginError;
var PLUGIN_NAME = 'gulp-continuous-sass-inheritance';

function gulpBetterSassInheritance(options) {
  options = options || {};

  var stream;
  var graph = null;
  var files = [];
  var filesPaths = [];

  if (!options.base) {
    throw new PluginError(PLUGIN_NAME, 'Missing option `base`!');
  }

  options.initGraphOnStart = options.initGraphOnStart || false;

  var basePath = path.resolve(process.cwd(), options.base);

  function buildGraph() {
    if (options.verbose) {
      gutil.log('[' + PLUGIN_NAME + '] Building sass dependencies graph in dir ' + options.base + '...');
    }
    graph = sassGraph.parseDir(options.base, options);
    if (options.verbose) {
      gutil.log('[' + PLUGIN_NAME + '] Build done');
    }
  }

  if (options.initGraphOnStart) {
    buildGraph();
  }

  function writeStream(currentFile) {

    if (graph === null) {
      buildGraph();
    }

    graph.addFile(currentFile.path);

    if (currentFile && currentFile.contents.length) {
      files.push(currentFile);
    }

    if (files.length) {
      check(_.map(files, function(item) {
        return item.path;
      }));
      vfs.src(filesPaths, {'base': options.base})
        .pipe(es.through(
          function(f) {
            stream.emit('data', f);
          },
          function() {
          }
        ));
      files = [];
      filesPaths = [];
    }

  }


  function check(_filePaths) {
    _.forEach(_filePaths, function(filePath) {
      filesPaths = _.union(filesPaths, [filePath]);
      if (graph.index && graph.index[filePath]) {
        var fullpaths = graph.index[filePath].importedBy;

        if (options.verbose) {
          gutil.log('[' + PLUGIN_NAME + '] File \"', gutil.colors.magenta(path.relative(basePath, filePath)), '\"');
          if (fullpaths.length > 0) {
            gutil.log('[' + PLUGIN_NAME + ']  - importedBy', fullpaths);
          }
        }
        filesPaths = _.union(filesPaths, fullpaths);
      }
      if (fullpaths) {
        return check(fullpaths);
      }
    });
    return true;
  }

  function endStream() {
    stream.emit('end');
  }

  stream = es.through(writeStream, endStream);

  return stream;
}

module.exports = gulpBetterSassInheritance;