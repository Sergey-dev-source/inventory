import Component from "../../component/Component"
import Swal from "sweetalert2";
export default class editSection extends Component {
    constructor(placeholder,props) {
        super(placeholder,props);
        this.$componentElem = $(this.componentElem);

        this.dataSection = {
            id: null,
            name: '',
            active: true
        };
        this.buildEvents();
    }

    open(check = false,data = null){
        if (check === true) {
            this.refs.deleteSection.classList.remove('d-none');
            this.refs.name.value = data.name;
            this.refs.sectionId.value = data.id;
            if (data.active === 1){
                this.refs.active.checked = true;
            }else {
                this.refs.active.checked = false;
            }
            this.refs.deleteSection.value = data.id
        }else{
            this.refs.sectionId.value = '';
            this.refs.name.value = '';
            this.refs.active.checked = true;
            this.refs.deleteSection.classList.add('d-none');
            this.refs.deleteSection.value = ''
        }
        this.$componentElem.modal('toggle');
    }

    buildEvents() {
        this.refs.saveSection.addEventListener('click', this.requestSectionData.bind(this))
        this.refs.deleteSection.addEventListener('click', this.deleteSectionData.bind(this))
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
        if (this.refs.sectionId.value !== ''){
            this.dataSection.id = this.refs.sectionId.value;
            this.triggerEvent('edit',this.dataSection);
        }else{
            this.dataSection.id = null;
            this.triggerEvent('new',this.dataSection);
        }
        this.refs.sectionId.value = '';
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

    deleteSectionData() {
        Swal.fire({
            title: 'Are you delete?',
            text: "You want to delete the section!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if(result.isConfirmed === true){
                let id = this.refs.deleteSection.value;
                this.triggerEvent('delete',{id: id});
            }
            this.$componentElem.modal('toggle');
        });
    }

}
