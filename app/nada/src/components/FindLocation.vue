<template>
    <div>
        <label>Test Autocomplete</label>

        <label>
            <input type="text" name="city" size="35">
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
        </div>

        <div class="auto-complete">
            {{results}}
        </div>
        <datepicker @selected="chn"></datepicker>
        <datepicker></datepicker>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    export default {
        name: 'FindLocation',
        components: {
            Datepicker
        },
        data() {
            return {
                results: [],
            }
        },
        mounted() {
            this.$http('http://kaputtweather.com/api/forecast?lat=52.5200&lon=13.4050&dateRange=2019-09-20_2019-09-23')
                .then(response => {
                    this.results = response.data;
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            chn(val) {
                this.$http('http://kaputtweather.com/api/forecast?lat=52.5200&lon=13.4050&dateRange='+val)
                    .then(response => {
                        this.results = response.data;
                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
