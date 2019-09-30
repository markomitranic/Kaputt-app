<template>
    <div id="app">
        <div id="content">
            <ul class="week">
                <li class="day">
                    <span class="day__label">day.time</span>
                    <i class="day__icon wi"></i>
                    <span class="range">
          <span class="range__high">day.temp_high</span>
          <span class="range__low">day.temp_low</span>
        </span>
                </li>
            </ul>

            <p class="location">
                <i class="location__icon wi wi-raindrop wi-flip-vertical"></i>
            </p>

        </div><!-- #content -->
    </div><!-- #app -->
</template>

<script>
    export default {
        name: "WeatherDisplay"
    }
</script>

<style scoped>

</style>
