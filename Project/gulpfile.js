// import laravel-elixir
var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

var gulp = require('gulp');

elixir(function (mix) {

    mix.sass('../../sass/app.scss','resources/css');
    mix.sass('../../sass/predict.scss','resources/css/predict.css');

    mix.styles(
        [
            '../bower_components/bootstrap/dist/css/*.css',
            '../bower_components/foundation-sites/dist/css/*.css',
            // '../bower_components/leaflet/dist/leaflet.css',
            'css/*.css'

        ], 'public/css/style.css', //output file
        'resources' //source folder
     );

    var bowerPath = '../bower_components';
    mix.scripts(
        [
            bowerPath + '/chart.js/dist/Chart.bundle.js',

            //Jquery
            bowerPath + '/jquery/dist/jquery.min.js',
            //bootstrap
            bowerPath + '/bootstrap/dist/js/*.js',

            //foundation js
            bowerPath + '/foundation-sites/dist/js/foundation.min.js',
            bowerPath + '/foundation-sites/js/*.min.js' ,

            //other dependencies
            bowerPath+'/what-input/dist/what-input.min.js',
            bowerPath+'/axios/dist/axios.min.js',
            'js/*.js',
        ], 'public/js/script.js', 'resources');

    // map
    mix.scripts(
        [
            //Jquery
            bowerPath + '/jquery/dist/jquery.min.js',

            bowerPath+'/axios/dist/axios.min.js',
            // bowerPath+'/leaflet/dist/*.js',

            'js/map.js',
        ], 'public/js/map.js', 'resources');

    //chart
    mix.scripts([
        //chart.js
        bowerPath + '/jquery/dist/jquery.min.js',
        bowerPath+'/axios/dist/axios.min.js',
        bowerPath + '/chart.js/dist/Chart.bundle.js',
        'js/orderChart.js',
    ],'public/js/orderChart.js', 'resources');


    mix.scripts([
        //chart.js
        bowerPath + '/jquery/dist/jquery.min.js',
        bowerPath+'/axios/dist/axios.min.js',
        bowerPath + '/chart.js/dist/Chart.bundle.js',
        'js/forecasting.js',
    ],'public/js/forecasting.js', 'resources');

    mix.scripts([
        //chart.js
        bowerPath + '/jquery/dist/jquery.min.js',
        bowerPath+'/axios/dist/axios.min.js',
        bowerPath + '/chart.js/dist/Chart.bundle.js',
        'js/visual.js',
    ],'public/js/visual.js', 'resources')

});
