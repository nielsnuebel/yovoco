var	gulp 			= require('gulp'),
	concat 			= require('gulp-concat'),
	less 			= require('gulp-less'),
	clean 			= require('gulp-clean'),
	minify			= require('gulp-minify-css'),
	prefix			= require('gulp-autoprefixer'),
	sourcemaps		= require('gulp-sourcemaps'),
	browserSync		= require('browser-sync'),
	reload 			= browserSync.reload,
	sourceLess = './assets/less',
	targetCss = './css',
	scriptDir = './assets/js',
	targetJsDir = './js';


gulp.task('less', function(){
	return gulp.src(sourceLess+'/less.less')
		.pipe(sourcemaps.init())
		.pipe(less())
			.on('error',function (err) {
			console.log(err.toString());
			this.emit('end');
		})
		.pipe(prefix())
		.pipe(concat('style.css'))
		//.pipe(minify())
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest(targetCss))
		.pipe(reload({stream:true}));
});


//Script
/* Helpers */
var addScriptDirToFileNames = function(fileArray) {
	fileArray.forEach(function(element, index, theArray) {
		theArray[index] = element;
	});

	return fileArray;
};

var scriptFiles;
scriptFiles = [
	'bower_components/jquery/dist/jquery.js',
	'bower_components/bootstrap/dist/js/bootstrap.js',
	scriptDir  + '/waypoints.min.js',
	scriptDir  + '/script.js'
];

var finalScriptFiles;
finalScriptFiles = addScriptDirToFileNames(scriptFiles);

gulp.task('mergescripts', function() {

	var allFiles = scriptFiles.concat(finalScriptFiles);

	allFiles.forEach(function(element, index, theArray) {
		console.log (element);
	});

	return gulp.src(allFiles)
		.pipe(concat('frontend.js'))
		.pipe(gulp.dest(targetJsDir))
		.pipe(reload({stream:true}));
});

gulp.task('browser-sync',function(){
	browserSync({
		proxy:"yovoco.dev",
		port: 3000,
		open: false
	})
});

gulp.task('default',['less','mergescripts', 'browser-sync'], function(){
	gulp.watch(['assets/less/**/*.less'],['less']);
	gulp.watch(scriptDir + '/**/*.js',['mergescripts']);
});