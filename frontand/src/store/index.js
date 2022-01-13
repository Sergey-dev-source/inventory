import { createStore } from 'vuex'
import auth from './modules/auth'
import sliders from './modules/sliders'
import menu from './modules/menu'
export default createStore({

  modules: {
    auth,
    sliders,
    menu
  }
})
