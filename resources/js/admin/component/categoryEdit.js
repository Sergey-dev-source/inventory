import axios from "axios";
import Component from "../../component/Component";
export default class categoryEdit extends Component {
    constructor(placheholder,data) {
        super(placheholder,data) 
        this.$componentElem = $(this.componentElem);
        this.categoryData = {
            name: '',
            active: '',
            section_id: ''
        }
        this.getSection();
        this.buildEvent();
    }

    getSection() {
        axios.get('/admin/getsection',{})
        .then((response) => {
            this.initSection(response.data)
        })
    }

    buildEvent() {
        this.refs.saveCategory.addEventListener('click',this.saveCategory.bind(this))
    }

    saveCategory () {
        let validate = this.validateCategory()
        if(validate === false) {
            return;
        } 
        let active = 1;
        if (this.refs.active.checked === false) {
            active = 0
        }
        this.categoryData.name = this.refs.name.value;
        this.categoryData.section_id = this.refs.sectionId.value;
        this.categoryData.active = active;
        this.refs.name.value = '';
        this.refs.sectionId.value = '';
        this.refs.active.checked = true;
        this.triggerEvent('new',this.categoryData);
        this.$componentElem.modal('toggle');
    }

    initSection(data) {
        let option = "<option value=''>Select...</option>";
        data.forEach(element => {
            option += `<option value="${element.id}">${element.name}</option>`  
        });
        this.refs.sectionId.innerHTML = option;
    }

    open() {
        this.$componentElem.modal('toggle')
    }

    validateCategory() {
        if (this.refs.name.value === '' ){
            toastr.error('Name connot be empty')
            return false;
        }
        if (this.refs.sectionId.value === '' ){
            toastr.error('Section connot be empty')
            return false;
        }
        return true;
    }
}