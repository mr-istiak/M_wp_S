const GulpPostCss = require('gulp-postcss')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const { parallel: parallel, src: src, dest: dest, watch: watch, series: series } = require('gulp')
const GulpUglify = require('gulp-uglify')
const browserSync = require('browser-sync').create()
function js(done) {
  src('./src/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(GulpUglify())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./dist/js'))
    .pipe(browserSync.stream({ once: true }))
  done()
}
function css(done) {
  src('./src/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(GulpPostCss())
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./dist/css'))
    .pipe(browserSync.stream({ once: true }))
  done()
}
function bs() {
  browserSync.init({
    injectChanges: true, 
    proxy: "mwps-build.test",
    host: "mwps-build.test",
    open: false
  })
}
function sees() {
  watch(['*.php', './tamplate-parts/**/*.php', './inc/**/*.php', './src/sass/**/*.scss'], parallel(css))
  watch(['./src/js/**/*.js'], parallel(js, css))
}
exports.default = series(css, js)
exports.watch = parallel(bs, sees)
