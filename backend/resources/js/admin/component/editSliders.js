import Component from "../../component/Component"
import Swal from "sweetalert2";
export default class editSliders extends Component {
    constructor(plackeholder,option){
        super(plackeholder,option)
        this.$componentElem = $(this.componentElem)
        this.sliderData = {
            id: null,
            image: null,
            title: '',
            description: '',
            active: true
        }
        this.buildEvent()
    }

    buildEvent() {
        this.refs.saveSlider.addEventListener('click',this.saveSlider.bind(this))
        this.refs.deleteSlider.addEventListener('click',this.deleteSlider.bind(this))
    }
    deleteSlider() {
            Swal.fire({
                title: 'Are you delete?',
                text: "You want to delete the Sliders image!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed === true) {
                    let id = this.refs.sliderId.value;
                    this.triggerEvent('delete',{id: id})
                }
                this.$componentElem.modal('toggle');
            });
    }
    saveSlider() {
        let validate = this.validate();
        if (validate === false) {
            return;
        }
        let active = 1;
        if (this.refs.active.checked === false) {
            active = 0
        }else {
            active = 1
        }
        this.sliderData.image = this.refs.img.files[0];
        this.sliderData.title = this.refs.title.value;
        this.sliderData.description = this.refs.desc.value;
        this.sliderData.active = active;
        if (this.refs.sliderId.value !== '') {
            this.sliderData.id = this.refs.sliderId.value;
            this.triggerEvent('edits',this.sliderData);
        }else{
            this.sliderData.id = null;
            this.triggerEvent('save',this.sliderData);
        }
        this.emptyInput()
    }
    emptyInput(){
        this.refs.img.value = '';
        this.refs.title.value = '';
        this.refs.desc.value = '';
        this.refs.active.checked = true;
        this.$componentElem.modal('toggle');
    }
    open(check= false,data = null) {
        this.checks(check,data)
        this.$componentElem.modal('toggle');

    }
    checks(check,data){
        if(check === true) {
            this.refs.deleteSlider.classList.remove('d-none')
        } else{
            this.refs.deleteSlider.classList.add('d-none')
        }
        let image = data.image;
        let list = new DataTransfer();
        let img = new File(['content'],image)
        list.items.add(img);
        this.refs.img.files = list.files
       this.refs.title.value = (check === true) ? data.title : '';
        this.refs.desc.value = (check === true) ? data.description : '';
        this.refs.sliderId.value = (check === true) ? data.id : '';
        this.refs.active.checked = (check === true) ? (data.active === 1) ? true : false  : true
    }
    validate() {
        if (this.refs.img.files.length === 0){
            toastr.error('Image cannot be empty');
            return false;
        }
        let validExtensions = ['jpg','png','jpeg']; //array of valid extensions
        let fileName = this.refs.img.files[0].name;
        let fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt,validExtensions) === -1){
            toastr.error('Image should be (png, jpg, jpeg)');
            return false;
        }else if (this.refs.title.value === '') {
            toastr.error('Title cannot be empty');
            return false;
        }else if (this.refs.title.value.length < 3 || this.refs.title.value.length > 15) {
            toastr.error('Title cannot be min 3 characters and max 15 characters');
            return false;
        }

        return true;
    }
}
