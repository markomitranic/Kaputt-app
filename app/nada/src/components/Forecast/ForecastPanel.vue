<template>
    <div id="forecast-panel">
        <search-panel
            @resultsReceived="showResultPanel"
        ></search-panel>
        <result-panel
            v-bind:visible="resultPanelVisible"
            v-bind:results="forecastResults"
            @closeForecastResults="closeResultPanel"
        ></result-panel>
    </div>
</template>

<script>
    import VueSlideoutPanel from 'vue2-slideout-panel';
    import SearchPanel from "./SearchPanel";
    import ResultPanel from "./ResultPanel";

    export default {
        name: 'ForecastPanel',
        components: {
            VueSlideoutPanel,
            SearchPanel,
            ResultPanel
        },
        data() {
            return {
                resultPanelVisible: false,
                forecastResults: null
            }
        },
        methods: {
            showResultPanel(data) {
                this.resultPanelVisible = true;
                this.forecastResults = data;
            },
            closeResultPanel() {
                this.resultPanelVisible = false;
                setTimeout(() => {
                    this.forecastResults = null;
                }, 400);
                console.log('close the result panel');
            }

        }
    }
</script>

<style scoped>

</style>
