import component from '../../component/Component'
import Autorize from "./Autorize"
export  class State extends component {
    constructor(plackeholderId,data=null) {
        super(plackeholderId,data);
        this.buldEvent();
    }
    buldEvent(){
        this.refs.registers.addEventListener('click',this.rgister.bind(this))
        this.refs.logins.addEventListener('click',this.login.bind(this))
    }
    rgister() {
        new Autorize('registers',{
            data: {},
            events: {
                saveRegister: ({detail}) =>{
                    this.registerData(detail)
                }
            }
        })
    }
    login() {
        new Autorize('login',{
            data: {},
            events: {
                saveLogin: ({detail}) =>{
                    this.loginData(detail)
                }
            }
        })
    }

    registerData(detail) {
        this.triggerEvent('saveRegister', detail);
    }
    loginData(detail) {
        this.triggerEvent('saveLogin', detail);
    }
}
