import axios from 'axios'
export default {
    actions: {
        slider(state) {
            axios.get('http://inventory.loc/api/sliders', {})
                .then((response) => {
                    state.commit("setSlider",response.data)
                })
                .catch(error =>{
                    console.log(error)
                })
        }
    },
    state: {
        sliders: []
    },
    mutations: {
        setSlider(state,data) {
            state.sliders = data;
        }
    },
    getters: {
        getSliders(state) {
            return state.sliders;
        }
    },

}
