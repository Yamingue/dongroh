/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// this loads jquery, but does *not* set a global $ or jQuery variable
const $ = require('jquery');
global.$ = global.jQuery = $;
require ('mdbootstrap/js/popper')
require('chart.js')
import 'mdbootstrap/js/mdb'
import AOS from 'aos';
import 'aos/dist/aos.css';
// create global $ and jQuery variables

AOS.init();
var Turbolinks = require("turbolinks")
Turbolinks.start()

// start the Stimulus application
import './bootstrap';
