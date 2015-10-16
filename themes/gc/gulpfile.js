var gulp = require('gulp');

var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var livereload = require('gulp-livereload');
var autoprefixer = require('gulp-autoprefixer');

// var spritesmith = require('gulp.spritesmith');

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  })
};

gulp.task('sass', function(){
  gulp.src('./library/scss/*.scss')
    .pipe(plumber(plumberErrorHandler))
    .pipe(sass())
    .pipe(gulp.dest('./library/css'))
    .pipe(livereload());
});

gulp.task('watch', function(){

  livereload.listen();

  gulp.watch('./library/scss/**/*.scss', ['sass']);

});

// gulp.task('sprite', function () {
//   var spriteData = gulp.src('images/*.png').pipe(spritesmith({
//     imgName: 'sprite.png',
//     cssName: 'sprite.css'
//   }));
//   return spriteData.pipe(gulp.dest('path/to/output/'));
// });

 
gulp.task('autoprefixer', function () {
    return gulp.src('./library/css/*.css')
        .pipe(autoprefixer({
            browsers: ['> 1%'],
            cascade: false
        }))
        .pipe(gulp.dest('./library/css'));
});

gulp.task('default', ['sass', 'autoprefixer', 'watch']);
