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
        };
        this.loginData = {
            email: '',
            password: ''
        };
        if (placeholder === 'registers') {
            this.buildRegisterEvent()
        } else {
            this.buildLoginEvent()
        }
    }

    buildLoginEvent() {
        this.refs.savelogin.addEventListener('click', this.log.bind(this))
    }

    buildRegisterEvent() {
        this.refs.reg.addEventListener('click', this.reg.bind(this))
    }

    reg() {
        let check = this.validateRegister()
        if (check === false) {
            return;
        }
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

    log() {
        let check = this.validateLogin()
        if (check === false) {
            return;
        }
        this.loginData = {
            email: this.refs.email.value,
            password: this.refs.password.value
        }
        this.refs.email.value = '';
        this.refs.password.value = '';
        this.triggerEvent('saveLogin', this.loginData);
        this.$componentElem.modal('toggle')
    }

    validateRegister() {
        if (this.refs.name.value === '') {
            toastr.error('Please enter your name')
            return false;
        }
        if (this.refs.company.value === '') {
            toastr.error('Please enter your company name')
            return false;
        }
        if (this.refs.email.value === '') {
            toastr.error('Please enter your email')
            return false;
        } else {
            let emailID = this.refs.email.value;
            let atpos = emailID.indexOf("@");
            let dotpos = emailID.lastIndexOf(".");

            if (atpos < 1 || (dotpos - atpos < 2)) {
                toastr.error("Please enter correct email ID")
                return false;
            }
        }

        if (this.refs.password.value === '') {
            toastr.error('Please enter your password')

            return false;
        } else {
            if (this.refs.password.value.length < 5) {
                toastr.error('The password you provided must have at least 5 characters')

                return false;
            }
        }
        return true;

    }
    validateLogin() {
        if (this.refs.email.value === '') {
            toastr.error('Please enter your email')
            return false;
        } else {
            let emailID = this.refs.email.value;
            let atpos = emailID.indexOf("@");
            let dotpos = emailID.lastIndexOf(".");

            if (atpos < 1 || (dotpos - atpos < 2)) {
                toastr.error("Please enter correct email ID")
                return false;
            }
        }

        if (this.refs.password.value === '') {
            toastr.error('Please enter your password')

            return false;
        } else {
            if (this.refs.password.value.length < 5) {
                toastr.error('The password you provided must have at least 5 characters')

                return false;
            }
        }
        return true;

    }
}
