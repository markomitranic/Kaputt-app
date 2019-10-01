<template>
    <div id="forecast-panel">
        <search-panel
            @awaitingResults="showLoadingPanel"
            @resultsReceived="showResultPanel"
        ></search-panel>
        <result-panel
            v-bind:state="resultsPanelState"
            v-bind:results="forecastResults"
            @closeForecastResults="closeResultPanel"
        ></result-panel>
    </div>
</template>

<script>
    import SearchPanel from "./SearchPanel";
    import ResultPanel from "./ResultPanel";

    export default {
        name: 'ForecastPanel',
        components: {
            SearchPanel,
            ResultPanel
        },
        data() {
            return {
                resultsPanelState: "",
                forecastResults: null
            }
        },
        methods: {
            showResultPanel(data) {
                this.resultsPanelState = "result";
                this.forecastResults = data;
            },
            showLoadingPanel() {
                this.resultsPanelState = "loading";
            },
            closeResultPanel() {
                this.resultsPanelState = "";
                setTimeout(() => {
                    this.forecastResults = null;
                }, 400);
            }
        }
    }
</script>

<style scoped>
    #forecast-panel {
        height: 100%;
        width: 100%;
        overflow-y: scroll;
        -webkit-overflow-scrolling: auto;
    }
</style>
