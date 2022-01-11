import axios from "axios";
import Component from "../../component/Component";
import Swal from "sweetalert2";
export default class categoryEdit extends Component {
    constructor(placheholder,data) {
        super(placheholder,data) 
        this.$componentElem = $(this.componentElem);
        this.categoryData = {
            id: null,
            name: '',
            active: '',
            section_id: ''
        }
        this.categoryes = [];
        this.getSection();
        this.buildEvent();
    }

    getSection() {
        axios.get('/admin/getsection',{})
        .then((response) => {
            this.categoryes = response.data
        })
    }

    buildEvent() {
        this.refs.saveCategory.addEventListener('click',this.saveCategory.bind(this));
        this.refs.deleteCategory.addEventListener('click',this.deleteCategory.bind(this));
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
        if (this.refs.categoryId.value !== ''){
            this.categoryData.id = this.refs.categoryId.value;
            this.triggerEvent('edit',this.categoryData);
        } else {
            this.categoryData.id = null;
            this.triggerEvent('new',this.categoryData);
        }
        this.$componentElem.modal('toggle');
    }
    deleteCategory() {
        Swal.fire({
            title: 'Are you delete?',
            text: "You want to delete the category!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if(result.isConfirmed === true){
                let id = this.refs.categoryId.value;
                this.triggerEvent('delete',{id: id});
            }
            this.$componentElem.modal('toggle');
        });
    }
    initSection(data = null) {
        let option = "<option value=''>Select...</option>";
        this.categoryes.forEach(element => {
            option += `<option value="${element.id}" ${(data !== null && data.section_id === element.id) ? 'selected' : ''}>${element.name}</option>`
        });
        this.refs.sectionId.innerHTML = option;
        if (data !== null) {
            this.refs.categoryId.value = data.id;
            this.refs.name.value = data.name;
            this.refs.deleteCategory.classList.remove('d-none')
            let active = true;
            if (data.active === 0) {
                active = false;
            }
            this.refs.active.checked = active;
        } else {
            this.refs.categoryId.value = '';
            this.refs.name.value = '';
            this.refs.active.checked = true;
            this.refs.deleteCategory.classList.add('d-none')
        }
    }

    open(check = false,data=null) {
        if (check === true){
            this.initSection(data)
        }  else {
            this.initSection();
        }
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