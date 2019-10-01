<template>
    <div id="result-panel" v-bind:class="state">
        <div id="closePanelButton" v-on:click="closePanel">back</div>

        <div id="loading">
            loading...
        </div>
        <div id="wrapper">
            <movie :type="results[selectedDay]"></movie>
            <ul class="dates">
                <li class="date-item" v-for="(item, index) in results" :key="index">
                    <div class="dayButton" v-on:click="changeDay(index)" v-bind:class="{ selected: index === selectedDay }">
                        <span class="date">{{formatDate(item.date)}}</span>
                        <img :src="`/assets/weather-icons/${item.weatherConditions.icon}.svg`" alt="" class="icon">
                        <span class="temperature">{{item.weatherConditions.temperature}}</span>
                    </div>
                </li>
            </ul>

            <ul class="clothes-list" v-if="Array.isArray(results)">
                <li class="clothes-item" v-for="(item, index) in results[selectedDay]['clothes']" :key="index">
                    <div class="image">
                        <img :src="`/assets/clothes-icons/${item.icon}.png`" alt="" class="icon">
                    </div>
                    <span class="description">
                        <span class="clothes-type">{{item.name}}</span>
                        <span class="type-description">{{item.description}}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    import moment from 'moment';
    import Movie from "./Components/Movie";

    export default {
        name: 'ResultPanel',
        components: {
            Movie
        },
        props: {
            state: String,
            results: Array
        },
        data() {
            return {
                selectedDay: 0
            }
        },
        methods: {
            closePanel() {
                this.$emit('closeForecastResults');
            },
            formatDate(date) {
                return moment(date, 'YYYY-MM-DD').format('DD MMM');
            },
            changeDay(index) {
                this.selectedDay = index;
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

        #wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: stretch;
            height: 100%;

            .dates {
                list-style: none;
                padding: 0;
                margin: 0;
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: auto;
                display: flex;
                background: #ececec;
                width: 100%;
                height: 125px;

                .date-item {
                    display: block;
                    min-width: 80px;
                    margin: 10px 5px;

                    .dayButton {
                        cursor: pointer;
                        border-radius: 5px;
                        padding: 5px;

                        &:hover {
                            background-color: #dedede;
                        }

                        &.selected {
                            background-color: #c4c4c4;
                        }

                        .date {
                            font-size: 13px;
                            display: block;
                        }

                        .icon {
                            display: block;
                            width: 30px;
                            height: auto;
                            margin: 5px auto;
                        }

                        .temperature {
                            display: block;
                            font-size: 14px;
                            font-weight: bold;
                        }
                    }
                }
            }

            .clothes-list {
                list-style: none;
                padding: 0;
                margin: 0;
                width: 100%;
                height: 100%;
                overflow-x: hidden;
                overflow-y: scroll;
                -webkit-overflow-scrolling: auto;

                .clothes-item {
                    border-bottom: 1px solid #e6e6e6;
                    display: flex;
                    align-items: stretch;
                    justify-content: flex-start;
                    padding: 10px 5px;
                    box-sizing: border-box;

                    .image {
                        margin-right: 5px;
                        height: 60px;
                        width: 60px;
                        overflow: hidden;

                        .icon {
                            width: 100%;
                            height: auto;
                        }
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
                        .type-description {
                            font-size: 14px;
                            color: #717171;
                        }
                    }
                }
            }
        }
    }
</style>
