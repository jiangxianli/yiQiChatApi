var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    //backend--------------------------------------------------------

    // jquery-vendors.js
    mix.scripts([
        'jquery/dist/jquery.min.js',
        'Chart.js/Chart.min.js',
    ], 'public/backend/js/jquery-vendors.js', 'bower_components');

    //angular-vendors.js
    mix.scripts([
        'lodash/lodash.js',
        'angular/angular.js',
        'angular-animate/angular-animate.js',
        'angular-ui-router/release/angular-ui-router.js',
        'restangular/dist/restangular.js',
        'angular-bootstrap/ui-bootstrap-tpls.js',
        'angular-chart.js/dist/angular-chart.min.js',
        'ng-file-upload/ng-file-upload.js',
        'angular-ui-notification/dist/angular-ui-notification.min.js',
        'angular-loading-bar/build/loading-bar.min.js',
        'angular-datepicker/dist/index.js',
        'angular-translate/angular-translate.min.js',
        'ng-sortable/dist/ng-sortable.js'
    ], 'public/backend/js/angular-vendors.js', 'bower_components');

    //angular.js
    mix.scriptsIn('resources/assets/backend/angular', 'public/backend/js/mcshop.js');

    //vendors.css
    mix.styles([
        'angular-ui-notification/dist/angular-ui-notification.min.css',
        'angular-loading-bar/build/loading-bar.min.css',
        'angular-datepicker/dist/index.css',
        'ng-sortable/dist/ng-sortable.css'
    ], 'public/backend/css/vendors.css', 'bower_components');

    mix.less('backend/mcshop.less', 'public/backend/css/mcshop.css');

    mix.copy('resources/assets/backend/fonts', 'public/backend/fonts');
    mix.copy('resources/assets/backend/images', 'public/backend/images');
    mix.copy('resources/assets/backend/templates', 'public/backend/templates');


    //wap--------------------------------------------------------------

    // jquery-vendors.js
    mix.scripts([
        'jquery/dist/jquery.min.js'
    ], 'public/wap/js/jquery-vendors.js', 'bower_components');

    //angular-vendors.js
    mix.scripts([
        'lodash/lodash.js',
        'angular/angular.js'
    ], 'public/wap/js/angular-vendors.js', 'bower_components');

    //angular.js
    mix.scriptsIn('resources/assets/wap/angular', 'public/wap/mcshop.js');

    mix.less('wap/mcshop.less', 'public/wap/css/mcshop.css');

});
