import Component from "../../component/Component"

export default class editSection extends Component {
    constructor(placeholder,props) {
        super(placeholder,props);
        this.$componentElem = $(this.componentElem);

        this.dataSection = {
            name: '',
            active: true
        };
        this.buildEvents();
    }

    open(check = false,data = null){
        this.$componentElem.modal('toggle');
    }

    buildEvents() {
        this.refs.saveSection.addEventListener('click', this.requestSectionData.bind(this))
    }
    requestSectionData() {
        let check = this.validateSection();
        if (check === false) {
            return;
        }
        let active = true;
        if (this.refs.active.checked === false) {
            active = false
        }
        this.dataSection.name = this.refs.name.value;
        this.dataSection.active = active;
        this.refs.name.value = ''
        this.triggerEvent('new',this.dataSection);
        this.$componentElem.modal('toggle');
    }
    validateSection() {
        let name = this.refs.name.value;
        if (name === '') {
            toastr.error('Section name is required')
            return false;
        }
        return true;
    }

}