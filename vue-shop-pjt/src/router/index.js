import { createRouter, createWebHistory } from 'vue-router'
// import KakaoLogin from '../views/KakaoLogin.vue'
import ProductList from '../views/ProductList';
import ProductDetail from '../views/ProductDetail';
import ProductCreate from '../views/ProductCreate';
import ProductUpdate from '../views/ProductUpdate';
import SalesList from '../views/SalesList';
import ImageInsert from '../views/ImageInsert';
import store from '@/store';
import swal from 'sweetalert2';
// sweetalert2과 view에 있는 sweetalert2와는 다른것!



// 네비게이션 가드
// 로그인을 했는지 확인해주는 alert 창이 뜬다.
const requireAuth = () => (to, from, next) => {
  /* from (현재위치값)이동하고자하는 위치, to = 가고자 하는 위치(가려는 곳)
    예제를 쓰려면 모든 경로가 requireAuth를 거치고 가게 하는데 to, from을 작성하지 않은 이유는 로그인이 필요한 곳에 beforeEnter: requireAuth를 추가 해서 사용할 것이기 때문에 따로 작성하지 않음. 
  */
  if(store.state.user.iuser === undefined) {    // 로그인을 하지 않았다면!
    swal.fire('로그인을 하세요', '','warning');
    return;
  }
  next();
}

const routes = [
  // {
  //   path: '/KakaoLogin',
  //   name: 'KakaoLogin',
  //   component: KakaoLogin
  // },
  {
    path: '/',
    name: 'Home',
    component: ProductList
  },
  {
    path: '/detail',
    name: 'ProductDetail',
    component: ProductDetail
  },
  {
    path: '/create',
    name: 'ProductCreate',
    component: ProductCreate,
    beforeEnter: requireAuth()  
    // create로 진입하기 전에 login이 되었는지 확인!!
  },
  {
    path: '/update',
    name: 'ProductUpdate',
    component: ProductUpdate
  },
  {
    path: '/sales',
    name: 'SalesList',
    component: SalesList
  },
  {
    path: '/image_insert',
    name: 'ImageInsert',
    component: ImageInsert,
    beforeEnter: requireAuth()
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router
