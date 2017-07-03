var gulp        = require('gulp');
var sass        = require('gulp-sass');
var uglify      = require('gulp-uglify');
var concat      = require('gulp-concat');
var spritesmith = require('gulp.spritesmith');
var gutil       = require('gulp-util');

/*

  ## gulp serve

  1. Watch styles and scripts directories for changes

*/

gulp.task('serve', ['styles', 'scripts'], function() {
    gulp.watch("./js/**/*.*", ['scripts']);
    gulp.watch("./scss/**/*.*", ['styles']);
});

/*

  ## gulp styles

  1. Compile sass

*/

gulp.task('styles', function () {
  return gulp.src('./scss/*.*')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('./'))
});

/*

  ## gulp scripts

  1. Concatinate all js files
  2. Minify

*/

gulp.task('scripts', function(){
  return gulp.src(['./js/vendor/*/*.js', './js/scripts.js'])
    .pipe(concat('mortified.min.js'))
    .pipe(uglify()).on('error', gutil.log)
    .pipe(gulp.dest('./'))
})

/*

  ## gulp sprites

*/

gulp.task('sprites', function () {
  var spritesPath = './img/sprites/';
  var spriteData = gulp.src(spritesPath + '*.jpg').pipe(spritesmith({
    imgName: './img/sprite.jpg',
    cssName: 'sprite.css'
  }));
  return spriteData.pipe(gulp.dest('./'));
});

/*

  ## gulp

  The default gulp task will run the server which watches,
  compiles and updates HTML and SCSS.

*/

gulp.task('default', ['serve']);
