import component from '../../component/Component'

export default class Autorize extends component {
    constructor(placeholder, options) {
        super(placeholder, options);
        this.$componentElem = $(this.componentElem);
        this.$componentElem.modal('toggle')
        this.dataRegister = {
            name: '',
            company: '',
            email: '',
            password: ''
        }
        if (placeholder === 'registers'){
            this.buildRegisterEvent()
        }else {
            this.buildRegisterEvent()
        }
    }

    buildRegisterEvent() {
        this.refs.reg.addEventListener('click', this.reg.bind(this))
    }

    reg() {
        this.dataRegister = {
            name: this.refs.name.value,
            company: this.refs.company.value,
            email: this.refs.email.value,
            password: this.refs.password.value
        }
        this.refs.name.value = '';
        this.refs.company.value = '';
        this.refs.email.value = '';
        this.refs.password.value = '';
        this.triggerEvent('saveRegister', this.dataRegister);
        this.$componentElem.modal('toggle')
    }
}