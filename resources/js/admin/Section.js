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
                field: 'name',
                title: 'Name',
                width: 100
            },
            {
                field: 'active',
                title: 'Active',
                width: 100
            },
            {
                field: 'action',
                title: 'Action',
                width: 100
            }
        ];
        this.formattedData = [];
        this.data = {};

        this.getData();

    }
    getData() {
        axios.get('/section/show',{})
            .then(response => {
                this.data = response.data;
                this.formatData();
                this.init();
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
                }
            }
        });
        this.sectionTable = new SectionTable('section', {
            data: {
                column: this.columnFormat,
                format: this.formattedData
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
        }
        axios.post(url, data)
            .then(response => {
                let section = response.data;
                if (section.status === false) {
                    toastr.error(section.messages)
                } else {
                    toastr.success(section.messages)
                }
            })
    }

    formatData() {
        this.formattedData = [];
        this.data.forEach((item,index) => {
            const json = {
                name: item.name,
                active: (item.active === 1) ? 'active' : 'deactive',
                actions: `<button type="button" class="btn btn--dark" data-action="edit" data-index="${index}"><i class="far fa-edit"></i></button>`
            }
            this.formattedData.push(json)
        })
    }
}

new Section();

