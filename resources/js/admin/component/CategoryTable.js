import Component from "../../component/Component";
export default class CategoryTable extends Component {
    constructor(plackeholderId,props) {
        super(plackeholderId,props);
        this.table = {}
        this.initTable()
    }
    initTable() {
        this.table = $(this.refs.categoryTable).DataTable({
            ajax: '/category/show',
            columns: [
                {
                    'data': 'name',
                    'title': 'Name'
                },
                {
                  'data': 'section',
                  'title' : "Section"
                },
                {
                    'data': 'active',
                    'title': 'Active',
                    'render': function (data,type){
                        if (data === 0) {
                            return 'Deactive';
                        }else{
                            return 'Active'
                        }
                    }
                },
                {
                    'data': 'id',
                    'title' : 'Action',
                    'render': function (id,type){
                        return `<button type="button" ref="edit" class="btn btn-dark" data-action="edit" data-index="${id}"><i class="far fa-edit"></i></button>`
                    }
                }
            ],
            rowCallback: (data)=>{
                let items = data.querySelectorAll('[ref="edit"]')
                items[0].addEventListener('click',()=>{
                    let id = items[0].getAttribute('data-index');
                    this.triggerEvent('edit',id)
                })
            }
        })
    }
}
