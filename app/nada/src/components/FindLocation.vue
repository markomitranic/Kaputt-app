<template>
    <div>
        <label>Test Autocomplete</label>

        <label>
            <location-search @locationChange="locationChangeListener"></location-search>
        </label>

        <div>
            <table>
                <tbody>
                <tr v-for="(item, index) in results" :key="index">
                    {{item.date}}
                    {{item.weatherConditions}}
                    {{item.temperature}}
                </tr>
                </tbody>
            </table>
            <button v-on:click="dateRange()">Send</button>
        </div>

        <div class="auto-complete">
            {{results}}
        </div>
        <datepicker v-model="start"></datepicker>
        <datepicker v-model="end"></datepicker>
        <weather-display></weather-display>
    </div>
</template>

<script>
    import LocationSearch from './LocationSearch';
    import Datepicker from 'vuejs-datepicker';
    import WeatherDisplay from "./WeatherDisplay";


    export default {
        name: 'FindLocation',
        components: {
            Datepicker,
            LocationSearch,
            WeatherDisplay
        },
        data() {
            return {
                results: [],
                locationCoordinates: null,
                start:'',
                end:''
            }
        },
        mounted() {
            this.$http('http://kaputtweather.com/api/forecast?lat=52.5200&lon=13.4050&dateRange=2019-09-20_2019-09-23')
                .then(response => {
                    this.results = response.data;
                    /* eslint-disable no-console */
                    console.log(response.data)
                })
                .catch(error => {
                    /* eslint-disable no-console */
                    console.log(error);
                })
        },
        methods: {
            dateRange() {
                this.$http('http://kaputtweather.com/api/forecast?lat=52.5200&lon=13.4050&dateRange='+ this.start+this.end)
                    .then(response => {
                        this.results = response.data;
                        /* eslint-disable no-console */
                        console.log(response.data)
                    })
                    .catch(error => {
                        /* eslint-disable no-console */
                        console.log(error);
                    })
            },
            locationChangeListener(data) {
                // data = {lat: 44.8178, lng: 20.4568} or null
                this.locationCoordinates = data;
            }
        }
    }
</script>

<style scoped>

</style>
