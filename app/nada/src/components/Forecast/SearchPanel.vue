<template>
    <div>
        <label>Kaputt</label>

        <location-search @locationChange="locationChangeListener"></location-search>
        <date-range @dateRangeChange="dateRangeChangeListener"></date-range>

        <button v-on:click="getForecast()" v-bind:disabled="sendingDisabled">Send</button>
        <weather-display></weather-display>
    </div>
</template>

<script>
    import LocationSearch from './Components/LocationSearch';
    import DateRange from "./Components/DateRange";
    import WeatherDisplay from "./Components/WeatherDisplay";

    export default {
        name: 'FindLocation',
        components: {
            DateRange,
            LocationSearch,
            WeatherDisplay
        },
        data() {
            return {
                results: [],
                locationCoordinates: null,
                dateRange: null,
            }
        },
        computed: {
            sendingDisabled: function () {
                if (this.locationCoordinates !== null && this.dateRange !== null) {
                    return false;
                }
                return true;
            }
        },
        methods: {
            getForecast() {
                if (this.locationCoordinates === null || this.dateRange === null) {
                    return;
                }

                this.$emit('awaitingResults');

                this.$http('/api/forecast', {
                    params: {
                        dateRange: this.dateRange,
                        lat: this.locationCoordinates.lat,
                        lon: this.locationCoordinates.lng
                    }
                }).then(response => {
                    this.$emit('resultsReceived', response.data);
                }).catch(error => {
                    /* eslint-disable no-console */
                    console.error(error);
                });
            },
            locationChangeListener(data) {
                // data = {lat: 44.8178, lng: 20.4568} or null
                this.locationCoordinates = data;
            },
            dateRangeChangeListener(data) {
                this.dateRange = data;
            }
        }
    }
</script>

<style scoped>

</style>
