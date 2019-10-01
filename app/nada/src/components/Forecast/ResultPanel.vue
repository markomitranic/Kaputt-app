<template>
    <div id="result-panel" v-bind:class="state">
        <div id="closePanelButton" v-on:click="closePanel">back</div>

        <div id="loading">
            loading...
        </div>
        <div id="wrapper">
            value: {{results}}
        </div>
    </div>
</template>

<script>

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
        transition: 0.4s left ease-in-out, 0.4s box-shadow ease-in-out;
        background-color: white;
        box-shadow: 0 0 15px 0 white;

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

        #loading {
            display: block;
        }

        #wrapper {
            display: none;

            &.visible {
                display: block;
            }
        }
    }
</style>
