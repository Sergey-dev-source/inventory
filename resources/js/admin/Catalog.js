import Component from "../component/Component";
import State from "./component/State";
import axios from "axios";

class Catalog extends Component {
    constructor() {
        super('catalog');
        this.state = {}
        this.init();
    }

    init() {
        this.state = new State('catalog', {
                data: {},
                events: {
                    edit: () => {
                        this.lock()
                    }
                }
            }
        )
        this.autoUnlock()
    }

    lock() {
        axios.post('/admin/catalog/lock' , {})
            .then((response) => {
                if (response.data){
                    this.state.setEditedshow();
                }
            })
            .catch(err => {
                console.log(err)
            })
    }
    autoUnlock() {
        axios.post('/admin/catalog/autoUnlock' , {})
            .then(() => {

            })
            .catch(err => {
                console.log(err)
            })
    }
}

new Catalog('hello');

