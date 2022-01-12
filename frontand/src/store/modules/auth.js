import axios from 'axios'
export default {
    state: {
    },
    mutations: {
    },
    getters: {
        },
    actions: {
        async loginAction(state,data) {
            axios.post('http://inventory.loc/api/auth/login',data)
                .then((response) => {
                    console.log(response.data)
                })
                .catch(error =>{
                    console.log(error)
                })
        }
    },
}
