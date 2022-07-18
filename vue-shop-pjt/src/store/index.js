// import Vuex from 'vuex';
import { createStore } from 'vuex';  // vuex에서 createStore만 가지고옴.
import createPersistedState from 'vuex-persistedstate';

// 확인용
// export default new Vuex.Store({
  // iuser : 0  
// }},
export default createStore({  
  state() {
    return {
      user: {}
    }
  },
  mutations: {
    user : (state, data) => {
      state.user = data;
    }
  },
  plugins: [
    createPersistedState({
      paths: ['user']
    })
  ],
});