import Component from "./component/Component";
import State from "./component/State";
class Section extends Component{
    constructor() {
        super();
        this.state = {}
        this.init();
    }
    init() {
        this.state = new State({

        },
            event, {
a(){}
        });
    }
}

 new Section('hello');

