"use strict";

var gulp = require("gulp"),
    gutil = require("gulp-util"),
    prefixer = require("gulp-autoprefixer"),
    sass = require("gulp-sass"),
    watch = require("gulp-watch"),
    clean = require("gulp-clean"),
    plumber = require("gulp-plumber"),
    sourcemaps = require("gulp-sourcemaps"),
    browserSync = require("browser-sync"),
    reload = browserSync.stream,
    concat = require("gulp-concat");

// site paths
var path = {
    copy: {
        "resources/assets/vendor/bootstrap/fonts/**/*": "public/admin-static-files/fonts",
        "resources/assets/vendor/font-awesome/fonts/**/*": "public/admin-static-files/fonts",
        "resources/assets/vendor/iCheck/green.png": "public/admin-static-files/css/",
        "resources/assets/vendor/iCheck/green@2x.png": "public/admin-static-files/css/",
        "resources/assets/vendor/chosen/chosen-sprite.png": "public/admin-static-files/css/",
    },
    build: {
        js: {
            path: "public/admin-static-files/js/",
            index: "app.js",
        },
        css: {
            path: "public/admin-static-files/css/",
            index: "app.css",
        },
        cssPublic: {
            path: "public/css/",
            index: "style.css",
        }
    },
    src: {
        js: {
            scripts: [
                "resources/assets/vendor/jquery/jquery-3.1.1.min.js",
                "resources/assets/vendor/jquery/jquery.cookie.js",
                "resources/assets/vendor/jquery/jquery.validate.min.js",
                "resources/assets/vendor/jquery-ui/jquery-ui.min.js",
                "resources/assets/vendor/jquery/additional-methods.min.js",
                "resources/assets/vendor/jquery/localization/messages_ru.min.js",
                "resources/assets/vendor/bootstrap/js/bootstrap.js",
                "resources/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js",
                "resources/assets/vendor/metisMenu/jquery.metisMenu.js",
                "resources/assets/vendor/slimscroll/jquery.slimscroll.min.js",
                "resources/assets/vendor/pace/pace.min.js",
                "resources/assets/vendor/inspinia.js",
                "resources/assets/vendor/templates/jquery.tmpl.min.js",
                "resources/assets/vendor/iCheck/icheck.min.js",
                "resources/assets/vendor/datapicker/bootstrap-datepicker.js",
                "resources/assets/vendor/clockpicker/jquery-clockpicker.min.js",
                "resources/assets/vendor/chosen/chosen.jquery.js",
                "resources/assets/vendor/sweetalert/sweetalert.min.js",
                "resources/assets/vendor/toastr/toastr.min.js",
                "resources/assets/vendor/ladda/spin.min.js",
                "resources/assets/vendor/ladda/ladda.jquery.min.js",
                "resources/assets/vendor/ladda/ladda.min.js",
                "resources/assets/vendor/rangeSlider/ion.rangeSlider.min.js",
                "resources/assets/vendor/masks/jquery.inputmask.js",
                "resources/assets/js/disable-save-btn.js",
                "resources/assets/vendor/plugins/summernote/summernote.min.js",
                "resources/assets/js/tabs/tabs.js",
                "resources/assets/js/show-for-option.js",
                "resources/assets/js/app.js",
                "resources/assets/js/masks.js",
                "resources/assets/js/table.js",
                "resources/assets/js/toastr.js",
                "resources/assets/js/checkboxes.js",
                "resources/assets/js/filter-minimize.js",
                "resources/assets/js/bootstrap.js",
            ],
        },
        style: [
            "resources/assets/vendor/bootstrap/css/bootstrap.css",
            "resources/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css",
            "resources/assets/vendor/animate/animate.css",
            "resources/assets/vendor/font-awesome/css/font-awesome.css",
            "resources/assets/vendor/iCheck/custom.css",
            "resources/assets/vendor/datapicker/datepicker3.css",
            "resources/assets/vendor/chosen/bootstrap-chosen.css",
            "resources/assets/vendor/sweetalert/sweetalert.css",
            "resources/assets/vendor/toastr/toastr.min.css",
            "resources/assets/vendor/jquery-ui/jquery-ui.min.css",
            "resources/assets/vendor/clockpicker/jquery-clockpicker.min.css",
            "resources/assets/vendor/rangeSlider/ion.rangeSlider.min.css",
            // "resources/assets/vendor/summernote/summernote-bs4.min.css",
            "resources/assets/vendor/plugins/summernote/summernote.css",
            "resources/assets/vendor/plugins/summernote/summernote-bs3.css",
            "resources/assets/sass/app.scss",
        ],
        stylePublic: [
            "resources/assets/vendor/bootstrap/css/bootstrap.css",
        ],
    },
    watch: {
        js: ["resources/assets/js/*.js", "resources/assets/js/**/*.js"],
        style: "resources/assets/**/*.scss",
    },
    clean: [
        "public/admin-static-files/js/",
        "public/admin-static-files/css/",
        "public/admin-static-files/fonts/",
        "public/css/",
    ],
};

gulp.task("clean", function () {
    for (var i in path.clean) {
        var cleanPath = path.clean[i];
        gulp.src(cleanPath, { read: false }).pipe(clean());
    }
});

function jsBuild() {
    return (
        gulp
            .src(path.src.js.scripts)
            .pipe(
                plumber(function (error) {
                    gutil.log(error.message);
                    this.emit("end");
                })
            )
            // .pipe(sourcemaps.init())
            .pipe(concat(path.build.js.index))
            // .pipe(uglify())
            // .pipe(sourcemaps.write())
            .pipe(plumber.stop())
            .pipe(gulp.dest(path.build.js.path))
            .pipe(reload({ stream: true }))
    );
}

gulp.task("js:build", jsBuild);

function styleBuild() {
    return (
        gulp
            .src(path.src.style)
            .pipe(
                plumber(function (error) {
                    gutil.log(error.message);
                    this.emit("end");
                })
            )
            // .pipe(sourcemaps.init())
            .pipe(sass().on("error", sass.logError))
            .pipe(concat(path.build.css.index))
            .pipe(prefixer())
            // .pipe(sourcemaps.write())
            .pipe(plumber.stop())
            .pipe(gulp.dest(path.build.css.path))
            .pipe(reload({ stream: true }))
    );
}

function styleBuildPublic() {
    return (
        gulp.src(path.src.stylePublic)
            .pipe(
                plumber(function (error) {
                    gutil.log(error.message);
                    this.emit("end");
                })
            )
            .pipe(sass().on("error", sass.logError))
            .pipe(concat(path.build.cssPublic.index))
            .pipe(prefixer())
            .pipe(plumber.stop())
            .pipe(gulp.dest(path.build.cssPublic.path))
            .pipe(reload({ stream: true }))
    );
}

gulp.task("style:build", styleBuild);
gulp.task("style:build-public", styleBuildPublic);

gulp.task("copy", function (done) {
    for (var from in path.copy) {
        var to = path.copy[from];
        gulp.src(from).pipe(gulp.dest(to));
    }
    done();
});

function build() {
    return gulp.parallel("js:build", "style:build", "copy");
}
gulp.task("build", build());

gulp.task("watch", function () {
    watch([path.watch.style], styleBuild);
    path.watch.js.forEach(function (item, i, arr) {
        watch([item], jsBuild);
    });
});

gulp.task("dev", gulp.parallel("build", "watch"));
