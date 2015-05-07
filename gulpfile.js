// --------------------------------------------------
// Load Plugins
// --------------------------------------------------

var gulp           = require('gulp'),
    browserSync    = require('browser-sync'),
    notify         = require('gulp-notify'),
    es             = require('event-stream'),
    htmlmin        = require('gulp-htmlmin'),
    sass           = require('gulp-sass'),
    autoprefixer   = require('gulp-autoprefixer'),
    minifycss      = require('gulp-minify-css'),
    // concat         = require('gulp-concat'),
    uglify         = require('gulp-uglify');
    imagemin       = require('gulp-imagemin');

// --------------------------------------------------
// General Config
// --------------------------------------------------

var config = {
  // the html files
  htmlFiles: ['dev/**/*.html', 'dev/**/*.php'],
  // the scss files
  scssFiles: 'dev/scss/**/*.scss',
  // the js files
  jsFiles: 'dev/js/**/*.js',
  // the image files
  imgFiles: 'dev/img/**/*.jpg',
  // the public site files
  publicFiles: 'dist/',
  // the destination directory for our css
  cssPath: 'dist/',
  // the destination directory for our js
  jsPath: 'dist/js/',
  // the destination directory for our images
  imgPath: 'dist/img/',
};



// --------------------------------------------------
// Browser Sync
// --------------------------------------------------

/**
 * Reload the browser
 */
gulp.task('browser-sync', ['minify-html', 'sass', 'uglify'], function() {
//  browserSync({
//    server: {
//      baseDir: config.publicFiles
//    },
//    xip: true
//    // Disables clicks, location, forms, scroll
//    // ghostMode: false
//  });
});

// --------------------------------------------------
// Cleanup HTML
// --------------------------------------------------

/**
 * Minify HTML files
 */
gulp.task('minify-html', function() {
  return gulp.src(config.htmlFiles)
    // .pipe(htmlmin({collapseWhitespace: true}))
    // .on('error', function (err) {
    //   browserSync.notify(err);
    // })
    .pipe(gulp.dest(config.publicFiles))
    // for live injecting
    .pipe(browserSync.reload({stream: true}));
});

// --------------------------------------------------
// Sass
// --------------------------------------------------

/**
 * Compile and minify scss files
 */
gulp.task('sass', function() {
  return gulp.src(config.scssFiles)
    .pipe(sass({
      outputStyle: 'expanded'
    }))
    .on('error', function (err) {
      browserSync.notify(err);
    })
    .pipe(autoprefixer(
      'last 2 version',
      'safari 5',
      'ie 8',
      'ie 9',
      'opera 12.1',
      'ios 6',
      'android 4'
    ))
    .pipe(gulp.dest(config.cssPath))
    .pipe(minifycss())
    .pipe(gulp.dest(config.cssPath))
    // for live injecting
    .pipe(browserSync.reload({stream: true}));
});

// --------------------------------------------------
// JavaScript
// --------------------------------------------------

/**
 * Uglifty the JavaScript
 */
gulp.task('uglify', function() {
  return gulp.src(config.jsFiles)
    .pipe(uglify())
    // .pipe(concat('main.js'))
    .on('error', function (err) {
      browserSync.notify(err);
    })
    .pipe(gulp.dest(config.jsPath))
    // for live injecting
    .pipe(browserSync.reload({stream: true}));
});

// --------------------------------------------------
// Images
// --------------------------------------------------

/**
 * Minify the images
 */
gulp.task('imagemin', function() {
  return gulp.src(config.imgFiles)
    .pipe(imagemin())
    .on('error', function (err) {
      browserSync.notify(err);
    })
    .pipe(gulp.dest(config.imgPath))
    // for live injecting
    .pipe(browserSync.reload({stream: true}));
});

// --------------------------------------------------
// Watch
// --------------------------------------------------

/**
 * Watch scss files for changes & recompile
 * Watch html and js files, reload BrowserSync
 */
gulp.task('watch', function() {
  gulp.watch(config.htmlFiles, ['minify-html']);
  gulp.watch(config.scssFiles, ['sass']);
  gulp.watch(config.jsFiles, ['uglify']);
  // gulp.watch(config.imgFiles, ['imagemin']);
  browserSync.reload();
});

// --------------------------------------------------
// Default
// --------------------------------------------------

/**
 * Default task, running just `gulp` will compile the sass, launch BrowserSync & watch files.
 */
gulp.task('default', ['browser-sync', 'watch']);