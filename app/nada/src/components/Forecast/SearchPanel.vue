<template>
    <div id="search-panel">
        <h1>Kaputt 👕👚👖👙</h1>
        <p>Kaputt suggests you what to wear based on the weather forecast. It's a clothes forecast!</p>

        <location-search @locationChange="locationChangeListener"></location-search>
        <date-range @dateRangeChange="dateRangeChangeListener"></date-range>

        <button v-on:click="getForecast()" v-bind:disabled="sendingDisabled">Tell me what to pack!</button>
    </div>
</template>

<script>
    import LocationSearch from './Components/LocationSearch';
    import DateRange from "./Components/DateRange";

    export default {
        name: 'FindLocation',
        components: {
            DateRange,
            LocationSearch,
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
                    console.log(response.data)
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
                this.dateRange = data
            }
        }
    }
</script>

<style scoped lang="scss">
    #search-panel {
        height: auto;
        width: 100%;
        box-sizing: border-box;
        padding-top: 60px;
        padding-bottom: 120px;

        & > h1 {
            text-align: left;
            padding: 5px 15px 15px 15px;
            margin: 0;
            font-size: 34px;
        }
        & > p {
            text-align: left;
            font-size: 18px;
            padding: 0 15px;
            margin-top: 10px;
            margin-bottom: 50px;
        }
        button {
            width: calc(100% - 40px);
            height: 60px;
            display: block;
            background-color: #73cac1;
            color: white;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            border: 0;
            margin: 20px;
            box-sizing: border-box;
            position: absolute;
            bottom: 20px;
            left: 0;
            border-radius: 5px;
            cursor: pointer;
        }
    }
</style>
