const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 // Default Bootstrap UI
 mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');

// Auth Layout
mix.styles([
        'public/assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'public/assets/global/plugins/simple-line-icons/css/simple-line-icons.min.css',
        'public/assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'public/assets/global/css/components.min.css',
        'public/assets/global/css/plugins.min.css',
        'public/assets/pages/css/login.min.css'
    ], 'public/css/auth.css')
    .scripts([
        'public/assets/global/plugins/jquery.min.js',
        'public/assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'public/assets/global/plugins/js.cookie.min.js',
        'public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'public/assets/global/plugins/jquery.blockui.min.js',
        'public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'public/assets/global/scripts/app.min.js',
        'public/assets/global/plugins/backstretch/jquery.backstretch.min.js'
    ], 'public/js/auth.js');

// App Layout
mix.styles([
        'public/assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'public/assets/global/plugins/simple-line-icons/css/simple-line-icons.min.css',
        'public/assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'public/assets/global/css/components.min.css',
        'public/assets/global/css/plugins.min.css',
        'public/assets/layouts/layout2/css/layout.min.css',
        'public/assets/layouts/layout2/css/themes/blue.min.css',
        'public/assets/layouts/layout2/css/custom.min.css',
        'public/assets/global/plugins/bootstrap-toastr/toastr.min.css'
    ], 'public/css/main.css')
    .scripts([
        'public/assets/global/plugins/jquery.min.js',
        'public/assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'public/assets/global/plugins/js.cookie.min.js',
        'public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'public/assets/global/plugins/jquery.blockui.min.js',
        'public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'public/assets/global/scripts/app.min.js',
        'public/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'public/assets/layouts/layout2/scripts/layout.min.js',
        'public/assets/global/plugins/bootstrap-toastr/toastr.min.js'
    ], 'public/js/main.js');
    
// Font Icons
mix.copyDirectory('public/assets/global/plugins/font-awesome/fonts', 'public/fonts')
   .copyDirectory('public/assets/global/plugins/simple-line-icons/fonts', 'public/fonts')
   .copyDirectory('public/assets/global/plugins/bootstrap/fonts', 'public/fonts');