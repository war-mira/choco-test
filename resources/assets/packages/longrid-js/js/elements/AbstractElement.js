class AbstractElement{

    /**
     * some init staff like enable MediumEditor and etc.
     */
    init(){
        throw new Error(`init() должен быть реализован`)
    }

    /**
     * init Buttons for item control
     */
    static initButtons(){
        throw new Error(`static initButtons() должен быть реализован`)
    }
    /**
     * create DOM from json
     */
    addFromRaw(item) {
        throw new Error(`addFromRaw(item) должен быть реализован`)
    }
 /**
     * should prepare to create json
     */
    getObject() {
        throw new Error(`getObject() должен быть реализован`)
    }

    /**
     * should return id of text/template
     */
    getTemplateId(){
        throw new Error(`getTemplateId должен быть реализован`)
    }

    updateState(event) {
        let target = event.target;
        if (target.matches('.grid__item--control_item')) {
            target.parentNode.querySelectorAll('.grid__item--control_item').forEach((item) => item.classList.remove('active'));
            target.classList.add('active');
            this.state = target.getAttribute('data-type');
        }
        Grid.triggerSave();
    }
    getStates(){
        let states = '';
        let _self = this;
        for(let state in this.states){
            states += `<div class="grid__item--control_item ${(state == _self.state)?'active':''}" data-type="${state}">${this.states[state]}</div>`;
        }
        return states;
    }
}
