
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import mixins from './mixins'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createApp(App)
.mixin(mixins)
.use(store)
.use(VueSweetalert2)
.use(router)
.mount('#app')

window.Kakao.init('c77f9d76956a98cf9fffb34650220bd5');  // 다운로드한 kakao.js에서 내가 원하는 값을 할당해 넣어주겠다. init메소드가 있는데 여기에 할당해서 넣어줄것이다.
// init('kakao의 js 키값.')