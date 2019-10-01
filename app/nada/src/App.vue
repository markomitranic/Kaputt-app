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
            overflow: hidden;
            height: 100vh;
            width: 100vw;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: stretch;
            align-items: center;
            max-width: 500px;
            margin: 0 auto;
        }

    }
</style>
