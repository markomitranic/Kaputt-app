<template>
  <div id="app">
      <div class="form-group">
          <label>Character: </label>
          <find-location field="name"></find-location>
      </div>
  </div>
</template>

<script>
import FindLocation from './components/FindLocation';

export default {
  name: 'app',
  components: {
      FindLocation
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
