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

<style scoped lang="scss">
    #container {
        width: 100%;
        height: 100%;
        flex: 1;
    }
</style>
