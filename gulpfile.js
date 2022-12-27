import gulp from "gulp";
import plumber from "gulp-plumber";
import dartSass from "sass";
import gulpSass from "gulp-sass";
import postcss from "gulp-postcss";
import csso from "postcss-csso";
import rename from "gulp-rename";
import autoprefixer from "autoprefixer";
import htmlmin from "gulp-htmlmin";
import webpack from "webpack-stream";
import squoosh from "gulp-libsquoosh";
import svgo from "gulp-svgmin";
import svgstore from "gulp-svgstore";
import del from "del";
import browser from "browser-sync";

// Styles

const sass = gulpSass(dartSass);

export const styles = () => {
  return gulp
    .src("source/sass/style.scss", { sourcemaps: true })
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), csso()]))

    .pipe(rename("style.min.css"))
    .pipe(gulp.dest("build/css", { sourcemaps: "." }))
    .pipe(browser.stream());
};

//html

// const html = () => {
//   return (
//     gulp
//       .src("source/*.html")
//       .pipe(htmlmin({ collapseWhitespace: true }))
//       .pipe(gulp.dest("build"))
//   );
// };

//scripts

let webpackConfig = {
  output: {
    filename: "script.bundle.js",
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: "babel-loader",
        exclude: "/node__modules/",
      },
    ],
  },
};

const scripts = () => {
  return gulp
    .src("source/js/*.js")
    .pipe(webpack(webpackConfig))
    .pipe(gulp.dest("build/js"));
};

//php

// export const php = () => {
//   return gulp
//     .src("source/*.php", {read: false})
//     .pipe(phpmin())
//     .pipe(gulp.dest("build"));
//   }

//images

export const optimizeImages = () => {
  return gulp
    .src("source/img/**/*.{jpg,png}")
    .pipe(squoosh())
    .pipe(gulp.dest("build/img"));
};

const copyImages = () => {
  return gulp.src("source/img/**/*").pipe(gulp.dest("build/img"));
};

//webp

const createWebp = () => {
  return gulp
    .src(["source/img/**/*.{jpg,png}", "!source/img/favicons/*.png"])
    .pipe(
      squoosh({
        webp: {},
      })
    )
    .pipe(gulp.dest("build/img"));
};

// SVG

const svg = () =>
  gulp
    .src(["source/img/**/*.svg", "!source/img/icons/*.svg"])
    .pipe(svgo())
    .pipe(gulp.dest("build/img"));

const sprite = () => {
  return gulp
    .src("source/img/icons/*.svg")
    .pipe(svgo())
    .pipe(
      svgstore({
        inlineSvg: true,
      })
    )
    .pipe(rename("sprite.svg"))
    .pipe(gulp.dest("build/img"));
};

// Copy

const copy = (done) => {
  gulp
    .src(
      [
        "source/fonts/*.{woff2,woff}",
        "source/*.php",
        "source/*/*.php",
        "source/*.ico",
        "source/xls/*.*",
      ],
      {
        base: "source",
      }
    )
    .pipe(gulp.dest("build"));
  done();
};

//Clean

export const clean = () => {
  return del("build");
};

// Server

const server = (done) => {
  browser.init({
    server: {
      baseDir: "build",
    },
    cors: true,
    notify: false,
    ui: false,
  });
  done();
};

// Reload

const reload = (done) => {
  browser.reload();
  done();
};

// Watcher

const watcher = () => {
  gulp.watch("source/sass/**/*.scss", gulp.series(styles));
  gulp.watch("source/js/*.js", gulp.series(scripts));
  gulp.watch("source/*.html", gulp.series(html, reload));
};

//Build

export const build = gulp.series(
  clean,
  copy,
  optimizeImages,
  gulp.parallel(styles, scripts, svg, sprite, createWebp)
);

// Default

export default gulp.series(
  clean,
  copy,
  copyImages,
  gulp.parallel(styles, scripts, svg, sprite, createWebp),
  gulp.series(server, watcher)
);
