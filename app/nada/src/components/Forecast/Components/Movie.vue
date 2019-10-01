<template>
    <div id="movie">
        <img :src="`/assets/movies/${movieFilename}.svg`">
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

<style scoped lang="scss">
    #movie {
        display: block;
        width: 100%;
        height: auto;
        
        img {
            display: block;
            width: 100%;
            height: auto;
        }
    }
</style>
