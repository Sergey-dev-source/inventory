import axios from 'axios'
export default {
    actions: {
        actionMenu(state) {
            axios.get('http://inventory.loc/api/menu',{})
                .then((response) => {
                    state.commit('setMenu',response.data);
                })
                .catch((error) => {
                    console.log(error)
                })
        }
    },
    mutations: {
        setMenu(state, data) {
            state.menu = data
        }
    },
    state: {
        menu: []
    },
    getters: {
        getMenu(state){
            return state.menu;
        }
    }
}
