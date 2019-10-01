<template>
    <div id="movie">
        <svg :src="`/assets/movies/${movieFilename}.svg`"></svg>
    </div>
</template>

<script>
    export default {
        name: "Movie",
        props: {
            type: String
        },
        data() {
            return {
                type: 'clear-day'
            }
        },
        computed: {
            movieFilename() {
                switch (this.type) {
                    case "fog":
                        return "fog";
                    case "snow":
                        return "snow";
                    default:
                        return "clear-day"
                }
            }
        }
    }
</script>

<style scoped>

</style>
