import Component from "../../component/Component";
export default class State extends Component{
    constructor(placeholderId, props ) {
        super(placeholderId,props);
        this.buildEvent()
    }
    buildEvent(){
        this.refs.new.addEventListener('click',this.edits.bind(this))
    }
    edits() {
        this.triggerEvent('new')
    }
}

