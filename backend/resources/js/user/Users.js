import Component from "../component/Component";
import {State} from "./component/State";
import axios from "axios";
class Users extends Component {
    constructor () {
        super('menu');
        this.state = {};
        this.init();
    }
    init(){
        this.state = new State('menu',{
            data: {},
            events: {
                saveRegister: ({detail}) =>{
                    this.register(detail)
                },
                saveLogin: ({detail}) => {
                    this.login(detail)
                }
            }
        })
    }
    register(data){
        axios.post('/register',data)
            .then(response=>{
                if(response.data.status === true) {
                    toastr.success(response.data.message)
                }
            })
            .catch(error=>{
                toastr.error(error.response.data.message)
            })
    }

    login(data){
        axios.post('/login',data)
            .then(response => {
                this.logins(response.data)
            })
    }
    logins(user){
        console.log(user)
        if (user.checkUser === false){
            toastr.error(user.message);
        }else{
            if (user.redirect === false){
                toastr.success(user.message);
                window.location.reload();
            }else {
                window.location.replace('/admin/dashboard')
            }
        }
    }
}
new Users;
