import webpack from 'webpack-stream'

export const scripts = () => {
  return app.gulp.src(app.path.src.js)
    .pipe(app.plugins.if(app.isDev, app.plugins.sourcemaps.init()))
    .pipe(app.plugins.plumber(
      app.plugins.notify.onError({
        title: 'JS',
        message: 'Error: <%= error.message %>'
      })
    ))
    .pipe(webpack({
      mode: app.isBuild ? 'production' : 'development',
      entry: {
        main: './src/js/index.js',
        constructor: './src/js/constructor.js',
      },
      // output: {
      //   filename: 'main.min.js'
      // },
      output: {
        filename: '[name].js'
      },
      resolve: {
        extensions: ['.js', '.jsx', '.json', '.css', '.scss', '...'],
      },
      module: {
        rules: [
          {
            test: /\.(js|jsx)$/i,
            use: {
              loader: 'babel-loader',
              // exclude: /node_modules/,
              options: {
                presets: [
                  '@babel/preset-env',
                  "@babel/react"
                ],
                generatorOpts: {
                  compact: false
                }
              },

            }
          }
        ]
      }
    }))
    .pipe(app.plugins.if(app.isDev, app.plugins.sourcemaps.write()))
    .pipe(app.gulp.dest(app.path.build.js))
    .pipe(app.plugins.browserSync.stream())
}
