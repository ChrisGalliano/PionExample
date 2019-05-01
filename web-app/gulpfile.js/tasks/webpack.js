const gulp = require('gulp');

let webpack = function () {
  return gulp.src('./src/**/*.ts', {base: './src/'})
    .pipe(require('gulp-plumber')({
      errorHandler: function (error) {
        console.log(error);
      }
    }))
    .pipe(require('vinyl-named')(function (file) {
      return file.relative.replace(/\.ts$/, '.js');
    }))
    .pipe(require('webpack-stream')({
      mode: 'production',
      output: {
        filename: '[name]',
      },
      stats: 'errors-only',
      module: {
        rules: [
          {
            test: /\.ts$/,
            use: [
              {
                loader: 'babel-loader',
                query: {
                  presets: [
                    [
                      "env",
                      {
                        "targets": [
                          '> 0.25%, not dead',
                          'last 5 versions',
                          'ie 9'
                        ]
                      }
                    ]
                  ],
                }
              },
              {
                loader: 'ts-loader'
              }
            ],
          }
        ]
      },
      plugins: [],
      resolve: {
        extensions: ['.json', '.ts']
      },
    }))
    .pipe(gulp.dest(require('../config').compiledDir));
};

let webpackWatch = gulp.series(webpack, function () {
  require("gulp-util").log('webpack watch started');
  return gulp.watch('src/**/*.ts', webpack);
});

gulp.task('webpack', webpack);
gulp.task('webpackWatch', webpackWatch);
module.exports = {webpack: webpack, webpackWatch: webpackWatch};