import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import NoutFound from '../views/NoutFound'
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'NoutFound',
    component: NoutFound

  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
