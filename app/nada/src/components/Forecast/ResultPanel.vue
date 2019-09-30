<template>
    <div id="result-panel" v-bind:class="{ visible: visible }">
        <div id="closePanel" v-on:click="closePanel"><-</div>
        value: {{results}}
    </div>
</template>

<script>

    export default {
        name: 'ResultPanel',
        components: {
        },
        props: {
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
    }
</style>
