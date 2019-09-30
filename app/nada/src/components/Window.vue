<template>
    <div id="container">
        <forecast-panel></forecast-panel>
    </div>
</template>

<script>
    import ForecastPanel from './Forecast/ForecastPanel';

    export default {
        name: 'Window',
        components: {
            ForecastPanel
        }
    }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }
</style>
