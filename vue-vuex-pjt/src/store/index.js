import { createStore } from 'vuex';

export default createStore({
  state() {   // state:function{}과 같다. 처음엔 state:{} 로 있음. 
    return {  
      count: 0, // count값은 수정이 안된다. 수정하려면 mutations에서!
      cart: [
        {
          product_id: 1,
          product_name: '아이폰거치대',
          category: 'A'
        }
      ]
    };
  },
  getters: {  // getter라서 당연히 리턴이 있어야한다.
    cartCount: (state) => {   // cart의 length 가 몇인지 알 수 있다.
      return state.cart.length;
    }
  },
  mutations: {  // 동기처리가능 및 state 값 변경도 가능.
    increment(state) {
      state.count++;
    },
    setCount(state,val) {
      state.count = val;
    }
  },
  actions: {  // 비동기처리 가능.
  },
  modules: {
  },
});