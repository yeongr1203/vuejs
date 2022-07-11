<template>
  <h1>Hello</h1>
  <div>{{ hello }}</div>
  <div>{{ hello }}</div>
  <input type="text" v-model="hello">
  <button @click="changeHello">안녕하세요 변경</button>
  <FavoriteSinger />
  <FavoriteSingerProps imgSrc="http://talkimg.imbc.com/TVianUpload/tvian/TViews/image/2021/01/14/QHFlkTlY0Tk3637462379111370904.jpg" />
</template>

<script>
import FavoriteSinger from './components/FavoriteSinger.vue';
import FavoriteSingerProps from './components/FavoriteSingerProps.vue';

export default {
  name: 'App',
  data() { 
    return {
      hello: "안녕"
    }
  },
  methods: {   
    changeHello() {  
      this.hello = " 안녕하세요. "  
    }
  },
  components: {
    FavoriteSinger, FavoriteSingerProps
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
