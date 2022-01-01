import Component from "../../component/Component";
export default class SectionTable extends Component {
    constructor(plackeholderId,props) {
        super(plackeholderId,props);
        this.table = {}
        this.initTable()
        this.initSearch()
    }
    initSearch(){
        this.refs.searchSection.addEventListener('keyup',()=>{
            let text = this.refs.searchSection.value
            this.triggerEvent('search', {name: text})
        })
    }
    initTable() {
        let table = this.refs.sectionTable;

        let column = '<tr>';
        this.data.column.forEach(item=> {
            column+= `<th>${item.data}</th>`
        })
        column+= '</tr>';
        let data = '';
            this.data.format.forEach(item=> {
            data+= `<tr>
                        <td>${item.name}</td>
                        <td>${item.active}</td>
                        <td>${item.actions}</td>
                    </tr>`
        })
        if (this.data.format.length === 0){
            data = `<tr>
                        <td colspan="3" style="text-align: center">Not data</td>
                    </tr>`
        }
        table.innerHTML = `<thead>${column}</thead><tbody>${data}</tbody>`
        this.initBuild()
    }

    initBuild(){
        let items = document.querySelectorAll('[ref="edit"]')
        items.forEach(button =>{
            button.addEventListener('click',()=>{
                let id = button.getAttribute('data-index');
                this.triggerEvent('edit',id)
            })
        })

    }
    reload(data) {
        this.data.format = data
        this.initTable();
    }
}
