import Component from "../../component/Component"
export default class editSliders extends Component {
    constructor(plackeholder,option){
        super(plackeholder,option)
        this.$componentElem = $(this.componentElem)
    }
    open() {
        this.$componentElem.modal('toggle');
    }
}