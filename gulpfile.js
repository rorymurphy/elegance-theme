"use strict";

var gulp            = require('gulp'),
    less            = require('gulp-less'),
    watch           = require('gulp-watch'),
    concat          = require('gulp-concat'),
    minifyCss       = require('gulp-minify-css'),
    uglify          = require('gulp-uglify');

var gulpBase        = './',
    lessSource      = './less/theme.less',
    cssDir          = './css/'
    cssFile         = 'theme.css',
    watchLessFiles  = '/**/*.less';

gulp.task( 'less', function(){
  return gulp.src( lessSource )
             .pipe( less() )
             .on( 'error', function( err ){
               console.log( err );
               this.emit( 'end' );
             })
             .pipe( concat( cssFile ))
             .pipe( gulp.dest(cssDir) );

});

gulp.task( 'default', function(cb){
  gulp.watch( watchLessFiles, ['less', 'less-sliding-puzzle']);
  runSequence([ 'less', 'less-sliding-puzzle' ]);
});
