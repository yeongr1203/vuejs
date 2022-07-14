import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home';
import BoxOfficeByDay from '../views/BoxOfficeByDay';
import WeekBoxOffice from '../views/WeekBoxOffice';


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/boxOfficebyday',
    name: 'boxOfficebyday',
    component: BoxOfficeByDay
  },
  {
    path: '/WeekBoxOffice',
    name: 'WeekBoxOffice',
    component: WeekBoxOffice
  },
 
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
