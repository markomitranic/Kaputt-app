<template>
    <div id="result-panel" v-bind:class="state">
        <div id="closePanelButton" v-on:click="closePanel">back</div>

        <div id="loading">
            loading...
        </div>
        <div id="wrapper">
            <ul class="dates">
                <li class="date-item" v-for="(item, index) in results" :key="index">
                    <span class="date">{{formatDate(item.date)}}</span>
                    <img :src="`/assets/weather-icons/${item.weatherConditions.icon}.png`" alt="" class="icon">
                    <span class="temperature">{{item.weatherConditions.temperature}}</span>
                </li>
            </ul>

            <ul class="clothes-list" v-for="(item, index) in results" :key="index">
                <li class="clothes-item" v-for="(item, index) in results" :key="index">
                    <img :src="`/assets/clothes-icons/${item.clothes[index].icon}.png`" alt="" class="icon">
                    <span class="description">
                        <span class="clothes-type">{{item.clothes[index].name}}</span>
                        <span class="type-description">{{item.clothes[index].description}}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    import moment from 'moment';

    export default {
        name: 'ResultPanel',
        components: {
        },
        props: {
            state: String,
            results: Array
        },
        data() {
            return {}
        },
        methods: {
            closePanel() {
                this.$emit('closeForecastResults');
            },
            formatDate(date) {
                return moment(date).format('DD MMM');
            }
        }
    }
</script>

<style scoped lang="scss">
    #result-panel {
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 100%;
        z-index: 9;
        transition: 0.4s left ease-in-out, 0.4s box-shadow ease-in-out;
        background-color: white;
        &.loading {
            left: 0%;
            box-shadow: 0 0 15px 0 #7e7e7e;
        }

        &.result {
            left: 0%;
            box-shadow: 0 0 15px 0 #7e7e7e;

            #loading {
                display: none;
            }
        }

        .dates {
            list-style: none;
            padding: 0;
            display: flex;
            background: #ececec;

            .date-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 10px 20px;

                .date {
                    font-size: 13px;
                }

                .icon {
                    width: 30px;
                    height: auto;
                    margin: 5px 0;
                }

                .temperature {
                    font-size: 14px;
                    font-weight: bold;
                }
            }
        }

        .clothes-list {
            list-style: none;
            padding: 0;
            margin-bottom: 50px;

            .clothes-item {
                border-bottom: 1px solid #e6e6e6;
                display: flex;

                .icon {
                    width: 60px;
                    height: auto;
                }

                .description {
                    display: flex;
                    flex-direction: column;
                    align-items: start;
                    justify-content: center;
                    font-size: 14px;

                    .clothes-type {
                        margin-bottom: 2px;
                    }
                }
            }
        }
    }
</style>
