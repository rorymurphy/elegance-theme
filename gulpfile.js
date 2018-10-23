"use strict";

var gulp            = require('gulp'),
    sass            = require('gulp-sass');

var gulpBase        = './',
    sassSource      = './scss/theme.scss',
    cssDir          = './css/',
    cssFile         = 'theme.css',
    watchLessFiles  = '/**/*.scss';

var sass = require('gulp-sass');
 
sass.compiler = require('node-sass');
 
gulp.task('sass', function () {
  return gulp.src(sassSource)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(cssDir));
});
