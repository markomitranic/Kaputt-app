<template>
  <div id="app">
      <window></window>
  </div>
</template>

<script>
import Window from './components/Window';

export default {
  name: 'app',
  components: {
      Window
  }
}
</script>

<style lang="scss">
    body {
        margin: 0;
        padding: 0;

        #app {
            font-family: Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-align: center;
            color: #2c3e50;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            margin: 0;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: stretch;
            align-items: center;
        }

    }
</style>
