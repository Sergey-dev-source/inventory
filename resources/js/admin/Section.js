import Component from "../component/Component";
import State from "./component/State";
import editSection from "./component/editSection";
import SectionTable from "./component/SectionTable";
import axios from "axios";

class Section extends Component {
    constructor() {
        super('section');
        this.state = {};
        this.section = {}
        this.sectionTable = {}
        this.columnFormat = [
            {
                'data': 'Name',
            },
            {
                'data': 'Active',
            },
            {
                'data': 'Action',
            }
        ];
        this.formattedData = [];
        this.data = {};

        this.getData();

    }
    getData() {
        axios.get('/section/shows',{})
            .then(response => {
                this.data = response.data;
                this.init();
                this.formatData();
            })
    }
    init() {
        this.state = new State('section', {
                data: {},
                events: {
                    new: () => {
                        this.newSection()
                    }
                }
            }
        );
        this.section = new editSection('newSection', {
            data: {},
            events: {
                new: ({detail}) => {
                    this.persistData('new', detail)
                },
                edit: ({detail})=>{
                    this.persistData('edit', detail)
                },
                delete: ({detail})=>{
                    this.persistData('delete', detail)
                }
            }
        });
        this.sectionTable = new SectionTable('section', {
            data: {
                column: this.columnFormat,
                format: this.formattedData
            },
            events: {
                edit: ({detail}) => {
                    this.editsSection(detail)
                },
                search: ({detail}) => {
                    this.persistData('search',detail)
                }
            }
        })
    }
    newSection() {
        this.section.open()
    }

    persistData(check, data) {
        let url = '';
        if (check === 'new') {
            url = '/section/store';
        }else if(check === 'edit'){
            url = '/section/edit';
        }else if(check === 'delete'){
            url = '/section/delete';
        }else if(check === 'search'){
            url = '/section/search';
        }
        axios.post(url, data)
            .then(response => {
                let section = response.data;
                if (section.status === false) {
                    toastr.error(section.messages)
                } else {
                    this.data = response.data.ok;
                    this.formatData();
                    if (check !== 'search') {
                        toastr.success(section.messages);
                    }
                }
            })
    }

    formatData() {
        this.sectionTable.table.ajax.reload()
    }

    editsSection(id) {
        let element;
        this.data.forEach(item=>{
            if (item.id === Number(id)){
                element = item
            }
        })
        this.section.open(true,element)
    }
}

new Section();

