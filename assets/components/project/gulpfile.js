var syntax        = 'sass'; // Syntax: sass or scss, less ..;

var gulp          = require('gulp'),
    sass          = require('gulp-sass'),
    rename        = require('gulp-rename'),
    autoPrefix    = require('gulp-autoprefixer'),
    cleanCSS      = require('gulp-clean-css'),
    concat        = require('gulp-concat'),
    uglify        = require('gulp-uglify'),
    browserSync   = require('browser-sync'),
    notify        = require("gulp-notify");

gulp.task('styles', function () {
    return gulp.src('app/'+syntax+'/*.'+syntax+'')
        .pipe(sass({outputStyle: 'expand'}).on('error', notify.onError()))
        .pipe(rename({ suffix: '.min', prefix : '' }))
        .pipe(autoPrefix({
            browsers: ['last 15 versions'],
            cascade: true
        }))
        .pipe(cleanCSS({level: { 1: { specialComments: 0 } }}))
        .pipe(gulp.dest('app/css/'))
        //.pipe(browserSync.reload({stream: true}));
});

gulp.task('js', function() {
    return gulp.src([
        'app/libs-bower/jquery/dist/*.min.js',
        'app/libs-bower/bootstrap4/dist/js/bootstrap.bundle.min.js',
        'app/libs-bower/owl.carousel/dist/*.min.js',
        'app/libs-bower/mask/*.js'
    ])
        .pipe(concat('scripts.min.js'))
        .pipe(uglify()) // Mifify js (opt.)
        .pipe(gulp.dest('app/js'))
        //.pipe(browserSync.reload({stream: true}))
});

gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: 'app'
        },
        notify: false
        // open: false,
        // online: false, // Work Offline Without Internet Connection
        // tunnel: true, tunnel: "projectname", // Demonstration page: http://projectname.localtunnel.me
    })
});

gulp.task('watch', ['styles', 'js'/*, 'browser-sync'*/], function() {
    gulp.watch('app/'+syntax+'/**/*.'+syntax+'', ['styles']);
    //gulp.watch('app/*.html', browserSync.reload)
});

gulp.task('default', ['watch']);

