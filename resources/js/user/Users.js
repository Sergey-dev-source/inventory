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
}
new Users;
