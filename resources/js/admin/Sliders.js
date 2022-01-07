import Component from '../component/Component'
import State from './component/State'
import editSliders from "./component/editSliders";
class Sliders extends Component {
    constructor(placeholder, options) {
        super(placeholder, options)
        this.state = {};
        this.editSliders ={}
        this.init();
    }

    init() {
        this.state = new State('sliders',{
            data: {},
            events: {
                new: () => {
                    this.editSliders.open()
                }
            }
        });
        this.editSliders = new editSliders('newSliders',{
            data: {},
            events: {
                new: () => {

                }
            }
        });
    }
}

new Sliders('sliders');