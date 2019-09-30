<template>
    <div id="forecast-panel">
        <search-panel
            @awaitingResults="showLoadingPanel"
            @resultsReceived="showResultPanel"
        ></search-panel>
        <result-panel
            v-bind:loading="loadingPanelVisible"
            v-bind:visible="resultPanelVisible"
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
                loadingPanelVisible: false,
                resultPanelVisible: false,
                forecastResults: null
            }
        },
        methods: {
            showResultPanel(data) {
                this.loadingPanelVisible = false;
                this.resultPanelVisible = true;
                this.forecastResults = data;
            },
            showLoadingPanel() {
                this.loadingPanelVisible = true;
            },
            closeResultPanel() {
                this.resultPanelVisible = false;
                setTimeout(() => {
                    this.forecastResults = null;
                }, 400);
            }

        }
    }
</script>

<style scoped>

</style>
