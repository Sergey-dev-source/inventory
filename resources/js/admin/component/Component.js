export default class Component {
    constructor(data) {
        this.refs = {};
        this.setRefs();
    }
    setRefs() {
        let elements = document.querySelectorAll('*')
        elements.forEach(item => {
            let attribute = item.getAttribute('ref')

            if (attribute !== null) {
                this.refs[attribute] = item;
            }
        })
    }

    show() {
        // return 'hello';
    }
}
