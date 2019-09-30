import Vue from 'vue'
import Router from 'vue-router'

import FindLocation from "../components/FindLocation";
import WeatherDisplay from "../components/WeatherDisplay";

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: __dirname,
    routes: [
        {
            path: '/',
            name: 'FindLocation',
            component: FindLocation
        },
        {
            path: '/WeatherDisplay',
            name: 'WeatherDisplay',
            component: WeatherDisplay,
        }
    ]
})
