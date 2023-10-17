var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var autoPrefixer = require('gulp-autoprefixer');
//if node version is lower than v.0.1.2
require('es6-promise').polyfill();
var cssComb = require('gulp-csscomb');
var cmq = require('gulp-merge-media-queries');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');
var environments = require('gulp-environments');
var development = environments.development;
var production = environments.production;

gulp.task('gen_style',function(){
    gulp.src(['build/scss/styles.scss'])
        .pipe(plumber({
            handleError: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        .pipe(development(sourcemaps.init()))
        .pipe(production(autoPrefixer('last 3 versions', 'last 3 iOS versions','safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4')))
        .pipe(production(cssComb()))
        .pipe(production(cmq({log:true})))
        .pipe(sass())
        .pipe(concat('styles.css'))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(development(sourcemaps.write()))
        .pipe(gulp.dest('webroot/css'))
});

gulp.task('default',function(){
    gulp.watch('build/scss/*.scss',['gen_style']);
});

gulp.task('gen', ['gen_style']);
