// Less configuration
var gulp = require('gulp');
var less = require('gulp-less');
var cleanCssPlugin = require('less-plugin-clean-css');
var cleancss = new cleanCssPlugin({ advanced: true });

var options = {
  plugins: [cleancss]
};

gulp.task('less', function () {
  gulp.src('less/*.less')
    .pipe(less(options))
    .pipe(gulp.dest('./css'));
});

gulp.task('default', ['less'], function () {
  gulp.watch(['less/*.less', 'less/inc/*.less'], ['less']);
});