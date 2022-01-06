import Component from '../component/Component';
import State from './component/State';
import categoryEdit from './component/categoryEdit';
import axios from 'axios';
class Category extends Component {
    constructor(placheholder,data) {
        super(placheholder,data)
        this.state = {};
        this.categoryEdit = {};
        this.initial()
        
    }
    initial() {
        this.state = new State('category',{
            data: {},
            events: {
                new: () => {
                    this.newCategory()
            }
        }
        });
        this.categoryEdit =  new categoryEdit('categoryEdit',{
            data:{},
            events: {
                new: ({detail}) => {
                    this.persistData('new',detail);
                }
            }
        })
    }

    newCategory(){
        this.categoryEdit.open()
    }
    persistData(check,data) {
        let url = '';
        if(check === 'new'){
            url = '/category/story';
        }
        axios.post(url,data)
        .then((response) => {
            let data = response.data;
            if (data.status === true) {
                toastr.success(data.message)
            } 
        })
    }
}

new Category('category')