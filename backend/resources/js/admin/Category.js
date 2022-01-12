import Component from '../component/Component';
import State from './component/State';
import categoryEdit from './component/categoryEdit';
import axios from 'axios';
import CategoryTable from "./component/CategoryTable";

class Category extends Component {
    constructor(placheholder, data) {
        super(placheholder, data)
        this.state = {};
        this.categoryEdit = {};
        this.categoryTable = {};
        this.data = [];
        this.getData()
    }

    getData() {
        axios.get('/category/shows', {})
            .then((response) => {
                this.data = response.data;
                this.initial();
            })
    }

    initial() {
        this.state = new State('category', {
            data: {},
            events: {
                new: () => {
                    this.newCategory()
                }
            }
        });
        this.categoryEdit = new categoryEdit('categoryEdit', {
            data: {},
            events: {
                new: ({detail}) => {
                    this.persistData('new', detail);
                },
                edit: ({detail}) => {
                    this.persistData('edit', detail)
                },
                delete: ({detail}) => {
                    this.persistData('delete', detail)
                }
            }
        })
        this.categoryTable = new CategoryTable('category', {
            data: {},
            events: {
                edit: ({detail}) => {
                    this.editCategory(detail)
                }
            }
        })
    }

    newCategory() {
        this.categoryEdit.open()
    }

    persistData(check, data) {
        let url = '';
        if (check === 'new') {
            url = '/category/story';
        } else if (check === 'edit') {
            url = '/category/edit'
        } else if(check === 'delete') {
            url = '/category/delete'
        }
        axios.post(url, data)
            .then((response) => {
                let data = response.data;
                if (data.status === true) {
                    toastr.success(data.message)
                } else {
                    toastr.error(data.message)
                }
                this.data = data.ok

                this.categoryTable.table.ajax.reload();
            })
    }

    editCategory(detail) {
        let element;
        this.data.forEach(items => {
            if (items.id === Number(detail)) {
                element = items;
            }
        })
        this.categoryEdit.open(true, element)
    }
}

new Category('category')