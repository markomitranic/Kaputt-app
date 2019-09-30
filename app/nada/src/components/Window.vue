<template>
    <div id="container">
        <forecast-panel-manager></forecast-panel-manager>
    </div>
</template>

<script>
    import ForecastPanelManager from "./Forecast/ForecastPanelManager";

    export default {
        name: 'Window',
        components: {
            ForecastPanelManager
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
