import Component from "../../component/Component";
export default class SectionTable extends Component {
    constructor(plackeholderId,props) {
        super(plackeholderId,props);
        this.initTable()
    }
    initTable() {
        console.log(this.refs)
        $(this.refs.sectionTable).KTDatatable({
            data: {
                type: 'local',
                source: this.data.format,
                pageSize: 10
            },
            layout: {
                scroll: true,
                height: 500,
                footer: false
            },
            sortable: false,
            pagination: true,
            columns: this.data.column,
            rows: {
                callback: (row, data) => {
                    if (data.highlighted) {
                        row.addClass(this.data.sumRowClass)
                    }
                },
                afterTemplate: (row, data) => {
                    if (data.clickable) {
                        row.on('click', () => {
                            this.persistRowClick(data.index)
                        })
                    }

                    if (data.actions) {
                        row.find('[data-action]').each((index, button) => {
                            button.addEventListener('click', () => {
                                this[button.dataset.action](parseInt(button.dataset.index))
                            })
                        })
                    }

                    row.find('[data-toggle="kt-tooltip"]').tooltip()
                }
            }
        })
    }
}