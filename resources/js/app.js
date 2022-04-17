
require('./bootstrap');

window.Vue = require('vue').default;

import Myheader from './components/Myheader';

import VueRouter from 'vue-router';
import Vue from 'vue';


Vue.use(VueRouter);

import Search from './components/Search';
import Contentt from './components/Content';
import Volunteer from './components/Volunteer';
import Medcontent from './components/Medicine';




const app = new Vue({
    el: '#app',
    components:{
        Search,
        Contentt,
        Volunteer,
    }
});
const medicine = new Vue({
    el: '#medicine',
    components:{
        Medcontent
    }
});
const search = new Vue({
    el: '#search',
    components:{
        Search
    }
});
const volunteer = new Vue({
    el: '#volunteer',
    components:{
        Volunteer
    }
});
