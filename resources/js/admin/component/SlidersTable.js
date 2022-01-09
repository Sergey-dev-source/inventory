import Component from "../../component/Component"

export default class SlidersTable extends Component {
    constructor(placheholder, option) {
        super(placheholder, option);
        this.table = {}
        this.initTable()
    }

    initTable() {
        this.table = $(this.refs.slidersTable).DataTable({
            ajax: '/sliders/show',
            columns: [
                {
                    data: 'image',
                    title: 'Image',
                    render: (data, fuel) => {
                        return `<img width="80" src="/images/sliders/${data}">`
                    }
                },
                {
                    data: 'title',
                    title: 'Title',
                },
                {
                    data: 'description',
                    title: 'Description',
                },
                {
                    data: 'active',
                    title: 'Active',
                    render: (data, fuel) => {
                        return (data === 1) ? 'Active' : 'Deactive'
                    }
                },
                {
                    data: 'id',
                    title: 'Action',
                    render: (id) => {
                        return `<button type="button" ref="edit" class="btn btn-dark" data-action="edit" data-index="${id}"><i class="far fa-edit"></i></button>`
                    }
                }
            ],
            rowCallback: (data) => {
                let item = data.querySelectorAll("[ref='edit']")[0]
                let id = item.getAttribute('data-index')
                item.addEventListener('click',() => {
                    this.triggerEvent('edit',id);
                })
            }
        })
    }
}
