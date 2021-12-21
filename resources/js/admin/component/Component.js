export default class Component {
    constructor(placeholderId, props = {}, template = undefined) {
        this.componentElem = document.getElementById(placeholderId)

        if (template) {
            // Load template into placeholder element
            this.componentElem.innerHTML = template
        }
        this.refs = {};
        if (this.componentElem) {
            const refElems = this.componentElem.querySelectorAll('[ref]')
            refElems.forEach((elem) => { this.refs[elem.getAttribute('ref')] = elem })
        } else {
            this.componentElem = document.createElement('div')
        }
        if (props.events) {
            this.createEvents(props.events)
        }

        if (props.data) {
            this.data = props.data
        }
    }
    createEvents (events) {
        Object.keys(events).forEach((eventName) => {
            this.componentElem.addEventListener(eventName, events[eventName], false)
        })
    }

    triggerEvent (eventName, detail) {
        const event = new window.CustomEvent(eventName, { detail })
        this.componentElem.dispatchEvent(event)
    }
}
