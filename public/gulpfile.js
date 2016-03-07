var gulp = require('gulp'),
    gp_concat = require('gulp-concat'),
    gp_rename = require('gulp-rename'),
    gp_uglify = require('gulp-uglify'),
    gp_sourcemaps = require('gulp-sourcemaps');

var config = {
app:{
		temp_concate:"concate-app.js",
		files:[
		],
		temp_minif:"app-temp-mini.js"
	
	},
lib:{
	temp_concate:"concate-lib.js",
	files:[
	],
	temp_minif:"lib-temp-mini.js"
}

}
var jsLibFiles = [
"app/assets/lib/bootstrap/assets/js/ie-emulation-modes-warning.js",
"bower_components/bootstrap-sweetalert/lib/sweet-alert.js",
"bower_components/angular/angular.js",
"bower_components/angular-animate/angular-animate.js",
"bower_components/angular-sanitize/angular-sanitize.js",
"bower_components/angular-messages/angular-messages.js",
"bower_components/angular-resource/angular-resource.js",
"bower_components/ngCart/dist/ngCart.js",
"bower_components/angular-cookies/angular-cookies.js",
"bower_components/angular-route/angular-route.js",
"bower_components/checklist-model/checklist-model.js",
"bower_components/angular-bootstrap/ui-bootstrap.js"
];


var jsAppFiles = [
"app/assets/lib/js/checklist-model.js",
"app/assets/lib/bootstrap/ui-bootstrap-tpls-1.1.2.min.js",
"app/app-url.js",
"app/locality.js",
"app/app.js",
"app/ordersenquiry/order-enquiry-controller.js",
"app/users/authFactory.js","app/items/itemFactory.js",
"app/products/product.js","app/products/orderFactory.js",
"app/products/product-controller.js",
"app/users/login-controller.js",
"app/users/singnup-controller.js",
"app/users/userFactory.js",
"app/users/addressFactory.js",
"app/users/user-controller.js",
"app/httpinterceptor.js",
"app/address/address-controller.js",
"app/items/item-controller.js", 
"app/services/laundry/laundry-controller.js",
"app/ordersenquiry/orderFactory.js",
"app/ordersenquiry/order-enquiry-controller.js",
"app/admin/admin-controller.js",
"app/admin/admin-controller.js",
"app/services/driver/driver-controller.js"
];


var runForApp = true;
if (runForApp) {
	var souceFileArr = jsAppFiles;
	var destination= "dist/app";
	var minifiedName = 'minifyify-app.js';
} else {
	var souceFileArr = jsLibFiles;
	var destination= "dist/lib";
	var minifiedName = 'minifyify-lib.js';

}



gulp.task('js-app', function(){
    return gulp.src(souceFileArr)
        .pipe(gp_sourcemaps.init())
        .pipe(gp_concat('concat-app.js'))
        .pipe(gulp.dest('dist'))
        .pipe(gp_rename(minifiedName))
        .pipe(gp_uglify())
        .pipe(gp_sourcemaps.write('./'))
        .pipe(gulp.dest(destination));
});

gulp.task('default', ['js-app'], function(){});