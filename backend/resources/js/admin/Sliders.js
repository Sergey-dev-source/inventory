import Component from '../component/Component'
import State from './component/State'
import editSliders from "./component/editSliders";
import axios from "axios";
import SlidersTable from "./component/SlidersTable";
class Sliders extends Component {
    constructor(placeholder, options) {
        super(placeholder, options)
        this.state = {};
        this.editSliders ={};
        this.slidersTable = {};
        this.data = [];

        this.getData();
    }

    getData() {
        axios.get('/sliders/shows',{})
            .then((response) => {
                this.data = response.data
                this.init();
            })
    }

    init() {
        this.state = new State('sliders',{
            data: {},
            events: {
                new: () => {
                    this.editSliders.open()
                }
            }
        });
        this.editSliders = new editSliders('newSliders',{
            data: {},
            events: {
                save: ({detail}) => {
                    this.requestData('new',detail)
                },
                edits: ({ detail }) => {
                    this.requestData('edit',detail)
                },
                delete: ({ detail }) => {
                    this.deleteData(detail);
                }
            }
        });

        this.slidersTable = new SlidersTable('sliders',{
            data: {},
            events: {
                edit: ({detail}) =>{
                    this.edit(detail)
                }
            }
        })
    }
    requestData(check,data){
        let url = '';
        if (check === 'new') {
            url = '/sliders/store'
        } else if (check === 'edit') {
            url = '/sliders/edit'
        }
        let form = new FormData();
        if (data.id !== null) {
            form.append('id' , data.id)
        }
        form.append('image' , data.image)
        form.append('title' , data.title)
        form.append('description' , data.description)
        form.append('active' , data.active)
        axios.post(url,form,{
            headers: {
                'Content-Type': `multipart/form-data;application/json;charset=UTF-8`,
            }
        })
            .then((response) => {
                let result = response.data;
                if (result.status === true) {
                    this.data = result.ok;
                    toastr.success(result.massage)
                    this.slidersTable.table.ajax.reload();
                }
            })
            .catch(error => {
                console.log(error)
            })
    }

    deleteData(data){

        axios.post('/sliders/delete',data)
            .then((response) => {
                let result = response.data;
                if (result.status === true) {
                    this.data = result.ok;
                    toastr.success(result.massage)
                    this.slidersTable.table.ajax.reload();
                }
            })
            .catch(error => {
                console.log(error)
            })
    }
    edit(id) {
        let item;
        this.data.forEach(slid => {
            if (slid.id === Number(id)){
                item = slid;
            }
        })
        this.editSliders.open(true,item)
    }
}

new Sliders('sliders');
