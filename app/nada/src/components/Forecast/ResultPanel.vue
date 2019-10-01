<template>
    <div id="result-panel" v-bind:class="{ visible: visible }">
        <div id="closePanelButton" v-on:click="closePanel">back</div>

        <div id="loading" v-bind:class="{ visible: loading }"></div>
        <div id="wrapper" v-bind:class="{ visible: !loading }">
            value: {{results}}
            div.
        </div>
    </div>
</template>

<script>

    export default {
        name: 'ResultPanel',
        components: {
        },
        props: {
            loading: Boolean,
            visible: Boolean,
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
        transition: 0.4s left ease-in-out;
        background-color: white;
        box-shadow: 0 0 15px 0 #7e7e7e;

        &.visible {
            left: 0%;
        }

        #loading {
            display: block;

            &.visible {
                display: none;
            }
        }

        #wrapper {
            display: none;

            &.visible {
                display: block;
            }
        }
    }
</style>
