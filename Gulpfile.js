var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cleancss = require('gulp-clean-css')();
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');

var sass_input = './scss/**/default.scss';
var sass_watch = ['./scss/*.scss', './scss/**/*.scss'];
var sass_output = './dist';

var scripts_input = [
    './node_modules/jquery/dist/jquery.min.js',
    './node_modules/jquery-match-height/dist/jquery.matchHeight-min.js',
    './node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js',
    './node_modules/waypoints/lib/jquery.waypoints.min.js',
    './node_modules/slick-carousel/slick/slick.min.js',
    './node_modules/tether/dist/js/tether.js',
    './node_modules/popper.js/dist/umd/popper.min.js',
    './node_modules/bootstrap/dist/js/bootstrap.js',
    './js/*.js'
];
var scripts_watch = [
    './js/*.js'
];
var scripts_output = './dist';

gulp.task('sass-dev', function () {
    return gulp
        .src(sass_input)
        .pipe(sourcemaps.init())
        .pipe(sass({errLogToConsole: true, outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions', 'IE 10', 'IE 9'],
            cascade: false
        }))
        .pipe(sourcemaps.write())
        .pipe(rename('style.css'))
        .pipe(gulp.dest(sass_output));
});

gulp.task('sass-prod', function () {
    return gulp
        .src(sass_input)
        .pipe(sass({errLogToConsole: true, outputStyle: 'expanded'}).on('error', sass.logError))
        //.pipe(purify(purify_input))
        .pipe(autoprefixer({
            browsers: ['last 2 versions', 'IE 10', 'IE 9'],
            cascade: false
        }))
        .pipe(cleancss)
        .pipe(rename('style.css'))
        .pipe(gulp.dest(sass_output));
});

gulp.task('scripts-dev', function () {
    return gulp.src(scripts_input)
        .pipe(sourcemaps.init())
        .pipe(concat('main.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(scripts_output));
});

gulp.task('scripts-prod', function () {
    return gulp.src(scripts_input)
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest(scripts_output));
});

var fonts_input = './node_modules/font-awesome/fonts/*';
var fonts_output = './dist/fonts';

var slick_input = './node_modules/slick-carousel/slick/ajax-loader.gif';
var slick_output = './dist/slick';

var slick_fonts_input = './node_modules/slick-carousel/slick/fonts/*';
var slick_fonts_output = './dist/fonts';

gulp.task('fonts', function () {
    return gulp.src(fonts_input)
        .pipe(gulp.dest(fonts_output));
});

gulp.task('slick', function () {
    return gulp.src(slick_input)
        .pipe(gulp.dest(slick_output));
});

gulp.task('slick-fonts', function () {
    return gulp.src(slick_fonts_input)
        .pipe(gulp.dest(slick_fonts_output));
});

gulp.task('resources', ['fonts', 'slick', 'slick-fonts']);

gulp.task('watch', ['sass-dev', 'scripts-dev', 'resources'], function () {
    gulp.watch(sass_watch, ['sass-dev']);
    gulp.watch(scripts_watch, ['scripts-dev']);
});

gulp.task('default', ['sass-dev', 'scripts-dev', 'resources']);

gulp.task('prod', ['sass-prod', 'scripts-prod', 'resources']);