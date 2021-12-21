import Component from "./Component";
export default  class State extends Component{
    constructor(placeholderId, props ) {
        super(placeholderId,props);
        this.buildEvent()
    }
    buildEvent(){
        this.refs.edit.addEventListener('click',this.edits.bind(this))
    }
    edits() {
        this.triggerEvent('edit')
    }
    setEditedshow(){
        this.refs.edit.classList.add('d-none');
        this.refs.save.classList.remove('d-none');
        this.refs.cancel.classList.remove('d-none');
    }
}
