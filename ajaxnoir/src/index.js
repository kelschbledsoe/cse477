import $ from 'jquery';
import './_noir.scss';
import {Login} from './Login';
import {Stars} from './Stars';
import {MovieInfo} from './MovieInfo';

$(document).ready(function() {
    new Login("#login");
    new Stars('#stars');
    new MovieInfo("#info");
});