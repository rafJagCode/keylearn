const mix = require('laravel-mix');
mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue'],
    alias: {
      '@': __dirname + '/resources',
      vue$: 'vue/dist/vue.common.js',
    },
  },
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

class Loader {
  webpackRules() {
    return {
      test: /\.(mp3|ico)$/,
      loader: 'file-loader',
      options: {
        esModule: false,
        name: '[name].[ext]',
      },
    };
  }
}

mix.extend('loader', new Loader());
mix.browserSync({ proxy: 'http://keylearn.test' });
mix
  .js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    //
  ])
  .loader();
